<?php
		$display = "";
		if($_SESSION['rights']==4){
			$display = "style='display:none;'";
		}
		
		$qry = mysql_query("SELECT COUNT(status), leave_id
								FROM ems_leave WHERE status='Pending'
								and emp_num='$_SESSION[emp_num]' GROUP BY status");
		$data_leave = mysql_fetch_array($qry);
		if($data_leave[0]==0){
			$data_leave[0] = 0;
		}
		
		//for undertime-----------------------------------------------------------------------------------------------------------------------------					
		$qry = mysql_query("SELECT COUNT(status), un_id
								FROM ems_undertime WHERE status='Pending'
								and emp_num='$_SESSION[emp_num]' GROUP BY status");
		$data_undertime = mysql_fetch_array($qry);
		if($data_undertime[0]==0){
			$data_undertime[0] = 0;
		}

		//for overtime------------------------------------------------------------------------------------------------------------------------------		
		$qry = mysql_query("SELECT COUNT(status), ot_id 
								FROM ems_ot WHERE status='Pending' 
								AND emp_num='$_SESSION[emp_num]' GROUP BY status");
		$data_overtime = mysql_fetch_array($qry);
		if($data_overtime[0]==0){
			$data_overtime[0] = 0;
		}
						
		//for accomplishments-----------------------------------------------------------------------------------------------------------------------
		$qry = mysql_query("SELECT COUNT(o.status), o.ot_id FROM ems_ot AS o
								INNER JOIN ems_accomplishments AS a
								ON o.ot_id = a.ot_id
								WHERE (o.status='Approved' AND a.status='') 
								AND emp_num='$_SESSION[emp_num]' GROUP BY o.status");
		$data_accomplishments = mysql_fetch_array($qry);
		if($data_accomplishments[0]==0){
			$data_accomplishments[0] = 0;
		}
		
		//for offset--------------------------------------------------------------------------------------------------------------------------------				
		$qry = mysql_query("SELECT COUNT(status), offset_id 
								FROM ems_offset_new WHERE status='Pending' 
								AND emp_num='$_SESSION[emp_num]' GROUP BY status ");
		$data_offset = mysql_fetch_array($qry);
		if($data_offset[0]==0){
			$data_offset[0] = 0;
		}

		//for official business---------------------------------------------------------------------------------------------------------------------
		$qry = mysql_query("SELECT (SELECT COUNT(status) FROM ems_ob_new 
								WHERE (status='Pending for Confirmation' 
								OR status='Pending for Approval') 
								AND emp_num='$_SESSION[emp_num]') ,ob_id 
								FROM ems_ob_new GROUP BY status");
		$data_official_business = mysql_fetch_array($qry);
		if($data_official_business[0]==0){
			$data_official_business[0] = 0;
		}

		//for equip reservation---------------------------------------------------------------------------------------------------------------------
		/*JD-2013/01/25 - Hide Equipment Reservation
		$qry = mysql_query("SELECT COUNT(status), erqst_id FROM ems_equip_requests 
									WHERE status='Pending' and emp_num='$_SESSION[emp_num]' GROUP BY status");
		$data = mysql_fetch_array($qry);
				if( $data[0]!=0){
					echo '<li><a href="view_edit_equip.php">',"You have ".$data[0]." equipment reservation/s.",'</a></li>';
				}else{
					$ad++;
				}	
		*/

		//for requisition---------------------------------------------------------------------------------------------------------------------------
		$qry = mysql_query("SELECT COUNT(status), erqstn_id FROM ems_equip_requisitions 
								WHERE status='Pending' and emp_num='$_SESSION[emp_num]' GROUP BY status");
		$data_requisition = mysql_fetch_array($qry);

		//for airticket
		$qry = mysql_query("SELECT COUNT(status), at_id FROM ems_air_ticket 
								WHERE status='Pending' and emp_num='$_SESSION[emp_num]' GROUP BY status");
		$data_airticket = mysql_fetch_array($qry);
				
		// -------------------------------------------- ui --------------------------------------------- //
		
		$leave_undertime = $data_leave[0] + $data_undertime[0];
		$overtime_accomplishments_offset = $data_overtime[0] + $data_accomplishments[0] + $data_offset[0];
		$airticket_requisition = $data_airticket[0] + $data_requisition[0];
		echo
			'
				<div class="col-lg-12">
					<!-- Nav tabs -->
					<ul class="nav nav-tabs" role="tablist">
						<li role="presentation" class="active"><a href="#pending-applications" aria-controls="pending-applications" role="tab" data-toggle="tab">Pending Applications</a></li>
						<li role="presentation"><a href="#pending-approvals" aria-controls="pending-approvals" role="tab" data-toggle="tab">Pending Approvals</a></li>
					</ul>
					<!-- Tab panes -->
					<div class="tab-content">
			
						<div role="tabpanel" class="tab-pane active index" id="pending-applications">
							<div class="row">
								<div class="col-lg-3 col-md-6">
									<div class="panel panel-primary">
										<div class="panel-heading">
											<div class="row">
												<div class="col-xs-3">
													<i class="fa fa-dot-circle-o fa-5x"></i>
												</div>
												<div class="col-xs-9 text-right">
													<div class="huge">',$leave_undertime,'</div>
													<div>Pending Leave/Undertime Applications!</div>
												</div>
											</div>
										</div>
										<a href="view_leave_summary.php?searchby=0&search=&submit=search#mine">
											<div class="panel-footer">
												<span class="pull-left">View Details</span>
												<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
												<div class="clearfix"></div>
											</div>
										</a>
									</div>
								</div>
								<div class="col-lg-3 col-md-6">
									<div class="panel panel-green">
										<div class="panel-heading">
											<div class="row">
												<div class="col-xs-3">
													<i class="fa fa-clock-o fa-5x"></i>
												</div>
												<div class="col-xs-9 text-right">
													<div class="huge">',$overtime_accomplishments_offset,'</div>
													<div>Pending Overtime and Offset Requests!</div>
												</div>
											</div>
										</div>
										<a href="view_ot_accomplishment.php?searchby=0&search=&submit=search#mine">
											<div class="panel-footer">
												<span class="pull-left">View Details</span>
												<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
												<div class="clearfix"></div>
											</div>
										</a>
									</div>
								</div>
								<div class="col-lg-3 col-md-6">
									<div class="panel panel-yellow">
										<div class="panel-heading">
											<div class="row">
												<div class="col-xs-3">
													<i class="fa fa-globe fa-5x"></i>
												</div>
												<div class="col-xs-9 text-right">
													<div class="huge">',$data_official_business[0],'</div>
													<div>Pending Official Business (OB) Applications!</div>
												</div>
											</div>
										</div>
										<a href="view_ob_request.php?searchby=0&search=&submit=search#mine">
											<div class="panel-footer">
												<span class="pull-left">View Details</span>
												<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
												<div class="clearfix"></div>
											</div>
										</a>
									</div>
								</div>
								<div class="col-lg-3 col-md-6">
									<div class="panel panel-red">
										<div class="panel-heading">
											<div class="row">
												<div class="col-xs-3">
													<i class="fa fa-plane fa-5x"></i>
												</div>
												<div class="col-xs-9 text-right">
													<div class="huge">',$airticket_requisition,'</div>
													<div>Pending Equipment and Air Ticket Requests!</div>
												</div>
											</div>
										</div>
										<a href="view_requisition.php?searchby=0&search=&submit=search#mine">
											<div class="panel-footer">
												<span class="pull-left">View Details</span>
												<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
												<div class="clearfix"></div>
											</div>
										</a>
									</div>
								</div>
							</div>
							
							<div class="panel panel-default">
								<div class="panel-heading">
									<i class="fa fa-bell fa-fw"></i> Notifications Panel
								</div>
								<!-- /.panel-heading -->
								<div class="panel-body">
									<div class="list-group col-lg-6">
										<a href="view_leave_summary.php?searchby=0&search=&submit=search#mine" class="list-group-item">
											<i class="fa fa-share-square-o fa-fw"></i> ',$data_leave[0],' Leave Application/s
										</a>
										<a href="view_undertime_summary.php?searchby=0&search=&submit=search#mine" class="list-group-item">
											<i class="fa fa-dot-circle-o fa-fw"></i> ',$data_undertime[0],' Undertime Application/s
										</a>
										<a href="view_ot_accomplishment.php?searchby=0&search=&submit=search#mine" class="list-group-item">
											<i class="fa fa-clock-o fa-fw"></i> ',$data_overtime[0],' Overtime Request/s
										</a>
										<a href="view_ot_accomplishment.php?searchby=0&search=&submit=search#mine" class="list-group-item">
											<i class="fa fa-tasks fa-fw"></i> ',$data_accomplishments[0],' Overtime Request/s for Accomplishment
										</a>
									</div>
									<!-- /.list-group -->
									<div class="list-group col-lg-6 right">
										<a href="view_offset_request.php?searchby=0&search=&submit=search#mine" class="list-group-item">
											<i class="fa fa-retweet fa-fw"></i> ',$data_offset[0],' Offset Request/s
										</a>
										<a href="view_ob_request.php?searchby=0&search=&submit=search#mine" class="list-group-item">
											<i class="fa fa-globe fa-fw"></i> ',$data_official_business[0],' Official Business Application/s
										</a>
										<a href="view_requisition.php?searchby=0&search=&submit=search#mine" class="list-group-item">
											<i class="fa fa-shopping-cart fa-fw"></i> ',$data_requisition[0],' Equipment Requisition/s
										</a>
										<a href="view_airticket_request.php?searchby=0&search=&submit=search#mine" class="list-group-item">
											<i class="fa fa-plane fa-fw"></i> ',$data_airticket[0],' Air Ticket Request/s
										</a>
									</div>
								</div>
							</div>
							<!-- /.panel -->
							
						</div>';
			
	//----------------------------------------------------------------RIGHT TABLE--> for Pending Approvals
	//JD-2013/05/22 - Replaced all dept_code='$_SESSION[dept_code]' with b_manager_name='$_SESSION[fullname]' 
	//					to get the pending applications of a manager in one or more departments
		//-----> Start of modification
		//finding the leave under a specific manager------------------------------------------------------------------------------------------------
		//TL-2012/04/15 - Modified $q_oic to accommodate one employee as OIC for two or more depts. Added $man_oic.
		//JD-2012/09/20 - Modified $q_report to accomodate one manager as manager for one or more departments
		//JD-2013/05/22 - Changed dept_code='$_SESSION[dept_code]' to b.b_manager_name='$_SESSION[fullname]' after status clause'
		//				- Added LEFT JOIN ems_business_units b ON b.b_id = e.b_id to get manager name in business unit
		//JD-2014/03/18 - Replaced b.b_id=e.b_id with b.dept_code = e.dept_code
		$data_leave[0] = 0;
		$data_undertime[0] = 0;
		$data_overtime[0] = 0;
		$data_accomplishments[0] = 0;
		$data_offset[0] = 0;
		$data_official_business[0] = 0;
		$data_requisition[0] = 0;
		$data_airticket[0] = 0;
		
		$qry = mysql_query("SELECT COUNT(l.status), dept_name FROM ems_leave AS l 
								INNER JOIN ems_employee AS e ON e.emp_num = l.emp_num	
								INNER JOIN ems_department AS d ON e.dept_code = d.dept_code	
								INNER JOIN ems_users AS us ON e.emp_num = us.emp_num
								LEFT JOIN ems_business_units b ON b.dept_code = e.dept_code
								WHERE l.status='Pending' AND ((b.b_manager_name='$_SESSION[fullname]' AND rights!=2) 
								OR (e.dept_code IN ($q_oic) AND rights!=2) 
								OR (e.dept_code IN ($q_report) AND rights!=2)) $man_oic GROUP BY l.status ");
		$data_leave = mysql_fetch_array($qry);
		if( $data_leave[0] == 0){
			$data_leave[0] = 0;
		}
		
		//for undertime-----------------------------------------------------------------------------------------------------------------------------									
		//TL-2012/04/15 - Modified $q_oic to accommodate one employee as OIC for two or more depts. Added $man_oic.
		//JD-2012/09/20 - Modified $q_report to accomodate one manager as manager for one or more departments
		//JD-2013/05/22 - Changed dept_code='$_SESSION[dept_code]' to b.b_manager_name='$_SESSION[fullname]' after status clause'
		//				- Added LEFT JOIN ems_business_units b ON b.b_id = e.b_id to get manager name in business unit
		//JD-2014/03/18 - Replaced b.b_id=e.b_id with b.dept_code = e.dept_code
		$qry = mysql_query("SELECT COUNT(u.status), dept_name FROM ems_undertime AS u
								INNER JOIN ems_employee AS e ON e.emp_num = u.emp_num
								INNER JOIN ems_department AS d ON e.dept_code = d.dept_code
								INNER JOIN ems_users AS us ON e.emp_num = us.emp_num
								LEFT JOIN ems_business_units b ON b.dept_code = e.dept_code
								WHERE u.status='Pending' AND ((b.b_manager_name='$_SESSION[fullname]' AND rights!=2) 
								OR (e.dept_code IN ($q_oic) AND rights!=2) 
								OR (e.dept_code IN ($q_report) AND rights=2)) $man_oic GROUP BY u.status ");
		$data_undertime = mysql_fetch_array($qry);
		if( $data_undertime[0] == 0){
			$data_undertime[0] = 0;
		}
		
		//for overtime------------------------------------------------------------------------------------------------------------------------------
		//TL-2012/04/15 - Modified $q_oic to accommodate one employee as OIC for two or more depts.
		//JD-2012/09/20 - Modified $q_report to accomodate one manager as manager for one or more departments
		//JD-2013/05/22 - Changed dept_code='$_SESSION[dept_code]' to b.b_manager_name='$_SESSION[fullname]' after status clause
		//				- Added LEFT JOIN ems_business_units b ON b.b_id = e.b_id to get manager name in business unit
		//JD-2014/03/18 - Replaced b.b_id=e.b_id with b.dept_code = e.dept_code
		$qry = mysql_query("SELECT COUNT(o.status), dept_name FROM ems_ot AS o
								INNER JOIN ems_employee AS e ON e.emp_num = o.emp_num
								INNER JOIN ems_department AS d ON e.dept_code = d.dept_code
								INNER JOIN ems_users AS u ON e.emp_num = u.emp_num
								LEFT JOIN ems_business_units b ON b.dept_code = e.dept_code
								WHERE o.status='Pending' AND ((b.b_manager_name='$_SESSION[fullname]' AND rights!=2) 
								OR (e.dept_code IN($q_oic) AND rights!=2) 
								OR (e.dept_code IN ($q_report) AND rights=2)) $man_oic GROUP BY o.status ");
		$data_overtime = mysql_fetch_array($qry);
		if( $data_overtime[0] == 0){
			$data_overtime[0] = 0;
		}
		
		//for accomplishment------------------------------------------------------------------------------------------------------------------------
		//TL-2012/04/15 - Modified $q_oic to accommodate one employee as OIC for two or more depts.
		//JD-2012/09/20 - Modified $q_report to accomodate one manager as manager for one or more departments
		//JD-2013/05/22 - Changed dept_code='$_SESSION[dept_code]' to b.b_manager_name='$_SESSION[fullname]' after status clause
		//				- Added LEFT JOIN ems_business_units b ON b.b_id = e.b_id to get manager name in business unit
		//JD-2014/03/18 - Replaced b.b_id=e.b_id with b.dept_code = e.dept_code
		$qry = mysql_query("SELECT COUNT(a.status), dept_name FROM ems_ot as o
								INNER JOIN ems_employee as e ON e.emp_num = o.emp_num
								INNER JOIN ems_accomplishments as a ON a.ot_id = o.ot_id
								INNER JOIN ems_department as d ON e.dept_code = d.dept_code
								INNER JOIN ems_users AS u ON e.emp_num = u.emp_num
								LEFT JOIN ems_business_units b ON b.dept_code = e.dept_code
								WHERE a.status='Pending' AND ((d.dept_code='$_SESSION[dept_code]' AND rights!=2) 
								OR (e.dept_code IN ($q_oic) AND rights!=2) 
								OR (e.dept_code IN ($q_report) AND rights=2)) $man_oic GROUP BY a.status ");																				
		$data_accomplishment = mysql_fetch_array($qry);
		if( $data_accomplishment[0] == 0){
			$data_accomplishment[0] = 0;
		}
		
		//for offset--------------------------------------------------------------------------------------------------------------------------------
		//TL-2012/04/15 - Modified $q_oic to accommodate one employee as OIC for two or more depts.
		//JD-2012/09/20 - Modified $q_report to accomodate one manager as manager for one or more departments
		//JD-2013/05/22 - Changed dept_code='$_SESSION[dept_code]' to b.b_manager_name='$_SESSION[fullname]' after status clause
		//				- Added LEFT JOIN ems_business_units b ON b.b_id = e.b_id to get manager name in business unit
		//JD-2014/03/18 - Replaced b.b_id=e.b_id with b.dept_code = e.dept_code
		$qry = mysql_query("SELECT COUNT(o.status), dept_name FROM ems_offset_new AS o
								INNER JOIN ems_employee AS e ON e.emp_num = o.emp_num
								INNER JOIN ems_department AS d ON e.dept_code = d.dept_code
								INNER JOIN ems_users AS u ON e.emp_num = u.emp_num
								LEFT JOIN ems_business_units b ON b.dept_code = e.dept_code
								WHERE o.status='Pending' AND ((b.b_manager_name='$_SESSION[fullname]' AND rights!=2) 
								OR (e.dept_code IN($q_oic) AND rights!=2) 
								OR (e.dept_code IN ($q_report) AND rights=2)) $man_oic GROUP BY o.status ");			
		$data_offset = mysql_fetch_array($qry);
		if( $data_offset[0] == 0){
			$data_offset[0] = 0;
		}
		
		//for official business---------------------------------------------------------------------------------------------------------------------
		//OB requests for Confirmation
		//TL-2012/04/15 - Modified $q_oic to accommodate one employee as OIC for two or more depts.
		//JD-2012/09/20 - Modified $q_report to accomodate one manager as manager for one or more departments
		//JD-2013/05/22 - Changed dept_code='$_SESSION[dept_code]' to b.b_manager_name='$_SESSION[fullname]' after status clause
		//				- Added LEFT JOIN ems_business_units b ON b.b_id = e.b_id to get manager name in business unit
		//JD-2014/03/18 - Replaced b.b_id=e.b_id with b.dept_code = e.dept_code
		$qry = mysql_query("SELECT COUNT(o.status), dept_name FROM ems_ob_new AS o
								INNER JOIN ems_employee AS e ON e.emp_num = o.emp_num
								INNER JOIN ems_department AS d ON e.dept_code = d.dept_code
								INNER JOIN ems_users AS u ON e.emp_num = u.emp_num
								LEFT JOIN ems_business_units b ON b.dept_code = e.dept_code
								WHERE o.status='Pending for Confirmation' 
								AND ((b.b_manager_name='$_SESSION[fullname]' AND rights!=2) 
								OR (e.dept_code IN ($q_oic) AND rights!=2)
								OR (e.dept_code IN ($q_report) AND rights=2)) $man_oic GROUP BY o.status ");
		$data_ob_confirmation = mysql_fetch_array($qry);
		if( $data_ob_confirmation[0] == 0){
			$data_ob_confirmation[0] = 0;
		}
		
		//OB requests for Approval
		//JD-2013/05/22 - Changed dept_code='$_SESSION[dept_code]' to b.b_manager_name='$_SESSION[fullname]' after status clause
		//				- Added LEFT JOIN ems_business_units b ON b.b_id = e.b_id to get manager name in business unit
		//JD-2014/03/18 - Replaced b.b_id=e.b_id with b.dept_code = e.dept_code
		$qry = mysql_query("SELECT COUNT(o.status), dept_name FROM ems_ob_new AS o
								INNER JOIN ems_employee AS e ON e.emp_num = o.emp_num
								INNER JOIN ems_department AS d ON e.dept_code = d.dept_code
								INNER JOIN ems_users AS u ON e.emp_num = u.emp_num	
								LEFT JOIN ems_business_units b ON b.dept_code = e.dept_code
								WHERE o.status='Pending for Approval' AND ((b.b_manager_name='$_SESSION[fullname]' 
								AND rights!=2) OR (e.dept_code IN($q_oic) AND rights!=2) 
								OR (e.dept_code IN ($q_report) AND rights=2)) $man_oic GROUP BY o.status ");
		$data_ob_approval = mysql_fetch_array($qry);
		if( $data_ob_approval[0] == 0){
			$data_ob_approval[0] = 0;
		}

		//for requisition-----------------------------------------------------------------------------------------------------------------------
		//TL-2012/04/15 - Modified $q_oic to accommodate one employee as OIC for two or more depts.
		//JD-2012/09/20 - Modified $q_report to accomodate one manager as manager for one or more departments
		//JD-2013/05/22 - Changed dept_code='$_SESSION[dept_code]' to b.b_manager_name='$_SESSION[fullname]' after status clause
		//				- Added LEFT JOIN ems_business_units b ON b.b_id = e.b_id to get manager name in business unit
		$qry = mysql_query("SELECT COUNT(r.status), dept_name FROM ems_equip_requisitions AS r
								INNER JOIN ems_employee AS e ON e.emp_num = r.emp_num
								INNER JOIN ems_department AS d ON e.dept_code = d.dept_code
								INNER JOIN ems_users AS u ON e.emp_num = u.emp_num
								LEFT JOIN ems_business_units b ON b.dept_code = e.dept_code
								WHERE r.status='Pending' AND ((b.b_manager_name='$_SESSION[fullname]'
								AND rights!=2) OR (e.dept_code IN($q_oic) AND rights!=2)
								OR (e.dept_code IN ($q_report) AND rights=2)) $man_oic GROUP BY r.status ");
		$data_requisition = mysql_fetch_array($qry);
		if( $data_requisition[0] == 0){
			$data_requisition[0] = 0;
		}

		//for Airticket-----------------------------------------------------------------------------------------------------------------------------
		if($_SESSION['rights']==4){
			//JD-2014/02/22 - Changed condition status = 'Confirmed' OR status = 'Confirmed for Re-booking' to status = 'Approved'
			// $qry = mysql_query("SELECT COUNT(STATUS) FROM ems_air_ticket 
			// 							WHERE (status='Confirmed' AND state='1') 
			// 							OR (status='Confirmed for Re-booking' 
			// 							AND state='5') GROUP BY status ");
			$qry = mysql_query("SELECT COUNT(STATUS) FROM ems_air_ticket 
									WHERE (status='Approved' AND state='1') 
									OR (status='Confirmed for Re-booking' 
									AND state='5') GROUP BY status ");
			$data_airticket = mysql_fetch_array($qry);
			if( $data_airticket[0] == 0){
				$data_airticket[0] = 0;
			}
			
			/*$qry = mysql_query("SELECT COUNT(STATUS) FROM ems_air_ticket WHERE status='Reviewed' AND state='2' GROUP BY status ");
			$data = mysql_fetch_array($qry);
					if( $data[0]!=0){
						echo '<li><a href="view_airticket_request.php">',"You have ".$data[0]." airticket request/s for checking.",'</a></li>';
					}else{
						$sales_ad++;
					}*/
		}else{
				//JD-2012/09/20 - Modified $q_report to accomodate one manager as manager for one or more departments
				//JD-2013/05/22 - Changed dept_code='$_SESSION[dept_code]' to b.b_manager_name='$_SESSION[fullname]' after status clause
				//				- Added LEFT JOIN ems_business_units b ON b.b_id = e.b_id to get manager name in business unit
			$qry = mysql_query("SELECT COUNT(a.status), dept_name FROM ems_air_ticket AS a
									INNER JOIN ems_employee AS e ON e.emp_num = a.emp_num
									INNER JOIN ems_department AS d ON e.dept_code = d.dept_code
									INNER JOIN ems_users AS u ON e.emp_num = u.emp_num	
									LEFT JOIN ems_business_units b ON b.dept_code = e.dept_code
									WHERE (a.status='Pending' OR a.status='Pending for Re-booking') 
									AND ((b.b_manager_name='$_SESSION[fullname]' AND rights!=2) OR (e.dept_code IN($q_oic) 
									AND rights!=2) OR (e.dept_code IN ($q_report) AND rights=2) $man_oic) GROUP BY a.status ");
			$data_airticket = mysql_fetch_array($qry);
			if( $data_airticket[0] == 0){
				$data_airticket[0] = 0;
			}
		}
					
		$leave_undertime = $data_leave[0] + $data_undertime[0];
		$overtime_accomplishments_offset = $data_overtime[0] + $data_accomplishments[0] + $data_offset[0];
		$official_business = $data_ob_confirmation[0] + $data_ob_approval[0];
		$airticket_requisition = $data_airticket[0] + $data_requisition[0];
		
		echo
						'<div role="tabpanel" class="tab-pane index" id="pending-approvals">
							<div class="row">
								<div class="col-lg-3 col-md-6">
									<div class="panel panel-primary">
										<div class="panel-heading">
											<div class="row">
												<div class="col-xs-3">
													<i class="fa fa-dot-circle-o fa-5x"></i>
												</div>
												<div class="col-xs-9 text-right">
													<div class="huge">',$leave_undertime,'</div>
													<div>Pending Leave/Undertime Applications!</div>
												</div>
											</div>
										</div>
										<a href="view_leave_summary.php?searchby=0&search=&submit=search_lv#theirs">
											<div class="panel-footer">
												<span class="pull-left">View Details</span>
												<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
												<div class="clearfix"></div>
											</div>
										</a>
									</div>
								</div>
								<div class="col-lg-3 col-md-6">
									<div class="panel panel-green">
										<div class="panel-heading">
											<div class="row">
												<div class="col-xs-3">
													<i class="fa fa-clock-o fa-5x"></i>
												</div>
												<div class="col-xs-9 text-right">
													<div class="huge">',$overtime_accomplishments_offset,'</div>
													<div>Pending Overtime and Offset Requests!</div>
												</div>
											</div>
										</div>
										<a href="view_ot_accomplishment.php?searchby=0&search=&submit=search#theirs">
											<div class="panel-footer">
												<span class="pull-left">View Details</span>
												<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
												<div class="clearfix"></div>
											</div>
										</a>
									</div>
								</div>
								<div class="col-lg-3 col-md-6">
									<div class="panel panel-yellow">
										<div class="panel-heading">
											<div class="row">
												<div class="col-xs-3">
													<i class="fa fa-globe fa-5x"></i>
												</div>
												<div class="col-xs-9 text-right">
													<div class="huge">',$official_business,'</div>
													<div>Pending Official Business (OB) Applications!</div>
												</div>
											</div>
										</div>
										<a href="view_ob_request.php?searchby=0&search=&submit=search#theirs">
											<div class="panel-footer">
												<span class="pull-left">View Details</span>
												<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
												<div class="clearfix"></div>
											</div>
										</a>
									</div>
								</div>
								<div class="col-lg-3 col-md-6">
									<div class="panel panel-red">
										<div class="panel-heading">
											<div class="row">
												<div class="col-xs-3">
													<i class="fa fa-plane fa-5x"></i>
												</div>
												<div class="col-xs-9 text-right">
													<div class="huge">',$airticket_requisition,'</div>
													<div>Pending Equipment and Air Ticket Requests!</div>
												</div>
											</div>
										</div>
										<a href="view_requisition.php?searchby=0&search=&submit=search#theirs">
											<div class="panel-footer">
												<span class="pull-left">View Details</span>
												<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
												<div class="clearfix"></div>
											</div>
										</a>
									</div>
								</div>
							</div>
							
							<div class="panel panel-default">
								<div class="panel-heading">
									<i class="fa fa-bell fa-fw"></i> Notifications Panel
								</div>
								<!-- /.panel-heading -->
								<div class="panel-body">
									<div class="list-group col-lg-6">
										<a href="view_leave_summary.php?searchby=0&search=&submit=search_lv#theirs" class="list-group-item">
											<i class="fa fa-share-square-o fa-fw"></i> ',$data_leave[0],' Leave Application/s for Approval
										</a>
										<a href="view_undertime_summary.php?searchby=0&search=&submit=search_lv#theirs" class="list-group-item">
											<i class="fa fa-dot-circle-o fa-fw"></i> ',$data_undertime[0],' Undertime Application/s for Approval
										</a>
										<a href="view_ot_accomplishment.php?searchby=0&search=&submit=search#theirs" class="list-group-item">
											<i class="fa fa-clock-o fa-fw"></i> ',$data_overtime[0],' Overtime Request/s for Approval
										</a>
										<a href="view_ot_accomplishment.php?searchby=0&search=&submit=search#theirs" class="list-group-item">
											<i class="fa fa-tasks fa-fw"></i> ',$data_accomplishments[0],' Accomplishment Report/s for Approval
										</a>
										<a href="view_offset_request.php?searchby=0&search=&submit=search#theirs" class="list-group-item">
											<i class="fa fa-retweet fa-fw"></i> ',$data_offset[0],' Offset Request/s for Approval
										</a>
									</div>
									<!-- /.list-group -->
									<div class="list-group col-lg-6 right">
										<a href="view_ob_request.php?searchby=0&search=&submit=search#theirs" class="list-group-item">
											<i class="fa fa-globe fa-fw"></i> ',$data_ob_confirmation[0],' Official Business Application/s for Confirmation
										</a>
										<a href="view_ob_request.php?searchby=0&search=&submit=search#theirs" class="list-group-item">
											<i class="fa fa-globe fa-fw"></i> ',$data_ob_approval[0],' Official Business Application/s for Approval
										</a>
										<a href="view_requisition.php?searchby=0&search=&submit=search#theirs" class="list-group-item">
											<i class="fa fa-shopping-cart fa-fw"></i> ',$data_requisition[0],' Equipment Requisition/s for Approval
										</a>
										<a href="view_airticket_request.php?searchby=0&search=&submit=search#theirs" class="list-group-item">
											<i class="fa fa-plane fa-fw"></i> ',$data_airticket[0],' Air Ticket Request/s for Booking
										</a>
									</div>
								</div>
							</div>
							<!-- /.panel -->
						</div>
					</div>
				</div>
			';
?>