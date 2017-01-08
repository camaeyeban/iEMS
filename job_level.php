<?php
session_start();
ini_set('session.bug_compat_42',0);
ini_set('session.bug_compat_warn',0);

require("mysql_db_connect.inc.php");
$dblink = new mysql_db_connect();

if (!$dblink)
	die("no connection");

include("functions.php");
chk_active($_SESSION['user_id']);

if(!isset($_SESSION['username'])){
	header("location: login.php");
}

if($_SESSION['rights']!=1){
		echo '<h1>',"Invalid URL!",'</h1>';
		return false;
}

$qry = $dblink->db_qry("SELECT job_level, rank, grade FROM ems_joblevel WHERE jl_id='$_GET[ID]' ");
$data = $dblink->get_data($qry);
	
$joblevel = $_POST['level'];
$rank = $_POST['rank'];
$grade = $_POST['grade'];

if(isset($_POST['submit']) && $_POST['submit']=="save"){

		$jb_qry = $dblink->db_qry("SELECT job_level, rank, grade FROM ems_joblevel WHERE job_level='$joblevel' AND rank='$rank' AND grade='$grade' ");
		$row = $dblink->row_count($jb_qry);
		if($row>0){
			$msg = "Job level already assigned!";
		}else{
			$strqry = "INSERT INTO ems_joblevel (job_level, rank, grade)
			VALUES('$joblevel','$rank','$grade')";
			$qry = $dblink->db_qry($strqry);
			header("location: view_job.php#job-level");
		}
		
}elseif(isset($_POST['submit']) && $_POST['submit']=="update"){
         $qry = $dblink->db_qry("UPDATE ems_joblevel SET job_level='$joblevel' , rank='$rank', grade='$grade' WHERE jl_id='$_GET[ID]' ");
		header("location: view_job.php#job-level");
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html><title>iEMS</title>
	<head>
		<link rel="icon" href="../icons/icon.png">

		<script type="text/javascript" src="navigation.js"></script>
		<link type="text/css" rel="stylesheet" href="assets/css/materialize.css"  media="screen,projection"/>
		<link type="text/css" rel="stylesheet" href="assets/css/form-format.css"  media="screen,projection"/>
		<script type="text/javascript" src="js/jquery-2.1.1.min.js"></script>
		<script type="text/javascript" src="assets/js/materialize.js"></script>

		<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css" />
		<link rel="stylesheet" type="text/css" href="font-awesome/css/font-awesome.css" />
		<link href="css/home-format.css" rel="stylesheet">
			
		<script type="text/javascript" src="assets/js/jquery-1.10.2.min.js"></script>
		<script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>

		<script type="text/javascript" src="jquery.js"></script>
		<script type="text/javascript" src="jsFunctions.js"></script>
		<script type="text/javascript" src="validator.js"></script>
		<link rel="stylesheet" href="css/jquery-ui.css">
		<script src="js/jquery-1.10.2.js"></script>
		<script src="js/jquery-ui.js"></script>
		<link rel="stylesheet" href="/resources/demos/sss">



	</head>

	<body onload="bread('<?php echo $_SERVER["PHP_SELF"];?>');">
		<?php include("menu.php"); ?>
		<form name='form_joblevel' action="<?php $PHP_SELF;?>" method='POST'>
			<div id="container" class="row">
				<div class="col l4 offset-l4">
					<div class="row col l12">
						<h4 class="blue-text text-darken-2 title"> JOB: Job Level </h4>
					</div>

					<div class="row col l12">
						<div class="col input-field s12">
							<label><i class="fa fa-briefcase"></i>  RANK:&nbsp;*&nbsp;</label>
							<input type="text" name="rank" value="<?php echo $data[1]; ?>" required />
						</div>
					</div>
					<div class="row col l12">
						<div class="input-field col l4">
							<label><i class="fa fa-briefcase"></i>  JOB LEVEL:&nbsp;*&nbsp;</label>
						</div>
						<div class="input-field col l8">
							<select name="level" class="form-control">
								<?php
									if($data[0]){
									echo '<option>',"--",'</option>';
									echo  '<option selected>',$data[0],'</option>';
										for($i=1;$i<=10;$i++){
											if($data[0]!=$i){
												echo '<option>',$i,'</option>';
											}
										}									
									}else{
										echo '<option>',"--",'</option>';
										for($i=1;$i<=10;$i++){
											echo '<option>',$i,'</option>';
										}									
									}							
								?>
							</select>		
						</div>
					</div>
					
					<div class="row col l12">
						<div class="input-field col l4">
							<label><i class="fa fa-briefcase"></i>  GRADE:&nbsp;*&nbsp;</label>
						</div>
						<div class="input-field col l8">
							<select name="grade" class="form-control">
								<?php
									if($data[2]){
									echo '<option>',"--",'</option>';
									echo  '<option selected>',$data[2],'</option>';
										for($i=1;$i<=10;$i++){
											if($data[2]!=$i){
												echo '<option>',$i,'</option>';
											}
										}									
									}else{
										echo '<option>',"--",'</option>';
										for($i=1;$i<=10;$i++){
											echo '<option>',$i,'</option>';
										}									
									}							
								?>
							</select>		
						</div>
					</div>
					
					<hr>
					<div class="disclaimer row col l12">
						<i class="fa fa-asterisk"></i> <strong>NOTE:</strong> Fields marked with an asterisk * are required.
					</div>
					
					<div class="row col l12">
						<?php
							if(isset($_GET['ID'])){
								echo '<input type="submit" class="btn btn-primary" id="save" name="submit" value="update"  onclick="return validate();"/>';				
							}else{
								echo '<input type="submit" class="btn btn-primary" id="save" name="submit" value="save"  onclick="return validate();"/>';
							}
						?><input type="button" value="back" class="btn btn-primary" onclick="window.location = 'view_job.php#job-level';" />
					</div>
				</div>
			</div>
		</form>
		
		<?php include("footer.php"); ?>
				
	</body>
</html>

<script type="text/javascript">
	var frmvalidator  = new Validator("form_joblevel");
	frmvalidator.EnableMsgsTogether();
	frmvalidator.addValidation("rank","req","Please enter rank.");
	frmvalidator.addValidation("level","dontselect=0","Please select level.");
	frmvalidator.addValidation("grade","dontselect=0","Please select grade.");
</script>
