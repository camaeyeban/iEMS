<?php
	$qry = mysql_query("SELECT COUNT(status), leave_id 
							FROM ems_leave WHERE status='Pending' 
							AND emp_num='$_SESSION[emp_num]' GROUP BY status");
	$data_leave = mysql_fetch_array($qry);
	if($data_leave[0]==0){
		$data_leave[0] = 0;
	}
	
	//for undertime-------------------------------------------------------------------------------------------------------------------------					
	$qry = mysql_query("SELECT COUNT(status), un_id FROM ems_undertime 
							WHERE status='Pending' and emp_num='$_SESSION[emp_num]' GROUP BY status");
	$data_undertime = mysql_fetch_array($qry);
	if($data_undertime[0]==0){
		$data_undertime[0] = 0;
	}
	
	//for overtime--------------------------------------------------------------------------------------------------------------------------		
	$qry = mysql_query("SELECT COUNT(status), ot_id FROM ems_ot WHERE status='Pending' and emp_num='$_SESSION[emp_num]' GROUP BY status");
	$data_overtime = mysql_fetch_array($qry);
	if($data_overtime[0]==0){
		$data_overtime[0] = 0;
	}
	
	//for accomplishments-------------------------------------------------------------------------------------------------------------------
	$qry = mysql_query("SELECT COUNT(a.status), a.ot_id FROM ems_accomplishments as a
								INNER JOIN ems_ot as o ON a.ot_id = o.ot_id
								WHERE o.status='Approved' AND a.status='Pending' 
								AND emp_num='$_SESSION[emp_num]' GROUP BY a.status");
	$data_accomplishments = mysql_fetch_array($qry);
	if($data_accomplishments[0]==0){
		$data_accomplishments[0] = 0;
	}
	
	//for offset----------------------------------------------------------------------------------------------------------------------------
	$qry = mysql_query("SELECT COUNT(status), offset_id FROM ems_offset_new
							WHERE status='Pending' and emp_num='$_SESSION[emp_num]' GROUP BY status");
	$data_offset = mysql_fetch_array($qry);
	if($data_offset[0]==0){
		$data_offset[0] = 0;
	}
	
	//for official business-----------------------------------------------------------------------------------------------------------------
	$qry = mysql_query("SELECT (SELECT COUNT(status) FROM ems_ob_new
							WHERE (status='Pending for Confirmation' OR status='Pending for Approval') 
							AND emp_num='$_SESSION[emp_num]') ,ob_id FROM ems_ob_new GROUP BY status");
	$data_official_business = mysql_fetch_array($qry);
	if($data_official_business[0]==0){
		$data_official_business[0] = 0;
	}
	
	//for equipment reservation-------------------------------------------------------------------------------------------------------------
	/*JD-2013/01/25 - Hide Equipment Reservation notification
	$qry = mysql_query("SELECT COUNT(status), erqst_id FROM ems_equip_requests
								WHERE status='Pending' and emp_num='$_SESSION[emp_num]' GROUP BY status");
	$data = mysql_fetch_array($qry);
			if( $data[0]!=0){
				echo '<li><a href="view_edit_equip.php">',"You have ".$data[0]." equipment reservation/s.",'</a></li>';
			}else{
				$ad++;
			}
	*/

	//for requisition-----------------------------------------------------------------------------------------------------------------------
	$qry = mysql_query("SELECT COUNT(status), erqstn_id FROM ems_equip_requisitions 
							WHERE status='Pending' and emp_num='$_SESSION[emp_num]' GROUP BY status");
	$data_requisition = mysql_fetch_array($qry);
	if($data_requisition[0]==0){
		$data_requisition[0] = 0;
	}	
						
	//for airticket-------------------------------------------------------------------------------------------------------------------------
	$qry = mysql_query("SELECT COUNT(status), at_id FROM ems_air_ticket 
							WHERE status='Pending' and emp_num='$_SESSION[emp_num]' GROUP BY status");
	$data_airticket = mysql_fetch_array($qry);
	if($data_airticket[0]==0){
		$data_airticket[0] = 0;
	}
	
	//----------------------------------------------- ui -------------------------------------------
	
	$leave_undertime = $data_leave[0] + $data_undertime[0];
	$overtime_accomplishments_offset = $data_overtime[0] + $data_accomplishments[0] + $data_offset[0];
	$airticket_requisition = $data_airticket[0] + $data_requisition[0];
	echo
		'
			<div class="col-lg-12">
				<div class="panel-body top-bordered col-lg-12">
					<h2 class="summary-title">Pending Applications</h2>
			
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
											<div class="huge">',$data_official_business[0],'</div>
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
								<a href="leave_undr_summary.php#leave-summary" class="list-group-item">
									<i class="fa fa-share-square-o fa-fw"></i> ',$data_leave[0],' Leave Application/s
								</a>
								<a href="leave_undr_summary.php#undertime-summary" class="list-group-item">
									<i class="fa fa-dot-circle-o fa-fw"></i> ',$data_undertime[0],' Undertime Application/s
								</a>
								<a href="view_ot_request.php" class="list-group-item">
									<i class="fa fa-clock-o fa-fw"></i> ',$data_overtime[0],' Overtime Request/s
								</a>
								<a href="view_ot_request.php" class="list-group-item">
									<i class="fa fa-tasks fa-fw"></i> ',$data_accomplishments[0],' Accomplishment Application/s
								</a>
							</div>
							<!-- /.list-group -->
							<div class="list-group col-lg-6 right">
								<a href="view_edit_offset.php" class="list-group-item">
									<i class="fa fa-retweet fa-fw"></i> ',$data_offset[0],' Offset Request/s
								</a>
								<a href="view_edit_ob.php" class="list-group-item">
									<i class="fa fa-globe fa-fw"></i> ',$data_official_business[0],' Official Business Application/s
								</a>
								<a href="view_edit_requisition.php" class="list-group-item">
									<i class="fa fa-shopping-cart fa-fw"></i> ',$data_requisition[0],' Equipment Requisition/s
								</a>
								<a href="view_edit_airticket.php" class="list-group-item">
									<i class="fa fa-plane fa-fw"></i> ',$data_airticket[0],' Air Ticket Request/s
								</a>
							</div>
						</div>
						
					</div> <!-- panel -->
					
				</div> <!-- panel-body -->

			</div> <!-- col-lg-12 -->
		';
?>