<?php
	session_start();
	ini_set('session.bug_compat_42',0);
	ini_set('session.bug_compat_warn',0);

	include("config_DB.php");
	require("mysql_db_connect.inc.php");
	$dblink = new mysql_db_connect();

	if (!$dblink)
		die("no connection");
	
	include("functions.php");
	chk_active($_SESSION['user_id']);
	
	if(!isset($_SESSION['username'])){
		header("location: login.php");
		exit;
	}
	
	//change the status of the user to deleted
	if(isset($_POST['delete']) && $_POST['delete']=="delete"){
		$chk = $_POST['del'];
		foreach($chk as $del){
			$qry = $dblink->db_qry("DELETE FROM ems_users WHERE user_id='$del' ");
		}
		$msg = "User successfully deleted.";
	}
	
	function rights($num){
		switch($num){
			case 1:
				$rights = "Admin";
			break;
			
			case 2:
				$rights = "Manager";
			break;
				
			case 3:
				$rights = "Employee";
			break;
			
			case 4:
				$rights = "Sales Admin";
			break;	
			
			case 5:
				$rights = "Executive";
			break;
		}
		return $rights;
	}
	
	function num($rights){
		switch($rights){
			case "admin": case "Admin":
				$num = 1;
			break;
			
			case "manager": case "Manager":
				$num = 2;
			break;
				
			case "employee": case "Employee": 
				$num = 3;
			break;
			
			case "sales admin": case "Sales Admin": case "Sales admin":
				$num =  4;
			break;		
			
			case "executive": case "Executive": 
				$num =  5;
			break;
		}
		return $num;
	}
	
	function admin($admin, $rights){
		if($admin==1 && $rights!=1){	
			$str = " / Admin";
		}else{
			$str = "";
		}
		return $str;
	}
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">


<html lang="en">

    <head>

		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="">
		<meta name="author" content="">
		
		<link rel="icon" href="../images/iEMS2.png">

		<title>iEMS</title>
		
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="css/home-format.css" rel="stylesheet">
		<link href="css/plugins/metisMenu/metisMenu.min.css" rel="stylesheet">
		<link href="css/plugins/dataTables.bootstrap.css" rel="stylesheet">
		<link href="css/sb-admin-2.css" rel="stylesheet">

		<script type="text/javascript" src="js/ie-emulation-modes-warning.js"></script>
        <script type="text/javascript" src="jquery.js"></script>
        <script type="text/javascript" src="navigation.js"></script>
        <script type="text/javascript" src="jsFunctions.js"></script>
        <script type="text/javascript">
            function info(ID, rights){
                window.open("add_ems_users.php?ID="+ID+"&rights="+rights,"_self");
            }
        
            function removeChecked(){
                var id = document.getElementsByName("del[]");	
                
                var valid = false;
                for(var i in id){
                    if(id[i].checked){
                        valid = true;
                        break;
                    }
                }
                
				if(valid){
					var x = confirm("Are you sure you want to delete selected user?");
						if(x){
							return true;
						}else{
							return false;
						}
				}else{
					alert("Select atleast one record to delete.");
					return false;
				}                
            return true;
            }
        
            function checkAll(){
                var id = document.getElementsByName("del[]");	
                var chk = document.view_ems_users.all.checked;
                
                if(chk){
					for(var i=0; i<id.length; i++){
						id[i].checked = true;
					}		
                }else{
					for(var i=0; i<id.length; i++){
						id[i].checked = false;
					}					
                }
            }
        </script>
		
    </head>
	
	
    <body vlink="blue" alink="blue" link="blue" onload="bread('<?php echo $_SERVER["PHP_SELF"];?>');">
		<?php include("menu.php"); ?>
        
		<form name="view_ems_users" action="<?php $PHP_SELF; ?>" method="POST">
			<div id="container">
			
			
				<div class="col-lg-12">
					
					<div class="panel-body top-bordered col-lg-12">
								
							<h2 class="summary-title">Users: HR iEMS Users</h2>
							
							<div class="table-buttons row">
								<button type="submit" class="delete pull-right btn btn-danger" name="delete" value="delete" onclick="return removeChecked();">Delete</button>
								<button type="button" class="add pull-right btn btn-primary" onclick="window.location = 'add_ems_users.php';" >Add User</button>
							</div>
							
						<div class="table-responsive col-lg-12">
							<table class="table table-striped table-bordered table-hover" id="users-table">
								<thead>
									<tr>
										<th class="table-column-names nosort"><input type="checkbox" name="all" onclick="checkAll();"/></th>
										<th class="table-column-names">User ID</th>
										<th class="table-column-names">Username</th>
										<th class="table-column-names">Rights</th>
										<th class="table-column-names">Status</th>
									</tr>
								</thead>
								<tbody>
									<?php
										
										$by = $_POST['searchby'];
										$search = $_POST['search'];
										if(isset($_POST['submit']) && $_POST['submit']=="search"){
											switch($by){
												case 0:  //JD-2013/02/04 - Fixed Search function
													$num = num($search);
													$str = "SELECT user_id, username, status, rights, is_admin FROM ems_users 
															WHERE user_id='$search' OR username LIKE '%$search%' OR rights='$num' 
															OR status='$search'";
												break;																	
												
												case 1:	
													$str = "SELECT user_id, username, status, rights, is_admin FROM ems_users WHERE 
													username = '$search'";																		
												break;
												
												case 2:
													$num = num($search);
													$str = "SELECT user_id, username, status, rights, is_admin FROM ems_users WHERE
													 rights='$num'";
												break;
												
												case 3:
													$str = "SELECT user_id, username, status, rights, is_admin FROM ems_users WHERE
													 status='$search'";																	
												break;
											}
										}else{
											$str = "SELECT user_id, username, status, rights, is_admin FROM ems_users ORDER BY username";
										}
										
										//echo $str;
								 
										$qry = $dblink->db_qry($str);
										$x = "a";
										while($data = $dblink->get_data($qry)){
											echo '<tr class="',$x,'"align="center">';
											echo '<td style="padding:0;"><input type="checkbox" name="del[]" value="',$data[0],'"/></td>';															
											echo '<td><a href="#" onclick="info(',$data[0],',',$data[3],');">',$data[0],'</a></td>';
											echo '<td><a href="#" onclick="info(',$data[0],',',$data[3],');">',$data[1],'</a></td>';
											echo '<td>',rights($data[3]).admin($data[4], $data[3]),'</td>';
											echo '<td>',$data[2],'</td>';
											echo '</tr>';		
												
											if($x=="a"){
												$x = $x . "b";
											}else{
												$x = "a";
											}
										}
									?>
								</tbody>
							</table>
						</div> <!-- table-responsive -->
						
					</div> <!-- panel-body -->
					
				</div> <!-- col-lg-12 -->
			</div> <!-- container -->
		</form>
		
		
		
		<?php include("footer.php"); ?>
		
		
		<script src="js/jquery.js"></script>
		<script src="js/jquery-1.11.1.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/docs.min.js"></script>
		<script src="js/plugins/metisMenu/metisMenu.min.js"></script>
		<script src="js/plugins/dataTables/jquery.dataTables.js"></script>
		<script src="js/plugins/dataTables/dataTables.bootstrap.js"></script>
		<script src="js/ie10-viewport-bug-workaround.js"></script>
		<script>
			$(document).ready(function() {
				$('#users-table').dataTable({
					"aoColumnDefs": [{
						'bSortable': false,
						'aTargets': [ 'nosort' ]
					}],
					"order": [[ 1, "asc" ]]
				});
			});
		</script>
		
	</body>
	
</html>