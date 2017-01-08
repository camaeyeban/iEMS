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
	
	if(isset($_POST['cancel_equip'])){
		$chk = $_POST['itemChk'];
		if(sizeof($chk)!=0){
			foreach($chk as $cancel){
				$qry = mysql_query("UPDATE ems_equip_requests SET status='Cancelled' WHERE erqst_id='$cancel' ");
			}
		}
	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
    <head>
        <title>iEMS</title>
        <link rel='stylesheet' href='cssall.css' type='text/css' />
        <script type="text/javascript" src="jquery.js"></script>
        <script type="text/javascript" src="navigation.js"></script>
        <script type="text/javascript" src="jsFunctions.js"></script>
        <script type="text/javascript">

	        function cancel(){
				var x = confirm("Cancel equipment reservation?");
                if(x){
                	return true;
                }else{
                	return false;
				}
			} 
        </script>
    </head>
    <body vlink="green" alink="green" link="green" onload="bread('<?php echo $_SERVER["PHP_SELF"];?>');">
    	<form name="form_rsrv" action="<?php $PHP_SELF;?>" method="POST">
    	<div id="container">
        <?php include("menu.php"); ?>
			<div id="cc">
				<div><span class="title">Equipment Reservation</span></div>
                <div class="t">
					<table border='0' width='100%' id="t_color">
						<tr>
                        	<td colspan="10">
                            	<table border='0' width="100%">
                                	<tr>
                                    	<td>
                                        	Search by:
                                            <select name="searchby">
                                            	<option value="0">Any</option>
                                                <option value="1">Date Filed</option>
                                                <option value="2">Subject/Purpose</option>
                                                <!--<option value="3">Client/Branch</option>-->
                                                <option value="3">Inclusive Date</option>
                                                <option value="4">Status</option>
											</select>
    
                                            &nbsp;&nbsp;&nbsp;Search for:
                                            <input type='search' name='search' placeholder="search here.."/>
                                            <input type="submit" class="search" name="submit" value="search"/>
										</td>
										<td align="right"><a href="equip_request.php"><img src="icons/requip.png"/></a></td>
									</tr>
								</table>
							</td>
						</tr>			 
						<tr>
							<td width="1%" style="background-color: #4f81bd"></td>
                            <th width="10%">Date Filed</th>
                            <th width="15%" colspan="2">Subject/Purpose</th>
                            <th colspan='2' width="12%">From-To</th>
                            <th width="10%">Days</th>
                            <th>Equipments</th>
                            <th>Remarks</th>
                            <th width="8%">Status</th>
						</tr>
                        	<?php
                            
								$by = $_POST['searchby'];
                            	$search = $_POST['search'];
                                	if(isset($_POST['submit']) && $_POST['submit']=="search"){
										switch($by){
											case 1:
												$strqry = "emp_num='$_SESSION[emp_num]' AND date_filed='$search'";
											break;
			
											case 2:
												$strqry = "emp_num='$_SESSION[emp_num]' AND subject_purpose='$search' ";
											break;	
		
											/*case 3:
												$strqry = "emp_num='$_SESSION[emp_num]' AND client_branch='$search' ";
											break;*/
		
											case 3:
												$strqry = "emp_num='$_SESSION[emp_num]' AND (date_from='$search' OR date_to='$search') ";
											break;
												
											case 4:
												$strqry = "emp_num='$_SESSION[emp_num]' AND status='$search'";
											break;				
		
											case 0:
												$strqry = "(emp_num='$_SESSION[emp_num]' AND date_filed LIKE '%$search%') 
															OR (emp_num='$_SESSION[emp_num]') OR (emp_num='$_SESSION[emp_num]' AND subject_purpose LIKE '%$search%')
															OR (emp_num='$_SESSION[emp_num]' AND (date_from LIKE '%$search%' 
															OR date_to LIKE '%$search%')) OR (emp_num='$_SESSION[emp_num]' AND status LIKE '%$search%') ";									
											break;
										}
									}else{
										$strqry = "emp_num='$_SESSION[emp_num]'";
                                    }
                                    
                                    $str = "SELECT date_Filed, subject_purpose, client_branch, date_from, date_to, no_of_days, equip_list, remarks, status, erqst_id
											FROM ems_equip_requests
                                            WHERE $strqry
                                            ORDER BY erqst_id  DESC";
                                                               
                                    $pager = new PS_Pagination($conn, $str, 10, 5);	
                                    $pager->setDebug(true);
                                    $rs = $pager->paginate();
                                        if(!$rs){
											die(mysql_error());
										}
                                        $x = "a";
                                    
                                    while($result = mysql_fetch_array($rs)){	
                                    	echo '<tr align="center" class="',$x,'" valign="top">';
                                        chk_stat($result[8], $result[9], "equip");
                                        edit_app($result[8], $result[9],"equip_edit", $result[0]);								 
                                        echo '<td colspan="2">',$result[1],'</td>';
                                        /*echo '<td>',$result[2],'</td>';*/
                                        echo '<td colspan="2">',$result[3]." / ".$result[4],'</td>';
                                        echo '<td>',$result[5],'</td>';
                                         
                                        $equip = explode("|", $result[6]);
                                        for($i=0;$i<sizeof($equip)-1;$i++){
                                        	if(sizeof($equip)==2){
                                            	$items =  $equip[$i];
                                            }else{
                                                $pp = $pp . $equip[$i] . " / ";
                                                $items = del_slash($pp);
                                            }
										}
                                        
										echo '<td>',$items,'</td>';		
                                        $items = "";
                                        $pp = "";
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
                                    echo '<td width="20%" align="right" colspan="8" style="padding-right:20px;"><input type="submit" name="cancel_equip" class="cancel" onclick="return confirmation(\'cancel\',\'equip\');"></td>';					
                                    echo '</tr>';
                                    echo '</table>';											
                            ?>
                    </table>
                </div>
            </div>
            <div id="footer">
                <br/>
                <p>Copyright 2011</p>     
            </div>
        </div>
        </form>
    </body>
</html>