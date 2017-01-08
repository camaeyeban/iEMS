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
chk_invalid_url();

if(!isset($_SESSION['username'])){
	header("location: login.php");
}

$strqry = "SELECT emp_num, emp_firstname, emp_middlename, emp_lastname FROM ems_employee WHERE emp_num='$_GET[ID]'";
$query = $dblink->db_qry($strqry);
$result = $dblink->get_data($query);

	if($_SESSION['emp_num']==$_GET['ID'] || $_SESSION['rights']==1 || $_SESSION['rights']==5) {
		$prop = "";
		$dis = "";	
	}else{
		$prop = "readonly";
		$dis = "disabled";	
	}

$qry = $dblink->db_qry("SELECT emp_num, path FROM ems_photos WHERE emp_num='$_GET[ID]' ");
$data = $dblink->get_data($qry);

if($data[1]){
	$img = $data[1];
}else{
	$img = "photos/image.png";
}


if(isset($_POST['submit'])){

			$fname = $_FILES["file"]["name"];
			$ftype = $_FILES["file"]["type"];
			$fsize = $_FILES["file"]["size"];
			$type = array('image/gif','image/jpeg','image/pjpeg','image/png');
			$msg = array();
			if($fname==""){
					$msg[] = "Please select photo to upload.";
			}else{
			
					// if(file_exists("photos/" . $_FILES["file"]["name"])){
							// $msg[] = $_FILES["file"]["name"] . " already exists. ";
					// }
					if(!in_array($ftype,$type)){
							$msg[] = $ftype ." is invalid file type.";
					}
					if($fsize>1048576){
							$msg[] = "File size reached maximum limit of 1 MB.";
					}
			}
			
			if(empty($msg)){
					move_uploaded_file($_FILES["file"]["tmp_name"], "photos/" . $_FILES["file"]["name"]);
					$fname = $_FILES["file"]["name"];
					
					$delete = mysql_query("SELECT path FROM ems_photos WHERE emp_num='$_GET[ID]' ");
					$path = mysql_fetch_array($delete);		

					if($data[0]!=null){
						if($path[0]){
							unlink($path[0]);		
						}		
						$qry = $dblink->db_qry("UPDATE ems_photos SET path='photos/$fname' WHERE emp_num='$_GET[ID]' ");
					}else{
						$qry = $dblink->db_qry("INSERT INTO ems_photos (emp_num, path) VALUES ('$_GET[ID]', 'photos/$fname')");				
					}		
					

					$succ = "Photo successfully uploaded.";
			}
			
}elseif(isset($_POST['delete'])){
		$delete = mysql_query("SELECT path FROM ems_photos WHERE emp_num='$_GET[ID]' ");
		$cnt = mysql_num_rows($delete);
		$path = mysql_fetch_array($delete);	
		
			if($cnt==1){
				$do = unlink($path[0]);	
			
				$qry = mysql_query("DELETE FROM ems_photos WHERE emp_num='$_GET[ID]' ");
				$succ = "Photo deleted!";
			}else{
				$msg[] = "You don't have any photo to delete!";
			}
		
}
?>


<script type="text/javascript" src="navigation.js"></script>
<script type="text/javascript" src="jsFunctions.js"></script>

<script type="text/javascript">
	
	function del(){
	
		var x = confirm("Delete photo?");
			if(x){
				return true;
			}else{
				return false;
			}
	}

</script>

</head>

<body onload="bread('<?php echo $_SERVER["PHP_SELF"];?>');">
<form name="form_photo" action="<?php $PHP_SELF?>" method="POST" enctype="multipart/form-data">
<div id="container">
<?php include("menu.php"); ?>
<?php include("side_menu.php");?>

      <div id="right_top" style="float:right;">
            <div>
                 <p class="title2">Photo</p>
            </div>
            <div style="width:60%; padding-top:12px;">
				<div class="t">
                 <table border='0' width='100%'>
					<tr>
					<?php 
						if($msg){
							echo '<td class="err" colspan="2">';
							foreach($msg as $err){ 
								if(!empty($err)){
									echo $err.'<br/>';
								}
							}
							echo '<hr/></td>';
						}elseif($succ){
							echo '<td class="succ" colspan="6">',$succ,'<hr/></td>';
						}
					?>
					</tr>			 
					<tr>
						<td><img src="<?php echo $img;?>" width='110' height='120' style="border:1px solid"/></td>
					</tr>
					<tr>
						<td>Select a Photo: </td>
						<td><input type="file" name="file" id="file" <?php echo $dis;?>/></td>
					</tr>
						<tr><td>[1 mb max] [Dimension 120x110]</td></tr>
					
					<tr><td colspan="3"><hr/></td></tr>

					<tr>
					<?php
						if($_SESSION['emp_num']==$_GET['ID'] || $_SESSION['rights']==1 || $_SESSION['rights']==5) {
							echo '<td><input type="submit" class="upload" id="save" name="submit" value="save"/>&nbsp;';
							echo '<input type="submit" class="delete" id="delete" name="delete" onclick="return del();"/></td>';
						}
					?>
					</tr>
				 </table>
            </div>
            </div>		
      </div>

</div>
</form>
</body>
</html>
