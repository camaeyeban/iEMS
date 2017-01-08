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
}

//change the status of the user to deleted
if(isset($_POST['delete']) && $_POST['delete']=="delete"){
	$chk = $_POST['del'];
	foreach($chk as $del){
		$qry = $dblink->db_qry("DELETE FROM ems_users WHERE user_id='$del' ");
	}
	$msg = "User successfully deleted.";
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html><title>iEMS</title>

<head>
<link rel='stylesheet' href='cssall.css' type='text/css' />
<script type="text/javascript" src="jquery.js"></script>

<script type="text/javascript" src="navigation.js"></script>
<script type="text/javascript" src="jsFunctions.js"></script>

<script type="text/javascript">
	function info(ID){
		window.open("add_admin_user.php?ID="+ID,"_self");
	}
	
	function remove(){
		var id = document.getElementsByName("del[]");	
		
		var valid = false;
		for(var i in id){
			if(id[i].checked){
				valid = true;
				break;
			}
		}
		
			if(valid){
				var x = confirm("Are you sure you want ot delete selected user?");
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
		var chk = document.view_admin_users.all.checked;
		
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
<form name="view_admin_users" action="<?php $PHP_SELF; ?>" method="POST">

<div id="container">
<?php include("menu.php"); ?>
            <div id="cc" style="width:50%">
 <div><span class="title">Users: Admin Users</span></div>    
			<div class="t">
                           <table border='0' width='100%'>
						   <tr><td colspan="2" class="succ"><?php //$m = ($msg) ? $msg : ""; echo $m;?></td></tr>
                                  <tr>
                                      <td width="25%">Search by:</td>
                                      <td width="20%">
                                          <select name="searchby">
													<option value="0">All</option>
													<option value="1">ID</option>
													<option value="2">Name</option>											
                                          </select>
                                      </td>

                                      <td align="center" width="20%">Search for:</td>
                                      <td><input type='search' name='search' placeholder="search here.."/>
									  <input type="submit" class="search" name="submit" value="search"/></td>
                                  </tr>
								  <tr><td colspan="4"><hr/></td></tr>
                                  <tr>
										<td>
										<input type="button" class="add" onclick="javacript:window.open('add_admin_user.php', '_SELF');" />
										<input type="submit" class="delete" name="delete" value="delete" onclick="return remove();"/>										
										</td>	
                                  </tr>
								  <tr><td></td></tr>
						</table>
						
						<table border="0" width="100%" id="t_color">
                                  <tr>
                                      <td width="1px" style="background-color: #4f81bd"><input type="checkbox" name="all" onclick="checkAll();"/></td>
									  <th>User Id</th><th>Username</th><th width="40%">Status</th>
                                  </tr>
									<?php
                                           $by = $_POST['searchby'];
                                           $search = $_POST['search'];
                                      if(isset($_POST['submit']) && $_POST['submit']=="search"){
                                                                    switch($by)
                                                                    {
                                                                    case 0:
																		$str = "SELECT user_id, username, status FROM ems_users WHERE rights='1'";
																		break;																	
                                                                    case 1:	
																		$str = "SELECT user_id, username, status FROM ems_users WHERE user_id='$search' and rights='1' ";																		
                                                                        break;
                                                                    case 2:
																		$str = "SELECT user_id, username, status FROM ems_users WHERE username='$search' and rights='1' ";																	
                                                                         break;																	 
                                                                    }
													}else{
																		$str = "SELECT user_id, username, status FROM ems_users WHERE rights='1'";
													}
				
													$qry = $dblink->db_qry($str);
													$x = "a";	
													while($data = $dblink->get_data($qry)){
															echo '<tr align="center" class="',$x,'">';
															echo '<td><input type="checkbox" name="del[]" value="',$data[0],'"/></td>';																
															echo '<td width="35%"><a href="#" onclick="info(',$data[0],');">',$data[0],'</a></td>';
															echo '<td><a href="#" onclick="info(',$data[0],');">',$data[1],'</a></td>';
															echo '<td>',$data[2],'</td>';
															echo '</tr>';													
																

															if($x=="a"){
																$x = $x . "b";
															}else{
																$x = "a";
															}
													}
                                      ?>
									  
                           </table>
      </div>      
	  </div>
	<div id="footer">
<br/><p>Copyright 2011</p>     
	</div>
</div>
</form>
</body>
</html>

