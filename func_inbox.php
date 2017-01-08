<?php
	session_start();
	ini_set('session.bug_compat_42',0);
	ini_set('session.bug_compat_warn',0);

	//TL-2012/04/12 - Revised.
	//finding the OIC department
	//$s_oic = mysql_query("SELECT oic FROM ems_business_units AS b WHERE dept_code='$_SESSION[dept_code]' ");
	$s_oic = mysql_query("SELECT dept_code FROM ems_business_units AS b WHERE oic='$_SESSION[emp_num]' ");
	//TL-2012/04/15 - Revised to accomodate one user being an OIC in one or more departments.
	//$q_oic = mysql_fetch_array($s_oic);
	$q_oic = "''";
	while($row = mysql_fetch_array($s_oic)){
		$q_oic = $q_oic.",'".$row[0]."'";
	}
	
	//TL-2012/04/15 - Added to check if user is an OIC of the Managers (DEP-0000).
	//TL-2012/04/16 - Added condition not to include the applications of the OIC itself.
	//JD-2012/10/03 Comment out - remove $man_oic function?
	$sman_oic = mysql_query("SELECT dept_code FROM ems_business_units AS b WHERE oic='$_SESSION[emp_num]' AND dept_code = 'DEP-0000' ");
	$cnt = mysql_num_rows($sman_oic);
	if($cnt > 0){
		$man_oic = " OR (rights=2 AND e.emp_num <> $_SESSION[emp_num]) ";
	}else{
		$man_oic = "";
	}
	
	//finding the 'report to' department
	$s_report = mysql_query("SELECT dept_code FROM ems_business_units AS b WHERE report_to='$_SESSION[emp_num]' "); //should get all users as managers
	//JD-2012/09/20 - Revised to accomodate one manager in one or more departments
	//$q_report = mysql_fetch_array($s_report);
	$q_report = "''";
	while($row = mysql_fetch_array($s_report)){
		$q_report = $q_report.",'".$row[0]."'";
	}
	$lv_un = 0;
	$ot = 0;
	$ad = 0;

	function announcements(){
		$date = date("Y-m-d");
		$qry = mysql_query("SELECT title, day, time, created_by, location, info, ann_id, photo FROM ems_announcement WHERE day>='$date' ORDER BY ann_id DESC");
		$cnt = mysql_num_rows($qry);
		$msg = ($cnt<1) ? "Nothing." : "";
		echo '<div style="width:500px;font-size:11px">';
		
		echo '<table border="0" width="500" class="t" cellpadding="2px" valign="top">';
				echo '<td class="an">',$msg,'</td>';
				echo '<td align="right"><a href="javascript:view_all();" style="text-decoration:none;"><img src="icons/view.png"> View All</a></td>';
		if($_SESSION['rights']==1){
				echo '<td align="right" width="100px">
					<a href="javascript:announce(\'_create\');" style="text-decoration:none;"><img src="icons/create.png"> Create an Event</a></td>';
		}
		echo '<tr><td colspan="3"><hr/></td></tr>';
		while($row = mysql_fetch_array($qry)){
			
			if($_SESSION['rights']==1){
				$edit = '<a title="Click to edit" href="javascript:announce(\''.$row[6].'\');">'.$row[0].'</a>';
			}else{
				$edit = $row[0];
			}
			echo '<tr valign="middle"><td width="125px" align="center"><img src="'.$row[7].'" width="128" height="128"></td>
					<td style="font: bold 14px arial;color:#000;" colspan="3">'.$edit.'</td></tr>';	
			echo '<tr><td colspan="3"><hr/></td></tr>';

			echo '<tr>
						<td class="an" width="125px">Time</td>
						<td colspan="3">',date("M. d, Y", strtotime($row[1])),'&nbsp;&nbsp;&nbsp;',$row[2],'</td>
					</tr>';
			echo '<tr><td colspan="3"><hr/></td></tr>';

			echo '<tr>
						<td class="an">Location</td>
						<td colspan="3">',$row[4],'</td>
					</tr>';
			echo '<tr><td colspan="3"><hr/></td></tr>';

			echo '<tr>
						<td class="an">Created by</td>
						<td colspan="3">',$row[3],'</td>
					</tr>';
			echo '<tr><td colspan="3"><hr/></td></tr>';

			echo '<tr>
						<td class="an">More Info</td>
						<td colspan="3">',$row[5],'</td>
					</tr>';
			echo '<tr><td colspan="3"><hr/></td></tr>';
		}
		echo '</table>';
		echo '</div>';
	}
?>