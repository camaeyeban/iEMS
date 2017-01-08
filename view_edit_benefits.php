<?php
	session_start();
	ini_set('session.bug_compat_42',0);
	ini_set('session.bug_compat_warn',0);

	require_once('calendar/classes/tc_calendar.php');
	require("mysql_db_connect.inc.php");
	include("config_DB.php");

	$dblink = new mysql_db_connect();
	if (!$dblink)
		die("no connection");

	include("functions.php");
	chk_active($_SESSION['user_id']);
	chk_invalid_url();


	if(!isset($_SESSION['username'])){
		header("location: login.php");
	}

		if($_SESSION['rights']==1 || $_SESSION['rights']==5){	
			$prop = "";
			$dis = "";
		}else{
			$prop = "readonly";
			$dis = "disabled";
		}

	$sl = $_POST['sickleave'];
	$vl = $_POST['vacleave'];
		
	if(isset($_POST['save'])){
		$str = "INSERT INTO ems_benefits (emp_num, sl_balance, vl_balance) VALUES('$_GET[ID]','$sl','$vl')";
		$qry = $dblink->db_qry($str);
		$msg = "Benefits Successfully Saved!";
		//echo $str;
	}elseif(isset($_POST['update'])){
		//TL-2011/10/06 - Corrected for updating benefits.
		//$qry  = $dblink->db_qry("UPDATE ems_benefits SET sl_balance=$sl, vl_balance=$vl WHERE ben_id='$_POST[update]' ");
		$qry  = $dblink->db_qry("UPDATE ems_benefits SET sl_balance=$sl, vl_balance=$vl WHERE emp_num='$_GET[ID]' ");
		$msg = "Benefits Successfully Saved!";
	}

	if(isset($_GET['ID'])){
		$qry = mysql_query("SELECT sl_balance, vl_balance FROM ems_benefits WHERE emp_num='$_GET[ID]' ");
		
		@$row = mysql_fetch_array($qry);
	}
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
	
	
<html>

	<head>

		<title>iEMS</title>
<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/home-format.css" rel="stylesheet">
<link href="css/profile-forms-format.css" rel="stylesheet">
<link type="text/css" rel="stylesheet" href="assets/css/materialize.min.css"  media="screen,projection"/>
<link href="calendar/calendar.css" rel="stylesheet" type="text/css">

<script language="javascript" src="calendar/calendar.js"></script>
		<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  		<script src="//code.jquery.com/jquery-1.10.2.js"></script>
 	  	<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
  		<link rel="stylesheet" href="/resources/demos/sss">

<script type="text/javascript" src="jquery.js"></script>
<script type="text/javascript" src="navigation.js"></script>
<script type="text/javascript" src="jsFunctions.js"></script>

		<script type="text/javascript">
			
			var cnt = 1;
			function update(sl, vl, ID){
				var s = document.getElementById("sl");
				var v = document.getElementById("vl");
				s.value = sl;
				v.value = vl;
				
				document.getElementById("save").style.display = "none";
				
				var btnUp = document.createElement("input");
				btnUp.setAttribute("type", "submit");
				btnUp.setAttribute("name", "update");
				btnUp.setAttribute("class", "update");
				btnUp.setAttribute("value", ID);
					if(cnt==1){
						document.getElementById("app").appendChild(btnUp);
						cnt++;
					}
				
			}
			
		</script>

	</head>

	
	<body link="blue" alink="blue" vlink="blue" onload="bread('<?php echo $_SERVER["PHP_SELF"];?>');">
			<div id="container">

				<?php include("menu.php"); ?>
				<?php include("side_menu.php");?>
		
		<div id="col-lg-12">
			<form name="form_benefits" action="<?php $PHP_SELF;?>" method="POST">
			<div class="right-form">
				
				<div class="container">
					<div class="page-header" style="width:70%;">
						<h4><strong class="formTitle"> Benefits </strong></h4>
					</div>
				</div>
			
			<div class="row col s12" style="margin-left:3%;width:70%;">
				<div class="col s12">
					<label class="right-label"><i class="fa fa-user"></i>  SICK / EMERGENCY LEAVE: &nbsp;&nbsp;</label>
					<?php if($_SESSION['rights']==1 OR $_SESSION['rights']==5){ ?>
						<input style="font-size:100%;font-weight:500;width:490px!important;text-align:left!important;" type="text" class="input_fields1" name="sickleave" size="1" id="sl" value="<?php echo $row[0] ?>" <?php echo $prop; ?>/>
					<?php }else if($_SESSION['rights']==3 OR $_SESSION['rights']==2){ ?>
						<input style="font-size:100%;font-weight:500;width:490px!important;text-align:left!important;" type="text" class="input_fields1" name="sickleave" size="1" id="sl" value="<?php echo $row[0] ?>" <?php echo $prop; ?> disabled="disabled"/>
					<?php } ?>
				</div>
			</div>
			<div class="row col s12" style="margin-left:4%;width:70%;">
				<label class="right-label"><i class="fa fa-user"></i>  VACATION LEAVE: &nbsp;&nbsp;</label>
				<?php if($_SESSION['rights']==1 OR $_SESSION['rights']==5){ ?>
                    <input style="font-size:100%;font-weight:500;width:545px!important;text-align:left!important;" type="text" class="input_fields1" name="vacleave" size="1" id="vl" value="<?php echo $row[1] ?>" <?php echo $prop; ?>/>
                <?php }else if($_SESSION['rights']==3 OR $_SESSION['rights']==2){ ?>
                    <input style="font-size:100%;font-weight:500;width:545px!important;text-align:left!important;" type="text" class="input_fields1" name="vacleave" size="1" id="vl" value="<?php echo $row[1] ?>" <?php echo $prop; ?> disabled="disabled"/>
                <?php } ?>
			</div><br>
				<div class="row" style="margin-left:3%;width:100%;">
					<hr style="width:78%;margin-left:-.3%;margin-top:-10px;">
					<?php	
					if($_SESSION['rights']==1 || $_SESSION['rights']==5){				
						if($row[0] && $row[1]){
							echo '<div id="app"><input type="submit" class="btn btn-primary" id="update" name="update" value="update" /></div>';
						}else{
							echo '<div id="app"><input type="submit" class="btn btn-primary" id="save" name="save" value="save"  /></div>';
						}
					}    
				?>
				</div>
			</div>
		</form>
	 </div>
		
	</body>

</html>