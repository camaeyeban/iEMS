<?php
session_start();

require("mysql_db_connect.inc.php");
$dblink = new mysql_db_connect();

if (!$dblink)
	die("no connection");


if(!isset($_SESSION['username'])){
	header("location: login.php");
}

if($_SESSION['rights']!=1){
		echo '<h1>',"Access denied!",'</h1>';
		return false;
}

$qry = $dblink->db_qry("SELECT jobspec_name FROM ems_jobspecs WHERE jobspec_id='$_GET[ID]' ");
$result = $dblink->get_data($qry);

$name = $_POST['name'];
$desc = $_POST['desc'];
$duties = $_POST['duties'];

if(isset($_POST['submit']) && $_POST['submit']=="save"){
         $strqry = "INSERT INTO ems_jobspecs (jobspec_name, jobspec_desc, jobspec_duties)
         VALUES('$name','$desc','$duties')";
         $qry = $dblink->db_qry($strqry);

}



?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel='stylesheet' href='cssall.css' type='text/css' />
<script type="text/javascript" src="jquery.js">
</script>

<script type="text/javascript" src="navigation.js"></script>

<script type="text/javascript">

	function validate(){
	
		var name = document.form_jobspecs.name.value;
		
			if(name==""){
				alert("Please fill-out required fields!");
				return false;
			}
	}

</script>


</head>

<body>
<form name='form_jobspecs' action='job_specs.php' method='POST' onsubmit="return validate();">
<div id="container">
 <?php include("menu.php"); ?>
            <div>
                 <p class="title">Job: Job Specification</p>
            </div>
            <div id="content3">
                 <table border='0' width='100%'>
                        <tr>
                            <td width="30%">Name: <span class="a">*</span></td>
                            <td><input type='text' name='name' size="45" value="<?php echo $result[0];?>"/></td>
                        </tr>
                        <tr>
                            <td>Description:</td>
                            <td><textarea name='desc' rows='4' cols='45'></textarea></td>
                        </tr>
                        <tr>
                            <td>Duties:</td>
                            <td><textarea name='duties' rows='2' cols='45'></textarea></td>
                        </tr>
                        <tr><td colspan='2'><hr/></td></tr>
                        <tr>
							<td>
								<input type='image' src='icons/save.png' name="submit" value="save" alt='submit' width='41' height='20'/>
								
								<a href="view_jobspecs.php"><img src="icons/back.png"/></a>
							</td>
							<td colspan="2" align="right">Fields marked with an asterisk <span class="a">*</span> are required.</td>	   						  
                          </tr>
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
