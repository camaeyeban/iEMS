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
}

if($_SESSION['rights']==2){
		echo '<h1>',"Invalid URL!",'</h1>';
		return false;
}

if(!isset($_GET['ID'])){
		echo '<h1>',"Invalid URL!",'</h1>';
		return false;	
}

$ID = $_GET['ID'];
$action = $_GET['action'];

//for confirmation
if(isset($_POST['confirm']) && $_POST['confirm']=="ok"){

	if($action=="approve_ot"){
		$qry = $dblink->db_qry("UPDATE ems_ot SET status='approved' WHERE ot_id='$ID' ");
		 echo '<script>window.close();
                     window.opener.location.reload();
                     parent.refresh();</script>';
	}elseif($action=="cancel_ot"){
		$qry = $dblink->db_qry("UPDATE ems_ot SET status='cancelled' WHERE ot_id='$ID' ");
		 echo '<script>window.close();
                     window.opener.location.reload();
                     parent.refresh();</script>';
	}elseif($action=="approve_acc"){
		$qry = $dblink->db_qry("UPDATE ems_accomplishments SET status='approved' WHERE ot_id='$ID' ");
		 echo '<script>window.close();
                     window.opener.location.reload();
                     parent.refresh();</script>';
	}elseif($action=="cancel_acc"){
		$qry = $dblink->db_qry("UPDATE ems_accomplishments SET status='cancelled' WHERE ot_id='$ID' ");
		 echo '<script>window.close();
                     window.opener.location.reload();
                     parent.refresh();</script>';
	}elseif($action=="approve_off"){
		$qry = $dblink->db_qry("UPDATE ems_offset SET status='approved' WHERE ot_id='$ID' ");
		 echo '<script>window.close();
                     window.opener.location.reload();
                     parent.refresh();</script>';
	}elseif($action=="cancel_off"){
		$qry = $dblink->db_qry("UPDATE ems_offset SET status='cancelled' WHERE ot_id='$ID' ");
		 echo '<script>window.close();
                     window.opener.location.reload();
                     parent.refresh();</script>';
	}elseif($action=="approve_ob"){
		$qry = $dblink->db_qry("UPDATE ems_ob SET status='approved' WHERE ob_id='$ID' ");
		 echo '<script>window.close();
			 window.opener.location.reload();
			 parent.refresh();</script>';
	}elseif($action=="cancel_ob"){
		$qry = $dblink->db_qry("UPDATE ems_ob SET status='cancelled' WHERE ob_id='$ID' ");
		 echo '<script>window.close();
			 window.opener.location.reload();
			 parent.refresh();</script>';
	}elseif($action=="approve_lv"){
		$qry = $dblink->db_qry("UPDATE ems_leave SET status='approved' WHERE leave_id='$ID' ");
		 echo '<script>window.close();
			 window.opener.location.reload();
			 parent.refresh();</script>';
	}elseif($action=="cancel_lv"){
		$qry = $dblink->db_qry("UPDATE ems_leave SET status='cancelled' WHERE leave_id='$ID' ");
		 echo '<script>window.close();
			 window.opener.location.reload();
			 parent.refresh();</script>';
	}elseif($action=="approve_un"){
		$qry = $dblink->db_qry("UPDATE ems_undertime SET status='approved' WHERE un_id='$ID' ");
		 echo '<script>window.close();
			 window.opener.location.reload();
			 parent.refresh();</script>';
	}elseif($action=="cancel_un"){
		$qry = $dblink->db_qry("UPDATE ems_undertime SET status='cancelled' WHERE un_id='$ID' ");
		 echo '<script>window.close();
			 window.opener.location.reload();
			 parent.refresh();</script>';
	}elseif($action=="approve_air"){
		$qry = $dblink->db_qry("UPDATE ems_air_ticket SET status='confirmed', state='1' WHERE at_id='$ID' ");
		 echo '<script>window.close();
			 window.opener.location.reload();
			 parent.refresh();</script>';
	}elseif($action=="cancel_air"){
		$qry = $dblink->db_qry("UPDATE ems_air_ticket SET status='cancelled' WHERE at_id='$ID' ");
		 echo '<script>window.close();
			 window.opener.location.reload();
			 parent.refresh();</script>';
	}elseif($action=="approve_rqstn"){
		$qry = $dblink->db_qry("UPDATE ems_equip_requisitions SET status='confirmed', state='1' WHERE erqstn_id='$ID' ");
		 echo '<script>window.close();
			 window.opener.location.reload();
			 parent.refresh();</script>';
	}elseif($action=="cancel_rqstn"){
		$qry = $dblink->db_qry("UPDATE ems_equip_requisitions SET status='cancelled' WHERE erqstn_id='$ID' ");
		 echo '<script>window.close();
			 window.opener.location.reload();
			 parent.refresh();</script>';
	}elseif($action=="approve_rsrv"){
		$qry = $dblink->db_qry("UPDATE ems_equip_requests SET status='approved' WHERE erqst_id='$ID' ");
		 echo '<script>window.close();
			 window.opener.location.reload();
			 parent.refresh();</script>';
	}elseif($action=="cancel_rsrv"){
		$qry = $dblink->db_qry("UPDATE ems_equip_requests SET status='cancelled' WHERE erqst_id='$ID' ");
		 echo '<script>window.close();
			 window.opener.location.reload();
			 parent.refresh();</script>';
	}elseif($action=="a_approve_rqstn"){
		$qry = $dblink->db_qry("UPDATE ems_equip_requisitions SET status='approved', state='2' WHERE erqstn_id='$ID' ");
		 echo '<script>window.close();
			 window.opener.location.reload();
			 parent.refresh();</script>';
	}elseif($action=="a_cancel_rqstn"){
		$qry = $dblink->db_qry("UPDATE ems_equip_requisitions SET status='cancelled' WHERE erqstn_id='$ID' ");
		 echo '<script>window.close();
			 window.opener.location.reload();
			 parent.refresh();</script>';
	}elseif($action=="a_approve_air"){
		$qry = $dblink->db_qry("UPDATE ems_air_ticket SET status='approved', state='2' WHERE at_id='$ID' ");
		 echo '<script>window.close();
			 window.opener.location.reload();
			 parent.refresh();</script>';
	}elseif($action=="a_cancel_air"){
		$qry = $dblink->db_qry("UPDATE ems_air_ticket SET status='cancelled' WHERE at_id='$ID' ");
		 echo '<script>window.close();
			 window.opener.location.reload();
			 parent.refresh();</script>';
	}
	
	

//for cancel	
}elseif(isset($_POST['confirm']) && $_POST['confirm']=="cancel"){
		echo '<script>window.close();</script>';
}

