<?php
session_start();
ini_set('session.bug_compat_42',0);
ini_set('session.bug_compat_warn',0);

require("mysql_db_connect.inc.php");
$dblink = new mysql_db_connect();

if (!$dblink)
	die("no connection");

if(!isset($_SESSION['username'])){
	header("location: login.php");
	exit;
}

if(isset($_POST['submit']) && $_POST['submit']=="delete"){
	$chk = $_POST['del'];
		if($chk){
			foreach($chk as $del){
				$qry = $dblink->db_qry("DELETE FROM ems_jobspecs WHERE jobspec_id='$del' ");
			}
			echo '<script> window.location.reload();</script>';	
		}
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html><title>iEMS</title>

<head>
<link rel='stylesheet' href='cssall.css' type='text/css' />
<script type="text/javascript" src="jquery.js">
</script>

<script type="text/javascript" src="navigation.js"></script>

<script type="text/javascript">
	function info(ID){
		window.open("job_specs.php?ID="+ID,"_self");
	}

	function remove(){
		var id = document.getElementsByName("del[]");	
		
		if(id.length==0){
			return false;
		}
		
		var valid = false;
		for(var i in id){
			if(id[i].checked){
				valid = true;
				break;
			}
		}
		
			if(valid){
				var x = confirm("Are you sure you want to delete selected Department?");
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
		var chk = document.view_jobspecs.all.checked;
		
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

<body>
<form name="view_jobspecs" action="<?php $PHP_SELF; ?>" method="POST">

<div id="container">
<?php include("menu.php"); ?>

      <div>
           <p class="title">Job: Job Specifications</p>
      </div>
            <div id="cc" style="width:40%">
				<div class="t">
                           <table border='0' width='100%'>
                                  <tr>
                                      <td width="30%">Search by:</td>
                                      <td>
                                          <select name="searchby">
													<option value="0">All</option>
													<option value="1">ID</option>
													<option value="2">Name</option>
                                          </select>
                                      </td>

                                      <td align="center"  width="25%">Search for:</td>
                                      <td><input type='search' name='search' placeholder="search here.."/>
									  <input type="image" src="16x16/search.png" name="submit" value="search" width="16" height="16"/></td>
                                  </tr>
								  <tr><td colspan="4"><hr/></td></tr>
                                  <tr>
                                      <td><a href="job_specs.php"><img src='icons/add.png'/></a>
									  <input type="image" src="icons/delete.png" name="submit" value="delete" width="55" height="20" onclick="return remove();"/></td>

                                  </tr>
							</table>
								<hr/>
							<table border="0" width="100%" class="t_color">
                                  <tr>
										<td width="1px" style="background-color: #3b5998"></th><input type="checkbox" name="all" onclick="checkAll();"/></td>
										<th>Id</th><th colspan="4">Name</th>
                                  </tr>
									<?php
                                           $by = $_POST['searchby'];
                                           $search = $_POST['search'];
                                      if(isset($_POST['submit']) && $_POST['submit']=="search"){
                                                                    switch($by)
                                                                    {
                                                                    case 0:
																		$str = "SELECT jobspec_id, jobspec_name FROM ems_jobspecs";
																		break;																	
                                                                    case 1:	
																		$str = "SELECT jobspec_id, jobspec_name FROM ems_jobspecs WHERE jobspec_id='$search' ";																		
                                                                        break;
                                                                    case 2:
																		$str = "SELECT jobspec_id, jobspec_name FROM ems_jobspecs WHERE jobspec_name='$search' ";																	
                                                                         break;
                                                                    }
													}else{
																	$str = "SELECT jobspec_id, jobspec_name FROM ems_jobspecs";
													}
				
													$qry = $dblink->db_qry($str);
													while($data = $dblink->get_data($qry)){
															echo '<tr align="center">';
															echo '<td align="center" style="padding:0;"><input type="checkbox" name="del[]" value="',$data[0],'"/></td>';																		
															echo '<td><a href="#" onclick="info(',$data[0],');">',$data[0],'</a></td>';
															echo '<td colspan="3"><a href="#" onclick="info(',$data[0],');">',$data[1],'</a></td>';
															echo '</tr>';
														
														
													}			

															// if(empty($data)){
																// echo '<tr><td colspan="4"><hr/></td></tr>';
																// echo '<td align="center" colspan="4"><i>No records to display.</i></td>';
															// }	
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

