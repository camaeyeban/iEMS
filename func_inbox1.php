<?php
		/*JD-2013/01/25 - Hide Equipment Reservation Applications
		echo '<li>Equipment Reservation</li>';
		echo '<ul style="list-style-type:square">';
		
		$qry = mysql_query("SELECT COUNT('status') FROM ems_equip_requests WHERE status='Pending' ");
		$data = mysql_fetch_array($qry);
			if( $data[0]!=0){
				echo '<li><a href="view_reservation.php">',"You have ".$data[0]." equipment reservation/s for approval.",'</a></li>';
			}else{
				echo '<li>No pending approval.</li>';
			}
				
		echo '</ul>';	
		echo '<li><hr/></li>';
		*/
		$qry = mysql_query("SELECT COUNT('status')
								FROM ems_equip_requisitions
								WHERE status='Approved'");
		$data_req = mysql_fetch_array($qry);
		if( $data_req[0]==0){
			$data_req[0] = 0;
		}
		
		$qry = mysql_query("SELECT COUNT('code')
								FROM ems_employee AS e
                                LEFT JOIN ems_emp_status AS s ON e.code = s.code
								WHERE s.name='Regular'");
		$data_regular = mysql_fetch_array($qry);
		if( $data_regular[0]==0){
			$data_regular[0] = 0;
		}
		
		$qry = mysql_query("SELECT COUNT('code')
								FROM ems_employee AS e
                                LEFT JOIN ems_emp_status AS s ON e.code = s.code
								WHERE s.name='Probationary'");
		$data_probationary = mysql_fetch_array($qry);
		if( $data_probationary[0]==0){
			$data_probationary[0] = 0;
		}
		
		$qry = mysql_query("SELECT COUNT('code')
								FROM ems_employee AS e
                                LEFT JOIN ems_emp_status AS s ON e.code = s.code
								WHERE s.name='Consultant'");
		$data_consultant = mysql_fetch_array($qry);
		if( $data_consultant[0]==0){
			$data_consultant[0] = 0;
		}
		
		$qry = mysql_query("SELECT COUNT('code')
								FROM ems_employee AS e
                                LEFT JOIN ems_emp_status AS s ON e.code = s.code
								WHERE s.name='Casual'");
		$data_casual = mysql_fetch_array($qry);
		if( $data_casual[0]==0){
			$data_casual[0] = 0;
		}
		
		
		/*echo '<li>Air Ticket</li>';
		echo '<ul style="list-style-type:square">';		
		$qry = mysql_query("SELECT COUNT(STATUS) FROM ems_air_ticket WHERE status='Pending' AND state='0' GROUP BY status ");
		$data = mysql_fetch_array($qry);
			if( $data[0]!=0){
				echo '<li><a href="view_airticket_request.php">',"You have ".$data[0]." air ticket application/s for checking.",'</a></li>';
			}else{
				echo '<li>No pending approval.</li>';
			}
			
		echo '</ul>';
		echo '<li><hr/></li>';/**/
		echo
			'
				<div class="col-lg-12">
					<div class="panel-body top-bordered col-lg-12">
						<h2 class="summary-title">Manpower Complement</h2>
						<div class="table-buttons row">
							<a class="equip-button pull-right btn btn-primary" href="view_requisition.php">
								<span class="glyphicon glyphicon-shopping-cart"></span>  ',$data_req[0],' Equipment Requisition(s) to Process
							</a>
						</div>
						<div class="row">
							<div class="col-lg-3 col-md-6">
								<div class="panel panel-primary">
									<div class="panel-heading">
										<div class="row">
											<div class="col-xs-3">
												<i class="fa fa-user fa-5x"></i>
											</div>
											<div class="col-xs-9 text-right">
												<div class="huge">',$data_regular[0],'</div>
												<div>Regular Employees</div>
											</div>
										</div>
									</div>
									<a class="view-details" data-toggle="modal" data-target="#regular_breakdown">
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
												<i class="fa fa-user fa-5x"></i>
											</div>
											<div class="col-xs-9 text-right">
												<div class="huge">',$data_probationary[0],'</div>
												<div>Probationary Employees</div>
											</div>
										</div>
									</div>
									<a class="view-details" data-toggle="modal" data-target="#probationary_breakdown">
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
												<i class="fa fa-user fa-5x"></i>
											</div>
											<div class="col-xs-9 text-right">
												<div class="huge">',$data_consultant[0],'</div>
												<div>Consultant Employees</div>
											</div>
										</div>
									</div>
									<a class="view-details" data-toggle="modal" data-target="#consultant_breakdown">
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
												<i class="fa fa-user fa-5x"></i>
											</div>
											<div class="col-xs-9 text-right">
												<div class="huge">',$data_casual[0],'</div>
												<div>Casual Employees</div>
											</div>
										</div>
									</div>
									<a class="view-details" data-toggle="modal" data-target="#casual_breakdown">
										<div class="panel-footer">
											<span class="pull-left">View Details</span>
											<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
											<div class="clearfix"></div>
										</div>
									</a>
								</div>
							</div>
						</div> <!-- row -->
						
						
					</div> <!-- panel-body -->

				</div> <!-- col-lg-12 -->
			</div> <!-- container --> 
			
			
			<div class="modal fade" id="regular_breakdown" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="left: 3;">
				<div class="modal-dialog modal-lg">
					<div class="modal-content">
						<div class="modal-header">
							<span class="modal-title">Regular Employees</span>
						</div>
						<div class="modal-body">
							<table class="table table-striped table-bordered table-hover" id="regular-breakdown-table">
								<thead>
									<tr>
										<th class="table-column-names">Department</th>
										<th class="table-column-names">Count</th>
									</tr>
								</thead>
								<tbody>
		';
							
									$str = "SELECT d.dept_name, COUNT('code')
												 FROM ems_employee AS e
												 LEFT JOIN ems_emp_status AS s ON e.code = s.code
												 LEFT JOIN ems_department AS d ON e.dept_code = d.dept_code
												 WHERE s.name='Regular'
												 GROUP BY dept_name";
									$qry = mysql_query($str);
									
									while($regular_breakdown = mysql_fetch_array($qry)){
										echo '<tr>';
										echo '<td>',$regular_breakdown[0],'</td>';
										echo '<td>',$regular_breakdown[1],'</td>';
										echo '</tr>';
									}
		echo'
								</tbody>
							</table>
						</div>
						<div class="modal-footer">	
							<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						</div>
					</div>
				</div>
			</div>
		';
		
		echo '
			<div class="modal fade" id="probationary_breakdown" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="left: 3;">
				<div class="modal-dialog modal-lg">
					<div class="modal-content">
						<div class="modal-header">
							<span class="modal-title">Probationary Employees</span>
						</div>
						<div class="modal-body">
							<table class="table table-striped table-bordered table-hover" id="probationary-breakdown-table">
								<thead>
									<tr>
										<th class="table-column-names">Department</th>
										<th class="table-column-names">Count</th>
									</tr>
								</thead>
								<tbody>
		';
							
									$str = "SELECT d.dept_name, COUNT('code')
												 FROM ems_employee AS e
												 LEFT JOIN ems_emp_status AS s ON e.code = s.code
												 LEFT JOIN ems_department AS d ON e.dept_code = d.dept_code
												 WHERE s.name='Probationary'
												 GROUP BY dept_name";
									$qry = mysql_query($str);
									
									while($probationary_breakdown = mysql_fetch_array($qry)){
										echo '<tr>';
										echo '<td>',$probationary_breakdown[0],'</td>';
										echo '<td>',$probationary_breakdown[1],'</td>';
										echo '</tr>';
									}
		echo '
								</tbody>
							</table>
						</div>
						<div class="modal-footer">	
							<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						</div>
					</div>
				</div>
			</div>
		';
		
		
		echo '
			<div class="modal fade" id="consultant_breakdown" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="left: 3;">
				<div class="modal-dialog modal-lg">
					<div class="modal-content">
						<div class="modal-header">
							<span class="modal-title">Consultant Employees</span>
						</div>
						<div class="modal-body">
							<table class="table table-striped table-bordered table-hover" id="consultant-breakdown-table">
								<thead>
									<tr>
										<th class="table-column-names">Department</th>
										<th class="table-column-names">Count</th>
									</tr>
								</thead>
								<tbody>
		';
							
									$str = "SELECT d.dept_name, COUNT('code')
												 FROM ems_employee AS e
												 LEFT JOIN ems_emp_status AS s ON e.code = s.code
												 LEFT JOIN ems_department AS d ON e.dept_code = d.dept_code
												 WHERE s.name='Consultant'
												 GROUP BY dept_name";
									$qry = mysql_query($str);
									
									while($consultant_breakdown = mysql_fetch_array($qry)){
										echo '<tr>';
										echo '<td>',$consultant_breakdown[0],'</td>';
										echo '<td>',$consultant_breakdown[1],'</td>';
										echo '</tr>';
									}
		echo '
								</tbody>
							</table>
						</div>
						<div class="modal-footer">	
							<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						</div>
					</div>
				</div>
			</div>
		';
		
		
		echo '
			<div class="modal fade" id="casual_breakdown" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="left: 3;">
				<div class="modal-dialog modal-lg">
					<div class="modal-content">
						<div class="modal-header">
							<span class="modal-title">Casual Employees</span>
						</div>
						<div class="modal-body">
							<table class="table table-striped table-bordered table-hover" id="casual-breakdown-table">
								<thead>
									<tr>
										<th class="table-column-names">Department</th>
										<th class="table-column-names">Count</th>
									</tr>
								</thead>
								<tbody>
		';
							
									$str = "SELECT d.dept_name, COUNT('code')
												 FROM ems_employee AS e
												 LEFT JOIN ems_emp_status AS s ON e.code = s.code
												 LEFT JOIN ems_department AS d ON e.dept_code = d.dept_code
												 WHERE s.name='Casual'
												 GROUP BY dept_name";
									$qry = mysql_query($str);
									
									while($casual_breakdown = mysql_fetch_array($qry)){
										echo '<tr>';
										echo '<td>',$casual_breakdown[0],'</td>';
										echo '<td>',$casual_breakdown[1],'</td>';
										echo '</tr>';
									}
		echo '
								</tbody>
							</table>
						</div>
						<div class="modal-footer">	
							<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						</div>
					</div>
				</div>
		';
?>