//for the full name
if($action=="approve_ot" || $action=="cancel_ot"){
			$str = "SELECT ot_id, emp_firstname, emp_lastname FROM ems_employee as e
						INNER JOIN ems_ot as ot
						ON e.emp_num = ot.emp_num
						WHERE ot.ot_id='$ID' ";
}elseif($action=="approve_off" || $action=="cancel_off"){
			$str = "SELECT offset_id, emp_firstname, emp_lastname FROM ems_employee as e
						INNER JOIN ems_offset as o
						ON e.emp_num = o.emp_num
						WHERE o.offset_id='$ID' ";
}elseif($action=="approve_acc" || $action=="cancel_acc"){
			$str = "SELECT o.ot_id, emp_firstname, emp_lastname FROM ems_employee as e
						INNER JOIN ems_ot as o
						ON e.emp_num = o.emp_num
						INNER JOIN ems_accomplishments as a
						ON o.ot_id = a.ot_id
						WHERE a.ot_id='$ID' ";
}elseif($action=="approve_ob" || $action=="cancel_ob"){
			$str = "SELECT ob_id, emp_firstname, emp_lastname FROM ems_employee as e
						INNER JOIN ems_ob as ob
						ON e.emp_num = ob.emp_num
						WHERE ob.ob_id='$ID' ";
}elseif($action=="approve_lv" || $action=="cancel_lv"){
			$str = "SELECT leave_id, emp_firstname, emp_lastname FROM ems_employee as e
						INNER JOIN ems_leave as l
						ON e.emp_num = l.emp_num
						WHERE l.leave_id='$ID' ";
}elseif($action=="approve_un" || $action=="cancel_un"){
			$str = "SELECT un_id, emp_firstname, emp_lastname FROM ems_employee as e
						INNER JOIN ems_undertime as u
						ON e.emp_num = u.emp_num
						WHERE u.un_id='$ID' ";
}elseif($action=="approve_air" || $action=="cancel_air" || $action=="a_approve_air" || $action=="a_cancel_air"){
			$str = "SELECT at_id, emp_firstname, emp_lastname FROM ems_employee as e
						INNER JOIN ems_air_ticket as a
						ON e.emp_num = a.emp_num
						WHERE a.at_id='$ID' ";
}elseif($action=="approve_rqstn" || $action=="cancel_rqstn" || $action=="a_approve_rqstn" || $action=="a_cancel_rqstn"){
			$str = "SELECT erqstn_id, emp_firstname, emp_lastname FROM ems_employee as e
						INNER JOIN ems_equip_requisitions as r
						ON e.emp_num = r.emp_num
						WHERE r.erqstn_id='$ID' ";
}elseif($action=="approve_rsrv" || $action=="cancel_rsrv"){
			$str = "SELECT erqst_id, emp_firstname, emp_lastname FROM ems_employee as e
						INNER JOIN ems_equip_requests as r
						ON e.emp_num = r.emp_num
						WHERE r.erqst_id='$ID' ";
}

			$qry = $dblink->db_qry($str);
			$result = $dblink->get_data($qry);
			$fname = $result[1]." ".$result[2];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel='stylesheet' href='cssall.css' type='text/css' />
<script type="text/javascript" src="jquery.js">
</script>

<script type="text/javascript">


</script>

</head>

