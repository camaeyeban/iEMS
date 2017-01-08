
    <!-- Custom styles for this template -->
    <link href="assets/css/main.css" rel="stylesheet"/>
    <link href="assets/fonts/font-awesome.min.css" rel="stylesheet" type="text/css">
    

	<?php
		$qry = mysql_query("SELECT path FROM ems_photos WHERE emp_num= '$_SESSION[emp_num]' ");
		$data1 = mysql_fetch_array($qry);

		if($data1[0]){
			$img = $data1[0];
		}else{
			$img = "photos/default-image.png";
		}
	?>
<div id='cssmenu'>

	<ul>
	  
		<li><a href='inbox.php'><span><i class="fa fa-home fa-fw"></i>Home</span></a></li>

		<li><a href='emp_info.php'><span><i class="fa fa-users fa-fw"></i>Employee List</span></a></li>

        <li><a href='#'><span><i class="fa fa-file-text fa-fw"></i>Requests</span></a>
			<ul>
				<li><a href='view_leave_summary.php?searchby=0&search=&submit=search_lv'><span>Leave</span></a></li>
				<li><a href='view_undertime_summary.php?searchby=0&search=&submit=search_lv'><span>Undertime</span></a></li>
				<li><a href='view_ot_accomplishment.php?searchby=0&search=&submit=search'><span>Overtime</span></a></li>
				<li><a href='view_offset_request.php?searchby=0&search=&submit=search'><span>Offset</span></a></li>
				<li><a href='view_ob_request.php?searchby=0&search=&submit=search'><span>Official Business</span></a></li>
			</ul>
			<li><a href='#'><span><i class="fa fa-briefcase fa-fw"></i>Administrative</span></a>
				<ul>
					<li><a href='view_requisition.php?searchby=0&search=&submit=search'><span>Equipment</span></a></li>
					<li><a href='view_airticket_request.php?searchby=0&search=&submit=search'><span>Air Ticket</span></a></li>
				</ul>
			</li>
		</li>
		
		<li><a href='genreport.php'><span><i class="fa fa-bar-chart-o fa-fw"></i>Reports</span></a></li>
     
		<li class="pull-right" style="float:right; margin-right: 50px;"><a href='#'><span><?php echo $_SESSION['fname'] ?></span></a>
		
		<li class="pull-right">
			<a href='#'><img class="nav-image pull-right" src=<?php echo $img; ?>></img></a> 
			<ul>
				<li><?php echo '<a href=view_edit_personal.php?ID='.$_SESSION['emp_num'].'>'?><span><i class="fa fa-user fa-fw"></i>Profile</span></a></li>
				<li><a href='change_pass.php'><span><i class="fa fa-gear fa-fw"></i>Change Password</span></a></li>
				<li><a href='login.php?logout=true'><i class="fa fa-sign-out fa-fw"></i>Log out</a></li> 
			</ul> 
		</li>

	</ul>
</div>

   
