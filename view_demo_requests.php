<?php
session_start();
ini_set('session.bug_compat_42',0);
ini_set('session.bug_compat_warn',0);

include("ps_pagination.php");
include("functions.php");
include("config_DB.php");

chk_active($_SESSION['user_id']);

if(!isset($_SESSION['username'])){
	header("location: login.php");
}

if($_SESSION['rights']==1){
		echo '<h1>',"Invalid URL",'</h1>';
		return false;
}

if(isset($_POST['cancel_ob'])){
	$chk = $_POST['itemChk'];
	if(sizeof($chk)!=0){
		foreach($chk as $cancel){
			$qry = mysql_query("UPDATE ems_ob SET status='Cancelled' WHERE ob_id='$cancel' ");
		}
	}
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
	function load_ob(ID,action){
		window.open("ob.php?ID="+ID+"&action="+action,"_self");
		}
		
		function cancel(){
					var x = confirm("Cancel official business application?");
						if(x){
							return true;
						}else{
							return false;
						}
			} 
</script>

</head>
<body vlink="green" alink="green" onload="bread('<?php echo $_SERVER["PHP_SELF"];?>');">

<form name="form_ob_request" action="<?php $PHP_SELF;?>" method="POST">
<div id="container">
<?php include("menu.php"); ?>
            <div id="cc">
<div><span class="title">Official Business Request</span></div>
			<div class="t">
                 <table border='0' width='100%'  id="t_color">
						<tr><td colspan="10">
							<table border='0' width="100%">
                                  <tr>
                                      <td>
									  Search by:
                                          <select name="searchby">
													<option value="0">Any</option>
													<option value="1">Date Filed</option>
													<option value="2">OB Date</option>
													<option value="3">Client Branch</option>
													<option value="4">Status</option>
                                          </select>


                                      &nbsp;&nbsp;&nbsp;Search for:
                                      <input type='search' name='search' placeholder="search here.."/>
									  <input type="submit" class="search" name="submit" value="search"/>
									  </td>
									  <td align="right"><a href="ob.php"><img src="icons/aob.png"/></a></td>
                                  </tr>
							</table>
						</td>
						</tr>
						<tr>
							<td width="1%" style="background-color: #4f81bd"><th width="10%">Date Filed</th><th width="15%">From-To</th><th width="10%">Client/Branch</th><th>Purpose</th>
							<th width="10%">Departure</th><th width="10%">Arrival</th>
							<th width="8%">Total duration<br/>(hr.min)</th><th width="10%">Remarks</th><th width="8%">Status</th>
						</tr>
                        <?php
						   $by = $_POST['searchby'];
						   $search = $_POST['search'];
								if(isset($_POST['submit']) && $_POST['submit']=="search"){				
								
									switch($by){
										case 1:
												$strqry = "o.emp_num='$_SESSION[emp_num]' AND date_filed='$search'";
										break;
										
										case 2:
												$strqry = "o.emp_num='$_SESSION[emp_num]' AND (ob_from='$search' OR ob_to='$search' ) ";
										break;

										case 3:
												$strqry = "o.emp_num='$_SESSION[emp_num]' AND client_branch='$search'";
										break;			
										
										case 4:
												$strqry = "o.emp_num='$_SESSION[emp_num]' AND status='$search'";
										break;					
										
										case 0:
												$strqry = "(o.emp_num='$_SESSION[emp_num]' AND date_filed LIKE '%$search%') OR (o.emp_num='$_SESSION[emp_num]' AND (ob_from LIKE '%$search%' OR ob_to LIKE '%$search%')) OR 
												(o.emp_num='$_SESSION[emp_num]' AND client_branch LIKE '%$search%') OR (o.emp_num='$_SESSION[emp_num]' AND status LIKE '%$search%') ";
										break;												
									}

								}else{
										$strqry = "o.emp_num='$_SESSION[emp_num]'";
								}
								$str = "SELECT date_Filed, ob_from, ob_to, client_branch, purpose, departure, arrival, total, status, ob_id, remarks
											FROM ems_ob as o
											INNER JOIN ems_employee as e
											ON o.emp_num = e.emp_num
											WHERE $strqry
											ORDER BY ob_id DESC";	
								$pager = new PS_Pagination($conn, $str, 10, 5);	
								$pager->setDebug(true);
								$rs = $pager->paginate();
									if(!$rs) die(mysql_error());
									
									$x = "a";
								while($result = mysql_fetch_array($rs)){							
										echo '<tr align="center" class="',$x,'" valign="top">';
										chk_stat($result[8], $result[9], "ob");
										edit_app($result[8], $result[9], "ob_edit", $result[0]);
										
										//date filed
										if($result[2]=="0000-00-00"){
											echo '<td>',$result[1],'</td>';
										}else{
											echo '<td>',$result[1],' / ',$result[2],'</td>';
										}
										
										//From-To
										echo '<td>',$result[3],'</td>';
										
											$pur = explode("|", $result[4]);
											$pp = "";	//2012/01/04 - Added to clear variable before usage for another record.
											for($i=0; $i<sizeof($pur)-1; $i++){
												if(sizeof($pur)==2){
													$purpose =  $pur[$i];
												}else{
													$pp = $pp . $pur[$i] . " / ";
													$purpose = del_slash($pp);
												}
											}
										
										//Purpose
										echo '<td>',$purpose,'</td>';
										$purpose = "";
										
										//Departure
										echo '<td>',display_time(trim($result[5])),'</td>';
										
										//Arrival
											if($result[2]!="0000-00-00" && !($result[1] == $result[2])){
												echo '<td>',display_time_2($result[6]),'</td>';	
											}else{
												echo '<td>',display_time($result[6]),'</td>';
											}
											//echo '<td>',display_time($result[6]),'</td>';
										
										echo '<td>',$result[7],'</td>';										
										show_remarks($result[9]);
										echo '<td style="color:',f_color($result[8]),';"><b>',$result[8],'</b></td>';
										
										echo '</tr>';
										
										if($x=="a"){
											$x = $x . "b";
										}else{
											$x = "a";
										}
										
								}
									echo '</table>';
									echo '<tr><td><hr/></td></tr>';
									$qry = mysql_query($str);
									$page = ceil(mysql_num_rows($qry)/10);
									echo '<table border="0" width="100%">';
										echo '<tr>';
										$p = (!isset($_GET['page'])) ? 1 : $_GET['page'] ; 										
										if($page<=0){
											echo '<td width="20%"></td>';									
										}else{
											echo '<td width="20%">Page ',$p,' of ',$page,'</td>';									
										}
										echo '<td align="center">',$pager->renderFullNav(),'</td>';										
										echo '<td width="20%" align="right" colspan="8" style="padding-right:20px;"><input type="submit" name="cancel_ob" class="cancel" onclick="return confirmation(\'cancel\',\'ob\');"></td>';					
										echo '</tr>';
									echo '</table>';		
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