<body style="background-color:#cecece">
<form name="form_dialog" action="<?php $PHP_SELF; ?>" method="POST">
                 <table border='0' width='100%'>
					<tr>
					<td rowspan="1"><img src="icons/qmark.png" /></td>
					<?php
					//confirmation of the action
						if($action=="approve_ot"){
								echo '<td colspan="2" align="center" style="font-size:14px">',"Approve overtime request of ",$fname,"?",'</td>';
						}elseif($action=="cancel_ot"){
								echo '<td colspan="2" align="center" style="font-size:14px" >',"Cancel overtime request of ",$fname,"?",'</td>';
						}elseif($action=="approve_acc"){
								echo '<td colspan="2" align="center" style="font-size:14px" >',"Approve accomplishment report of ",$fname,"?",'</td>';
						}elseif($action=="cancel_acc"){
								echo '<td colspan="2" align="center" style="font-size:14px" >',"Cancel accomplishment report of ",$fname,"?",'</td>';
						}elseif($action=="approve_off"){
								echo '<td colspan="2" align="center" style="font-size:14px" >',"Approve offset request of ",$fname,"?",'</td>';
						}elseif($action=="cancel_off"){
								echo '<td colspan="2" align="center" style="font-size:14px" >',"Cancel offset request of ",$fname,"?",'</td>';
						}elseif($action=="approve_ob"){
								echo '<td colspan="2" align="center" style="font-size:14px" >',"Approve official business application of ",$fname,"?",'</td>';
						}elseif($action=="cancel_ob"){
								echo '<td colspan="2" align="center" style="font-size:14px" >',"Cancel official business application of ",$fname,"?",'</td>';
						}elseif($action=="approve_lv"){
								echo '<td colspan="2" align="center" style="font-size:14px" >',"Approve leave application of ",$fname,"?",'</td>';
						}elseif($action=="cancel_lv"){
								echo '<td colspan="2" align="center" style="font-size:14px" >',"Cancel leave application of ",$fname,"?",'</td>';
						}elseif($action=="approve_un"){
								echo '<td colspan="2" align="center" style="font-size:14px" >',"Approve undertime application of ",$fname,"?",'</td>';
						}elseif($action=="cancel_un"){
								echo '<td colspan="2" align="center" style="font-size:14px" >',"Cancel undertime application of ",$fname,"?",'</td>';
						}elseif($action=="approve_air"){
								echo '<td colspan="2" align="center" style="font-size:14px" >',"Confirm airticket request of ",$fname,"?",'</td>';
						}elseif($action=="cancel_air"){
								echo '<td colspan="2" align="center" style="font-size:14px" >',"Cancel airticket request of ",$fname,"?",'</td>';
						}elseif($action=="approve_rqstn"){
								echo '<td colspan="2" align="center" style="font-size:14px" >',"Confirm equipment requisition of ",$fname,"?",'</td>';
						}elseif($action=="cancel_rqstn"){
								echo '<td colspan="2" align="center" style="font-size:14px" >',"Cancel equipment requisition of ",$fname,"?",'</td>';
						}elseif($action=="approve_rsrv"){
								echo '<td colspan="2" align="center" style="font-size:14px" >',"Approve equipment reservation of ",$fname,"?",'</td>';
						}elseif($action=="cancel_rsrv"){
								echo '<td colspan="2" align="center" style="font-size:14px" >',"Cancel equipment reservation of ",$fname,"?",'</td>';
						}elseif($action=="a_approve_rqstn"){
								echo '<td colspan="2" align="center" style="font-size:14px" >',"Approve equipment requisition of ",$fname,"?",'</td>';
						}elseif($action=="a_cancel_rqstn"){
								echo '<td colspan="2" align="center" style="font-size:14px" >',"Cancel equipment requisition of ",$fname,"?",'</td>';
						}elseif($action=="a_approve_air"){
								echo '<td colspan="2" align="center" style="font-size:14px" >',"Approve airticket request of ",$fname,"?",'</td>';
						}elseif($action=="a_cancel_air"){
								echo '<td colspan="2" align="center" style="font-size:14px" >',"Cancel airticket request of ",$fname,"?",'</td>';
//for employee
						}elseif($action=="e_cancel_lv"){
								echo '<td colspan="2" align="center" style="font-size:14px" >',"Cancel leave application?",'</td>';
								}
						// }elseif(){
								// echo '<td colspan="2" align="center" style="font-size:14px" >',"Cancel undertime application?",'</td>';
						// }elseif(){
								// echo '<td colspan="2" align="center" style="font-size:14px" >',"Cancel overtime request?",'</td>';
						// }elseif(){
								// echo '<td colspan="2" align="center" style="font-size:14px" >',"Cancel official business application?",'</td>';
						// }elseif(){
								// echo '<td colspan="2" align="center" style="font-size:14px" >',"Cancel offset request?",'</td>';
						// }elseif(){
								// echo '<td colspan="2" align="center" style="font-size:14px" >',"Cancel equipment reservartion?",'</td>';
						// }elseif(){
								// echo '<td colspan="2" align="center" style="font-size:14px" >',"Cancel equipment requisition?",'</td>';
						// }
					
					?>
					<tr>
						<td></td>
						<td align="right"><input type="submit" class="ok" name="confirm" value="ok" />
						<input type="submit" class="cancel" name="confirm" value="cancel" /></td>
					</tr>
                 </table>  
</form>
</body>
</html>

