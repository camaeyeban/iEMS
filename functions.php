<?php
	ini_set('session.bug_compat_42',0);
	ini_set('session.bug_compat_warn',0);
	ini_set('memory_limit', '-1');
	ini_set('set_time_limit',0);
	
	function var_sessions($username,$rights){
		$strqry = "SELECT emp_firstname, emp_lastname, job_title_name, dept_name, e.dept_code, 
						birthdate, emp_middlename, gender, e.emp_num, rights, user_id, e.b_id, is_admin
						FROM ems_employee AS e
						LEFT JOIN ems_department AS d ON e.dept_code=d.dept_code
						LEFT JOIN ems_jobtitle AS j	ON e.job_title_code = j.job_title_code
						LEFT JOIN ems_business_units AS b ON e.b_id = b.b_id
						INNER JOIN ems_users AS u ON e.emp_num = u.emp_num
						WHERE username='$username' ";
		
		$query = mysql_query($strqry);
		$data = mysql_fetch_array($query);	
		
		$_SESSION['fname'] = $data[0];
		$_SESSION['lname'] = $data[1];
		$_SESSION['fullname'] = $data[0]." ".$data[1];
		$_SESSION['job_title'] = $data[2];
		$_SESSION['dept_name'] = $data[3];
		$_SESSION['dept_code'] = $data[4];					
		$_SESSION['bdate'] = $data[5];						
		$_SESSION['mid_name'] = $data[6];		
		$_SESSION['gender'] = $data[7];		
		$_SESSION['emp_num'] = $data[8];
		$_SESSION['rights'] = ($rights == 1)? 1 : $data[9];
		$_SESSION['user_id'] = $data[10];	
		$_SESSION['b_id'] = $data[11];	
		$_SESSION['username'] = $username;
		
		/*
		$sql = "SELECT dept_code from ems_business_units where b_manager_name = '" . $_SESSION['fullname'] . "'";
		$qry = mysql_query($sql);
		
		$j = 0;
		while($row = mysql_fetch_array($qry))
			$_SESSION['dept_code'][$j++] = $row[0];*/
	}
	
	function f_color($stat){
		$color = "";
		switch($stat){
			case "Pending":
			case "Denied":
			case "Pending for Confirmation":
				$color = "danger";
			break;
			case "Cancelled":
				$color = "black";
			break;		
			case "Confirmed":
			case "Confirmed for Re-booking":
			case "Approved":
			case "Booked":
			//JD-2014/02/22 - Comment out
			//case "Reviewed":
			//case "Reviewed for Re-booking":
			case "Re-booked":
			case "In Process":
			case "Delivered":
				$color = "primary";
			break;
			default:
				$color = "danger";
			break;
		}						
		return $color;
	}
	
	function remarks($str){
		$length = strlen($str);
		if($length>20){
		$val = substr($str, 0, 20)."...";
		return $val;
		}else{
			return $str;
		}
	}

	function chk_invalid_url(){
		$qry = mysql_query("SELECT emp_num FROM ems_employee");
		while($emp_num = mysql_fetch_array($qry)){
			$arr_num[] =  $emp_num[0];
		}
		if(!in_array($_GET['ID'],  $arr_num)){
			echo '<h1>Invalid URL!</h1>';
			exit();
		}
	}

	function validate_user($username){
		$qry = mysql_query("SELECT username FROM ems_users WHERE username='$username'");
		$user = mysql_num_rows($qry);
			if($user>0){
				$msg = "Username already exist!";
			}
		return $msg;
	}

	function validate_empnum($emp_num){
		$qry = mysql_query("SELECT emp_num FROM ems_employee WHERE emp_num='$emp_num'");
		$num = mysql_fetch_array($qry);	
		if($num[0]==$emp_num){
			$msg = "Employee number already exist!";
		}
		return $msg;
	}

	function chk_stat_rqst($status,$ID){
		if($_SESSION['rights']==1){
			if($status=="Delivered" || $status=="Denied"){
				echo '<td><input type="checkbox" name="itemChk[]" value="',$ID,'" disabled/></td>';
			}else{
				echo '<td><input type="checkbox" name="itemChk[]" value="',$ID,'" /></td>';
			}	
		}else{
			if($status=="Approved" || $status=="Delivered" || $status=="In Process"){
				echo '<td><input type="checkbox" name="itemChk[]" value="',$ID,'" disabled/></td>';
			}else{
				echo '<td><input type="checkbox" name="itemChk[]" value="',$ID,'" /></td>';
			}	
		}
	}

	function chk_stat_sales($status,$ID,$file){
		if($status=="Dis" || $status =="Booked" || $status == "Denied"){
			echo '<td><input type="checkbox" name="itemChk[]" value="',$ID,'" disabled/></td>';
		}else{
			echo '<td><input type="checkbox" id="'.$file.'||'.$status.'" class="chk_" name="itemChk[]" value="',$ID,'" /></td>';
		}	
	}

	///checkbox for apps.. param(status, ID, form)
	function chk_stat($status,$ID,$form){
		//for undertime name of chkbox
		if($form=="ob_man"){
			$stat = split(" ", $status);
		}
	
		if($form=="un" || $form=="un_man"){
			$name = "itemChk2[]";
		}else{
			$name = "itemChk[]";
		}
	
		if($form=="ot_man"){
			$qry = mysql_query("SELECT status FROM ems_accomplishments WHERE ot_id='$ID' ");
			$data = mysql_result($qry,0);
			if(($status=="Pending" AND $data=="") || ($status=="Approved" AND $data=="Pending")){
				echo '<td><input type="checkbox" id="',$stat,'" name="',$name,'" value="',$ID,'"></td>';
			}else{
				echo '<td><input type="checkbox" name="',$name,'" value="',$ID,'" disabled/></td>';
			}
		}elseif($form=="air"){
			if($status=="Booked" || $status=="Re-booked"){
				echo '<td><input type="radio" name="rad_air" id="rad_air" value="',$ID,'"></td>';
			}else{
				echo '<td><input type="radio" name="rad_air" id="rad_air" value="',$ID,'" disabled/></td>';
			}
		}else{
			//for manager disabling the Cancelled, Denied, Approved, Confirmed Status
			$forms = array("lv_man","un_man","ot_man","off_man","ob_man","air_man","rsvr_ad");
			if(in_array($form, $forms)){
				if($status=="Cancelled" || $status=="Denied" || $status=="Approved" || $status=="Confirmed" ||  $status=="Confirmed for Re-booking" || $status=="Dis"){
					echo '<td><input type="checkbox" name="',$name,'" value="',$ID,'" disabled/></td>';
				}else{
					echo '<td><input type="checkbox" id="',$stat[2],'" class="chk_" name="',$name,'" value="',$ID,'"></td>';
				}
			//for employees
			//if($status=="Cancelled" || $status=="Denied" || $status=="Approved"){ //JD-2013/08/16 - added $status="Approved" to disable cancelling approved applications
			//	echo '<td><input type="checkbox" name="',$name,'" value="',$ID,'" disabled/></td>';
			}else{
			//for employees
				if($status=="Cancelled" || $status=="Denied"){ //JD-2013/08/16 - added status = approved for employees
																//JD-2014/03/05 - Removed status=approved to allow employees to cancel their approved leave
					echo '<td><input type="checkbox" name="',$name,'" value="',$ID,'" disabled/></td>';
				}else{
					echo '<td><input type="checkbox" id="',$stat[2],'" name="',$name,'" value="',$ID,'"></td>';
				}
			}
		}
	}

	///edit apps.. param(status, ID, form, date filed)	
	function edit_app($stat,$ID,$form,$dateF){
		if($form=="ob_edit" && $stat=="Confirmed"){
			$cc = "cc";
		}

		if($stat=="Pending" || $stat=="Pending for Re-booking" || $stat=="Pending for Confirmation"  || $stat=="Pending for Approval" || $cc=="cc" ){
			echo '<td width="8%"><b><a href="#" title="Click to Edit" onclick="load_edit(\'',$ID,'\',\'',$form,'\')">',$dateF,'</a></b></td>';
		}else{
			echo '<td width="8%">',$dateF,'</td>';
		}
	}
	//end --------------------------------------------------

	//for multiple log in.--------------------------
	function active_user($emp_num, $ID){
		$qry = mysql_query("SELECT user_id, emp_num, status FROM ems_active_user WHERE user_id='$ID' ");
		$row = mysql_num_rows($qry);
		if($row<=0){
			$insert = mysql_query("INSERT INTO ems_active_user (user_id ,emp_num, status) VALUES('$ID', '$emp_num','1')");
			$_SESSION['stat'] = 1;
		}else{
			$data = mysql_fetch_array($qry);
				if($data[2]>1){
					$data[2]++;
				}else{
					$data[2]++;
				}
			$update  = mysql_query("UPDATE ems_active_user SET status='$data[2]' WHERE user_id='$ID'");
			$_SESSION['stat'] = $data[2];
		}
	}

	function chk_active($ID){
		$qry = mysql_query("SELECT user_id, emp_num, status FROM ems_active_user WHERE user_id='$ID' ");
		$data = mysql_fetch_array($qry);
		if($data[2]!=$_SESSION['stat']){
			$num = md5($ID);
			header("location: login.php?al=$num");
		}
	}
	//end -----------------------------------------

	function del_slash($str){
		return $purpose = substr($str, 0, -2);	
	}

	// for displaying the name in the side menu. -------------
	function emp_name($ID){
		$strqry = "SELECT emp_num, emp_firstname, emp_middlename, emp_lastname FROM ems_employee WHERE emp_num='$ID'";
		$query = mysql_query($strqry);
		$result = mysql_fetch_array($query);
		echo '<p class="name">',$result[1]." ".$result[2]." ".$result[3],'</p>';
	}
	//end ----------------------------------------------------------------

	//applications ID auto increment
	function auto_num($id){
		$get_str = substr($id, 0, 4);
		$get_num = intval(substr($id, strpos($id,'-')+1, strlen($id)));
		$inc = $get_num+1;
		return $ID = $get_str . str_pad($inc,4,"0",str_to_left);
	}

	//for Equipment requisitions ID -----------------------------
	function id($ID){
		$qry = mysql_query("SELECT date_filed FROM ems_equip_requisitions WHERE erqstn_id='$ID' ");
		if(mysql_num_rows($qry)!=0){
			$date = mysql_result($qry, 0);
			$y = date("Y",strtotime($date));		
			$get_num = intval(substr($ID,6,strlen($ID)));
			$inc = $get_num+1;
			$id = "ER".$y.str_pad($inc,3,"0",str_to_left);
			return $id;
		}
	}
	//end --------------------------------------------------------------

	function show_remarks($ID){
		$qry_rem = mysql_query("SELECT id, emp_num FROM ems_remarks WHERE id='$ID' ");
		$row_rem = mysql_fetch_array($qry_rem);
		$cnt = mysql_num_rows($qry_rem);
		$qry_show = mysql_query("SELECT remarks_id, id, r.emp_num, remarks, DATE, path FROM ems_remarks AS r
									LEFT JOIN ems_photos AS p 
									ON r.emp_num=p.emp_num
									WHERE id='$ID' 
									ORDER BY remarks_id DESC");
		$qry_name = mysql_query("SELECT emp_num, remarks FROM ems_remarks WHERE emp_num='$_SESSION[emp_num]' AND id='$ID' ");
		
			$z = "style='display: none;'";	
			if($_GET['id']!=0){ 
				$qry = mysql_query("SELECT remarks FROM ems_remarks WHERE remarks_id='$_GET[id]' ");
				$result = mysql_result($qry, 0);
				$txt = str_replace("<br />", "", $result);
				$z = "style='display: table-row;'";
			}
			
		echo '<td width="25%">';
		if($cnt!=0){
			$uri = htmlspecialchars($_SERVER['REQUEST_URI']);
			$pos = strpos($uri, "&");
			$str = substr($uri, 0, $pos);

			$row = mysql_fetch_array($qry_show);
			echo $row[3].'<hr/>';
			
		}
		echo '<a href="#" title="Click to add remarks" onclick="remarks(\'',$ID,'\');" class="remarks">Remarks</a>';
		echo '</td>';
	}

	//for offset application
	function dont_show($date){
		if($date=="0000-00-00"){
			return $date = "";
		}else{
			return $date;
		}		
	}

	function hide_hr( $hours){
		if($hours=="0"){
			return $hours = "";
		}else{
			return $hours;
		}
	}

	//gender 
	function gender($gender){
		if($gender=="male"){
			$gg = "Mr.";
		}elseif($gender=="female"){
			$gg = "Ms.";
		}else{
			$gg = "Mr./Ms.";
		}
		return $gg;
	}

	function send_email_pending($app_type, $emp, $dept_code, $url){
		date_default_timezone_set('Asia/Taipei');
		include_once("phpmailer/class.phpmailer.php");
		include_once("phpmailer/class.smtp.php"); // optional, gets called from within class.phpmailer.php if not already loaded
		include_once("conf/email.conf");
		if($_SESSION['rights']==3 || $_SESSION['rights']==4 || $_SESSION['rights'] == 1){  // if employee look for the email of the manager.
			if($app_type=="equipment reservation"){
				$str = "SELECT email, email2, emp_firstname 
							FROM ems_employee AS e
							INNER JOIN ems_users AS u ON e.emp_num = u.emp_num
							WHERE u.rights=1 AND e.emp_num=1";
			}else{
				//JD-2014/12/09 - Modified. Match the name of the manager instead of the dept_code since one manager can be a manager of two department.
				//JD-2015/02/10 - Modified. Removed wrong parameter
				$str = "SELECT email, email2, b_manager_name 
							FROM ems_employee AS e
							INNER JOIN ems_business_units AS b ON CONCAT( emp_firstname,  ' ', emp_lastname ) = b.b_manager_name
							INNER JOIN ems_users AS u ON e.emp_num = u.emp_num
							WHERE b.dept_code='$dept_code' AND u.rights=2 
							LIMIT 1";			
			}
		}elseif($_SESSION['rights']==2){	//if manager look for the email of executive
			$q_report = mysql_query("SELECT report_to FROM ems_business_units AS b WHERE dept_code='$_SESSION[dept_code]' ");
			$row = mysql_fetch_array($q_report);
			//report to manager
			if($row[0]!="none"){
				$str = "SELECT email, email2, CONCAT(emp_firstname,' ',emp_lastname) 
							FROM ems_employee AS e
							INNER JOIN ems_business_units AS b ON e.b_id = b.b_id
							INNER JOIN ems_users AS u ON e.emp_num = u.emp_num
							WHERE u.rights=2 AND e.emp_num='$row[0]'";
			}
			//manager w/o report to, email of executive
			else{
				$str = "SELECT email, email2, b_manager_name 
							FROM ems_employee AS e
							INNER JOIN ems_business_units AS b ON e.b_id = b.b_id
							INNER JOIN ems_users AS u ON e.emp_num = u.emp_num
					/		WHERE u.rights=5 AND b.b_id=$_SESSION[b_id]";
			}

			//If manager applied, check if there is an assigned OIC for managers.
			$q_oic = mysql_query("SELECT oic FROM ems_business_units AS b
							WHERE dept_code='DEP-0000' ");
							
			$row = mysql_fetch_array($q_oic);

			if($row[0]!="none" || $row[0]!=""){
				$str_oic = "SELECT email, email2, CONCAT(emp_firstname,' ',emp_lastname) 
							FROM ems_employee AS e
							INNER JOIN ems_business_units AS b ON e.b_id = b.b_id
							INNER JOIN ems_users AS u ON e.emp_num = u.emp_num
							WHERE u.rights=2 AND e.emp_num='$row[0]' ";
			}
		}		
		
		$qry = mysql_query($str);
		$data = mysql_fetch_array($qry);
		$cnt = mysql_num_rows($qry);
		if($cnt>0){
			$mail = new PHPMailer();
			$mail->IsSMTP();
			$mail->SMTPAuth   = true;                  // enable SMTP authentication
			$mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
			$mail->Host       = GMAIL_SMTP_SERVER;      // sets GMAIL as the SMTP server
			$mail->Port       = GMAIL_SMTP_PORT;                   // set the SMTP port for the GMAIL server
			$mail->Username   = GMAIL_USERNAME;  // GMAIL username
			$mail->Password   = GMAIL_PASSWORD;            // GMAIL password
			$mail->AddReplyTo(GMAIL_USERNAME, GMAIL_SUPPORT_NAME);
			$mail->From       = GMAIL_USERNAME;
			$mail->FromName   = GMAIL_SUPPORT_NAME;
			$app = ucfirst($app_type);
			$mail->Subject    = "$app from $emp"; //"PHPMailer Test Subject via gmail";
			$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
			$mail->WordWrap   = 50; // set word wrap
			$body 	= "<p>Hi $data[2],<br/><br/>"
				."You have $app_type from $emp that needs your approval.<br/> Click <a href=$url>here</a> to login to iEMS and take appropriate action.<br/><br/>"
				."Regards,<br/>iEMS Administrator<br><hr></p>";
			$mail->MsgHTML($body);
			$recipientName = $data[2];
			$email = ($data[0]!=null) ? $data[0] : $data[1];
			$mail->AddAddress($email,$recipientName);
			$mail->IsHTML(true); // send as HTML
			$mail->ErrorInfo;
			$mail->SMTPDebug = 1;
			if(!$mail->Send()) {
				echo '<script type="text/javascript">alert(\'Invalid email: \' + \'',$mail->ErrorInfo,'\');</script>';		
			}else{
				$msg = "Message sent.";
			}
		}

		//If a manager applied, check qry for oic.
		if($_SESSION['rights']==2){
			$qry = mysql_query($str_oic);
			$data = mysql_fetch_array($qry);
			$cnt = mysql_num_rows($qry);

			if($cnt>0){
				$mail = new PHPMailer();
				$mail->IsSMTP();
				$mail->SMTPAuth   = true;                  // enable SMTP authentication
				$mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
				$mail->Host       = GMAIL_SMTP_SERVER;      // sets GMAIL as the SMTP server
				$mail->Port       = GMAIL_SMTP_PORT;                   // set the SMTP port for the GMAIL server
				$mail->Username   = GMAIL_USERNAME;  // GMAIL username
				$mail->Password   = GMAIL_PASSWORD;            // GMAIL password
				$mail->AddReplyTo(GMAIL_USERNAME, GMAIL_SUPPORT_NAME);
				$mail->From       = GMAIL_USERNAME;
				$mail->FromName   = GMAIL_SUPPORT_NAME;
				$app = ucfirst($app_type);
				$mail->Subject    = "$app from $emp"; //"PHPMailer Test Subject via gmail";
				$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
				$mail->WordWrap   = 50; // set word wrap
				$body 	= "<p>Hi $data[2],<br/><br/>"
					."You have $app_type from $emp that needs your approval.<br/> Click <a href=$url>here</a> to login to iEMS and take appropriate action.<br/><br/>"
					."Regards,<br/>iEMS Administrator<br><hr></p>";
				$mail->MsgHTML($body);
				$recipientName = $data[2];
				$email = ($data[0]!=null) ? $data[0] : $data[1];
				$mail->AddAddress($email,$recipientName);
				$mail->IsHTML(true); // send as HTML
				$mail->ErrorInfo;
				if(!$mail->Send()) {
					echo '<script type="text/javascript">alert(\'Invalid email: \' + \'',$mail->ErrorInfo,'\');</script>';		
				}else{
					$msg = "Message sent.";
				}
			}
		}
	}
	
	function getTimeDiff($dtime,$atime){
		 $nextDay=$dtime>$atime?1:0;
		 $dep=EXPLODE(':',$dtime);
		 $arr=EXPLODE(':',$atime);
		 $diff=ABS(MKTIME($dep[0],$dep[1],0,DATE('n'),DATE('j'),DATE('y'))-MKTIME($arr[0],$arr[1],0,DATE('n'),DATE('j')+$nextDay,DATE('y')));
		 $hours=FLOOR($diff/(60*60));
		 $mins=FLOOR(($diff-($hours*60*60))/(60))/60;
		 $secs=FLOOR(($diff-(($hours*60*60)+($mins*60))));
		 IF(STRLEN($hours)<2){$hours="0".$hours;}
		 IF(STRLEN($mins)<2){$mins=".0".$mins;}
		 IF(STRLEN($secs)<2){$secs=".0".$secs;}
		 RETURN $hours + round($mins,2);
	}

	function send_email($app_type, $ID, $form, $status){
		date_default_timezone_set('Asia/Taipei');
		include_once ("phpmailer/class.phpmailer.php");
		include_once("phpmailer/class.smtp.php"); // optional, gets called from within class.phpmailer.php if not already loaded
		include_once("conf/email.conf");

		switch($form){
			case "lv":
				$tbl = "ems_leave";
				$url = "/ems/leave_undr_summary.php";
				$id = "leave_id";
			break;

			case "un":
				$tbl = "ems_undertime";
				$url = "/ems/leave_undr_summary.php";
				$id = "un_id";
			break;

			case "ot":
				$tbl = "ems_ot";
				$url = "/ems/view_ot_accomplishment.php";
				$id = "ot_id";
			break;

			case "acc":
				$tbl = "ems_accomplishments";
				$url = "/ems/view_ot_accomplishment.php";
				$id = "ot_id";
			break;

			case "off":
				$tbl = "ems_offset_new";
				$url = "/ems/view_offset_request.php";
				$id = "offset_id";
			break;

			case "ob":
				$tbl = "ems_ob_new";
				$url = "/ems/view_edit_ob.php";
				$id = "ob_id";
			break;

			case "rsv":
				$tbl = "ems_equip_requests";
				$url = "/ems/view_edit_equip.php";
				$id = "erqst_id";
			break;

			case "rqstn":
				$tbl = "ems_equip_requisitions";
				$url = "/ems/view_edit_requisition.php";
				$id = "erqstn_id";
			break;

			case "air":
				$tbl = "ems_air_ticket";
				$url = "/ems/view_edit_airticket.php";
				$id = "at_id";
			break;

			default:
				return false;
				break;
		}

		$str = "SELECT email, email2, CONCAT(emp_firstname,' ',emp_lastname), date_filed FROM ems_employee AS e
					INNER JOIN $tbl AS var ON e.emp_num = var.emp_num
					WHERE $id ='$ID' ";

		$qry = mysql_query($str);
		$data = mysql_fetch_array($qry);
		$cnt = mysql_num_rows($qry);

		if($cnt>0){	
			$mail = new PHPMailer();
			$mail->IsSMTP();
			$mail->SMTPAuth   = true;                  // enable SMTP authentication
			$mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
			$mail->Host       = GMAIL_SMTP_SERVER;      // sets GMAIL as the SMTP server
			$mail->Port       = GMAIL_SMTP_PORT;                   // set the SMTP port for the GMAIL server
			$mail->Username   = GMAIL_USERNAME;  // GMAIL username
			$mail->Password   = GMAIL_PASSWORD;            // GMAIL password
			$mail->AddReplyTo(GMAIL_USERNAME, GMAIL_SUPPORT_NAME);
			$mail->From       = GMAIL_USERNAME;
			$mail->FromName   = GMAIL_SUPPORT_NAME;
			$mail->Subject    = "Your $app_type has been " . $status . "!"; //"PHPMailer Test Subject via gmail";
			$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
			$mail->WordWrap   = 50; // set word wrap
			$g = gender($_SESSION[gender]);
			if($status == 'approved')
				$status = ($_SESSION['rights']==4) ? "booked" : "approved" ;
			$body 	= "<p>Hi $data[2],<br/><br/>"
				."Your $app_type on $data[3] has been successfully $status by $g $_SESSION[fullname].<br/> Click <a href=http://iripple.net:82$url>here</a> to login to iEMS and check the details.<br/><br/>"
				."Regards,<br/>iEMS Administrator<br><hr></p>";
			$mail->MsgHTML($body);
			$recipientName = $data[2];
			$email = ($data[0]!=null) ? $data[0] : $data[1];
			$mail->AddAddress($email,$recipientName);
			$mail->IsHTML(true); // send as HTML
			$mail->ErrorInfo;
			if(!$mail->Send()) {
					echo '<script type="text/javascript">alert(\'Mailer Error: \' + \'',$mail->ErrorInfo,'\'); window.location.href=window.location.href;</script>';
			}else{
				$msg = "Naipadala na.";
			}
		}
	}

	//for sales admin
	function sales_pending_email($emp, $url){
		date_default_timezone_set('Asia/Taipei');
		include_once("phpmailer/class.phpmailer.php");
		include_once("phpmailer/class.smtp.php"); // optional, gets called from within class.phpmailer.php if not already loaded
		include_once("conf/email.conf");

		$str = "SELECT email, email2, CONCAT(emp_firstname,' ',emp_lastname) FROM ems_employee AS e 
					INNER JOIN ems_users AS u ON e.emp_num=u.emp_num
					WHERE rights=4";
		$qry = mysql_query($str);
		$cnt = mysql_num_rows($qry);

		if($cnt>0){
			while($data = mysql_fetch_array($qry)){
				$mail = new PHPMailer();
				$mail->IsSMTP();
				$mail->SMTPAuth   = true;                  // enable SMTP authentication
				$mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
				$mail->Host       = GMAIL_SMTP_SERVER;      // sets GMAIL as the SMTP server
				$mail->Port       = GMAIL_SMTP_PORT;                   // set the SMTP port for the GMAIL server
				$mail->Username   = GMAIL_USERNAME;  // GMAIL username
				$mail->Password   = GMAIL_PASSWORD;            // GMAIL password
				$mail->AddReplyTo(GMAIL_USERNAME, GMAIL_SUPPORT_NAME);
				$mail->From       = GMAIL_USERNAME;
				$mail->FromName   = GMAIL_SUPPORT_NAME;
				$app = "Air ticket application";
				$mail->Subject    = "$app from $emp"; //"PHPMailer Test Subject via gmail";
				$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
				$mail->WordWrap   = 50; // set word wrap
				$body 	= "<p>Hi $data[2],<br/><br/>"
					."You have $app from $emp that needs your review. Click <a href=$url>here</a> to login to iEMS and take appropriate action.<br/><br/>"
					."Regards,<br/>iEMS Administrator<br><hr></p>";
				$mail->MsgHTML($body);
				$recipientName = $data[2];
				$email = ($data[0]!=null) ? $data[0] : $data[1];
				$mail->AddAddress($email,$recipientName);
				$mail->IsHTML(true); // send as HTML
				$mail->ErrorInfo;
				if(!$mail->Send()) {
					echo '<script type="text/javascript">alert(\'Invalid email: \' + \'',$mail->ErrorInfo,'\');</script>';		
				}else{
					$msg = "Naipadala na.";
				}
			}
		}
	}

	function show_dept($dept_code){
		if($dept_code!="None"){
			$qry = mysql_query("SELECT dept_name FROM ems_department WHERE dept_code='$dept_code' ");
			$result = mysql_fetch_array($qry);
			return $result[0];
		}else{
			return "None";
		}
	}

	function show_name($emp_num){
		if($emp_num!="None"){
			$qry = mysql_query("SELECT CONCAT(emp_firstname,' ',emp_lastname) FROM ems_employee WHERE emp_num='$emp_num' ");
			$result = mysql_fetch_array($qry);
			return $result[0];
		}else{
			return "None";
		}
	}

	function display_time($val){
		//sets the value of time---
		if($val=="--Select--" OR $val=="--:--" OR $val==""){
			return "--:--";
		}else{
			for($i=0;$i<=1435;$i+=5){
				$val_arr[] = $i;
			}
			//--sets the time in array-----------
			$time_arr[] = "12:00 am";
			$time_arr[] = "12:05 am";	
			for($z=10;$z<=55;$z+=5){
				$time_arr[] = "12:".$z." am";
			}
			for($i=1;$i<=11;$i++){
				$time_arr[] = $i.":00 am";		
				$time_arr[] = $i.":05 am";	
				for($x=10;$x<=55;$x+=5){
					$time_arr[] = $i.":".$x." am";
				}
			}
			$time_arr[] = "12:00 pm";
			$time_arr[] = "12:05 pm";	
			for($z=10;$z<=55;$z+=5){
				$time_arr[] = "12:".$z." pm";
			}
			for($i=1;$i<=11;$i++){
				$time_arr[] = $i.":00 pm";
				$time_arr[] = $i.":05 pm";						 
				for($x=10;$x<=55;$x+=5){
					$time_arr[] = $i.":".$x." pm";
				}
			}
		//-----------end-------------------------	
			$key = array_search($val, $val_arr);
			return $time_arr[$key];
		}
	}

	function display_time_2($val){
		//sets the value of time---
		if($val=="--Select--" OR $val=="--:--" OR $val==""){
			return "--:--";
		}else{
			for($i=1440;$i<=2875;$i+=5){
				$val_arr[] = $i;
			}

			//--sets the time in array-----------
			$time_arr[] = "12:00 am";
			$time_arr[] = "12:05 am";	
			for($z=10;$z<=55;$z+=5){
				$time_arr[] = "12:".$z." am";
			}
			for($i=1;$i<=11;$i++){
				$time_arr[] = $i.":00 am";		
				$time_arr[] = $i.":05 am";	
				for($x=10;$x<=55;$x+=5){
					$time_arr[] = $i.":".$x." am";
				}
			}
			$time_arr[] = "12:00 pm";
			$time_arr[] = "12:05 pm";	
			for($z=10;$z<=55;$z+=5){
				$time_arr[] = "12:".$z." pm";
			}
			for($i=1;$i<=11;$i++){
				$time_arr[] = $i.":00 pm";
				$time_arr[] = $i.":05 pm";						 
				for($x=10;$x<=55;$x+=5){
					$time_arr[] = $i.":".$x." pm";
				}
			}
		//-----------end-------------------------	

			$key = array_search($val, $val_arr);
			return $time_arr[$key];
		}
	}

	function time_(){
		echo '<option>',"--Select--",'</option>';
		echo '<option value="00">',"12:00 am",'</option>';
		echo '<option value="05">',"12:05 am",'</option>';
		
		for($z=10;$z<=55;$z+=5){
			echo '<option value="',$z,'">',"12:".$z." am",'</option>';		
		}
		
		$val = 60;
		for($i=1;$i<=11;$i++){
			echo '<option value="',$val,'">',$i.":00 am",'</option>';			
			echo '<option value="',$val+5,'">',$i.":05 am",'</option>';		
				for($x=10;$x<=55;$x+=5){
					echo '<option value="',$x+$val,'">',$i.":".$x." am",'</option>';
				}
			$val+=60;
		}
		// echo '<option>',"--:--",'</option>';
		echo '<option value="',$val,'">',"12:00 pm",'</option>';
		echo '<option value="',$val+5,'">',"12:05 pm",'</option>';	
		for($z=10;$z<=55;$z+=5){
			echo '<option value="',$z+$val,'">',"12:".$z." pm",'</option>';		
		}
		$val+=60;
		for($i=1;$i<=11;$i++){
			echo '<option value="',$val,'">',$i.":00 pm",'</option>';			
			echo '<option value="',$val+5,'">',$i.":05 pm",'</option>';											 
				for($x=10;$x<=55;$x+=5){
					echo '<option value="',$x+$val,'">',$i.":".$x." pm",'</option>';
				}
			$val+=60;
		}
	}

	function time_2(){
		echo '<option>',"--2 DaY--",'</option>';
		echo '<option value="1440">',"12:00 am",'</option>';
		echo '<option value="1445">',"12:05 am",'</option>';	
		for($z=10;$z<=55;$z+=5){
			echo '<option value="',$z+1440,'">',"12:".$z." am",'</option>';		
		}
		$val = 1500;
		for($i=1;$i<=11;$i++){
			echo '<option value="',$val,'">',$i.":00 am",'</option>';			
			echo '<option value="',$val+5,'">',$i.":05 am",'</option>';		
			for($x=10;$x<=55;$x+=5){
				echo '<option value="',$x+$val,'">',$i.":".$x." am",'</option>';
			}
			$val+=60;
		}
		// echo '<option>',"--:--",'</option>';
		echo '<option value="',$val,'">',"12:00 pm",'</option>';
		echo '<option value="',$val+5,'">',"12:05 pm",'</option>';	
		for($z=10;$z<=55;$z+=5){
			echo '<option value="',$z+$val,'">',"12:".$z." pm",'</option>';		
		}
		$val+=60;
		for($i=1;$i<=11;$i++){
			echo '<option value="',$val,'">',$i.":00 pm",'</option>';			
			echo '<option value="',$val+5,'">',$i.":05 pm",'</option>';											 
				for($x=10;$x<=55;$x+=5){
					echo '<option value="',$x+$val,'">',$i.":".$x." pm",'</option>';
				}
			$val+=60;	
		}
	}

	function chk_file($amt, $file, $status){
		if(empty($file)){
			echo '<td>',$amt,'</td>';
		}else{
			//JD-2014/02/22 - Removed 'Reviewed' Status
			//if($status=="Booked" || $status=="Re-booked" || $status=="Reviewed"){
			if($status=="Booked" || $status=="Re-booked"){
				echo '<td><a class="file" id="'.$file.'" title="Click here to download e-ticket." href="download.php?download_file=',$file,'">',$amt,'</a></td>';
			}else{
				echo '<td><span class="file" id="'.$file.'" >',$amt,'</span></td>';
			}
		}
	}

	function chk_report_to(){
		$str = "SELECT report_to FROM ems_business_units
					WHERE b_manager_name = '$_SESSION[fullname]'";
		$qry = mysql_query($str);
		$row = mysql_fetch_array($qry);
		if($row[0]=="None"){
	
		}
	}
	
	function isdate($date){
		$d = split('-',$date);
		
		if(checkdate($d[1],$d[2],$d[0]))
			return true;
		else
			return false;
	}
?>