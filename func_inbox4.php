<?php
		//for leave-----------------------------------------------------------------------------------------------------------------------------
		//After l.status='Pending' AND b.report_to='None'
		$qry = mysql_query("SELECT COUNT(l.status) FROM ems_leave AS l
								INNER JOIN ems_employee AS e
								ON e.emp_num = l.emp_num
								INNER JOIN ems_users AS u
								ON e.emp_num = u.emp_num
								INNER JOIN ems_business_units AS b
								ON e.dept_code = b.dept_code
								WHERE (u.rights=2 OR u.rights=4) AND l.status='Pending' 
								GROUP BY l.status ");
		$data_leave = mysql_fetch_array($qry);
		if($data_leave[0]==0){
			$data_leave[0] = 0;
		}
		//for undertime-------------------------------------------------------------------------------------------------------------------------									
		$qry = mysql_query("SELECT COUNT(u.status) FROM ems_undertime AS u
								INNER JOIN ems_employee AS e
								ON e.emp_num = u.emp_num
								INNER JOIN ems_users AS us
								ON e.emp_num = us.emp_num
								WHERE u.status='Pending' AND (rights=2 OR rights=4)
								GROUP BY u.status ");
		$data_undertime = mysql_fetch_array($qry);
		if($data_undertime[0]==0){
			$data_undertime[0] = 0;
		}
			
		//for overtime--------------------------------------------------------------------------------------------------------------------------
		$qry = mysql_query("SELECT COUNT(o.status) FROM ems_ot AS o
								INNER JOIN ems_employee AS e
								ON e.emp_num = o.emp_num
								INNER JOIN ems_users AS u
								ON e.emp_num = u.emp_num
								WHERE o.status='Pending' AND (rights=2 OR rights=4)
								GROUP BY o.status");
		$data_overtime = mysql_fetch_array($qry);
		if($data_overtime[0]==0){
			$data_overtime[0] = 0;
		}
										
		//for accomplishment--------------------------------------------------------------------------------------------------------------------
		$qry = mysql_query("SELECT COUNT(a.status) FROM ems_ot as o
								INNER JOIN ems_employee as e
								ON e.emp_num = o.emp_num
								INNER JOIN ems_accomplishments as a
								ON a.ot_id = o.ot_id
								INNER JOIN ems_users AS u
								ON e.emp_num = u.emp_num
								WHERE a.status='Pending' AND (rights=2 OR rights=4)
								GROUP BY a.status ");																	
		$data_accomplishments = mysql_fetch_array($qry);
		if($data_accomplishments[0]==0){
			$data_accomplishments[0] = 0;
		}
																													
		//for offset----------------------------------------------------------------------------------------------------------------------------
		$qry = mysql_query("SELECT COUNT(o.status) FROM ems_offset_new AS o
								INNER JOIN ems_employee AS e
								ON e.emp_num = o.emp_num
								INNER JOIN ems_users AS u
								ON e.emp_num = u.emp_num
								WHERE o.status='Pending' AND (rights=2 OR rights=4)
								GROUP BY o.status ");	
		$data_offset = mysql_fetch_array($qry);
		if($data_offset[0]==0){
			$data_offset[0] = 0;
		}
		
		//for official business-----------------------------------------------------------------------------------------------------------------
		$qry = mysql_query("SELECT COUNT(o.status) FROM ems_ob_new AS o
								INNER JOIN ems_employee AS e
								ON e.emp_num = o.emp_num
								INNER JOIN ems_users AS u
								ON e.emp_num = u.emp_num
								WHERE o.status='Pending for Confirmation' AND (rights=2 OR rights=4)
								GROUP BY o.status ");	
		$data_ob_confirmation = mysql_fetch_array($qry);
		if($data_ob_confirmation[0]==0){
			$data_ob_confirmation[0] = 0;
		}

		$qry = mysql_query("SELECT COUNT(o.status) FROM ems_ob_new AS o
								INNER JOIN ems_employee AS e
								ON e.emp_num = o.emp_num
								INNER JOIN ems_users AS u
								ON e.emp_num = u.emp_num
								WHERE o.status='Pending for Approval' AND (rights=2 OR rights=4)
								GROUP BY o.status ");	
		$data_ob_approval = mysql_fetch_array($qry);
		if($data_ob_approval[0]==0){
			$data_ob_approval[0] = 0;
		}
		
		//for requisition-----------------------------------------------------------------------------------------------------------------------
		$qry = mysql_query("SELECT COUNT(r.status) FROM ems_equip_requisitions AS r
								INNER JOIN ems_employee AS e
								ON e.emp_num = r.emp_num
								INNER JOIN ems_users AS u
								ON e.emp_num = u.emp_num
								WHERE r.status='Pending' AND (rights=2 OR rights=4)
								GROUP BY r.status ");	
		$data_requisition = mysql_fetch_array($qry);
		if($data_requisition[0]==0){
			$data_requisition[0] = 0;
		}
		
		//for Airticket-------------------------------------------------------------------------------------------------------------------------
		$qry = mysql_query("SELECT COUNT(a.status) FROM ems_air_ticket AS a
								INNER JOIN ems_employee AS e
								ON e.emp_num = a.emp_num
								INNER JOIN ems_users AS u
								ON e.emp_num = u.emp_num
								WHERE (a.status='Pending' OR a.status='Pending for Re-booking') AND (rights=2 OR rights=4)
								GROUP BY a.status ");	
		$data_airticket = mysql_fetch_array($qry);
		if($data_airticket[0]==0){
			$data_airticket[0] = 0;
		}
				
		$leave_undertime = $data_leave[0] + $data_undertime[0];
		$overtime_accomplishments_offset = $data_overtime[0] + $data_accomplishments[0] + $data_offset[0];
		$official_business = $data_ob_confirmation[0] + $data_ob_approval[0];
		$airticket_requisition = $data_airticket[0] + $data_requisition[0];
		
		echo
			'<div id="container">
				
				<div class="col-lg-12">
					<div class="panel-body top-bordered col-lg-12">
						<h2 class="summary-title">Pending Approvals</h2>
				
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
									<a href="leave_undr_summary.php">
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
									<a href="view_ot_request.php">
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
									<a href="view_edit_ob.php">
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
									<a href="view_edit_requisition.php">
										<div class="panel-footer">
											<span class="pull-left">View Details</span>
											<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
											<div class="clearfix"></div>
										</div>
									</a>
								</div>
							</div>
						</div> <!-- row -->
						
							<div class="panel panel-default">
								<div class="panel-heading">
									<i class="fa fa-bell fa-fw"></i> Notifications Panel
								</div>
								<!-- /.panel-heading -->
								<div class="panel-body">
									<div class="list-group col-lg-6">
										<a href="view_leave_undr.php?searchby=0&search=&submit=search_lv" class="list-group-item">
											<i class="fa fa-share-square-o fa-fw"></i> ',$data_leave[0],' Leave Application/s for Approval
										</a>
										<a href="view_leave_undr.php?searchby=0&search=&submit=search_lv" class="list-group-item">
											<i class="fa fa-dot-circle-o fa-fw"></i> ',$data_undertime[0],' Undertime Application/s for Approval
										</a>
										<a href="view_ot_accomplishment.php?searchby=0&search=&submit=search" class="list-group-item">
											<i class="fa fa-clock-o fa-fw"></i> ',$data_overtime[0],' Overtime Request/s for Approval
										</a>
										<a href="view_ot_accomplishment.php?searchby=0&search=&submit=search" class="list-group-item">
											<i class="fa fa-tasks fa-fw"></i> ',$data_accomplishments[0],' Accomplishment Report/s for Approval
										</a>
										<a href="view_offset_request.php?searchby=0&search=&submit=search" class="list-group-item">
											<i class="fa fa-retweet fa-fw"></i> ',$data_offset[0],' Offset Request/s for Approval
										</a>
									</div>
									<!-- /.list-group -->
									<div class="list-group col-lg-6 right">
										<a href="view_ob_request.php?searchby=0&search=&submit=search" class="list-group-item">
											<i class="fa fa-globe fa-fw"></i> ',$data_ob_confirmation[0],' Official Business Application/s for Confirmation
										</a>
										<a href="view_ob_request.php?searchby=0&search=&submit=search" class="list-group-item">
											<i class="fa fa-globe fa-fw"></i> ',$data_ob_approval[0],' Official Business Application/s for Approval
										</a>
										<a href="view_requisition.php?searchby=0&search=&submit=search" class="list-group-item">
											<i class="fa fa-shopping-cart fa-fw"></i> ',$data_requisition[0],' Equipment Requisition/s for Approval
										</a>
										<a href="view_airticket_request.php?searchby=0&search=&submit=search" class="list-group-item">
											<i class="fa fa-plane fa-fw"></i> ',$data_airticket[0],' Air Ticket Request/s for Booking
										</a>
									</div>
								</div>
							</div> <!-- panel -->
						
					</div> <!-- panel-body -->

				</div> <!-- col-lg-12 -->
			</div> <!-- container --> ';
?>