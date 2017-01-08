<?php
ob_start();
session_start();
ini_set('session.bug_compat_42',0);
ini_set('session.bug_compat_warn',0);

include("functions.php");
include('ps_pagination.php');
include("config_DB.php");
	
if(!isset($_SESSION['username'])){
	header("location: login.php");
}

chk_active($_SESSION['user_id']);
chk_invalid_url();

$hide = "";
$dis = "";
$chk = "";
if($_SESSION['rights']==2 && $_GET['ID']!=$_SESSION['emp_num']){
	$hide = "style:display:none;";
	$dis = "disabled";
	$chk = "display:none;";
}

$strqry = "SELECT emp_num, emp_firstname, emp_middlename, emp_lastname FROM ems_employee WHERE emp_num='$_GET[ID]'";
$query = mysql_query($strqry);
$result = mysql_fetch_array($query);


$desc = $_POST['desc'];

if(isset($_POST['save'])){

$extensions = array('.doc', '.docx', '.jpeg', '.jpg', '.png', '.gif', '.xls', '.xlsx', '.pdf', '.txt', '.rar', '.zip');
$fname = $_FILES["file"]["name"];
$name = substr($fname,0,strpos($fname,'.'));
$ext = substr($fname, strpos($fname,'.'), strlen($fname)-1);
$fsize = $_FILES["file"]["size"];

	if($fname==""){
		$msg = "Please choose a file to upload.";
	}else{
	
		if($fsize>5242880){
				$msg1 = "File size reached maximum limit of 5 MB.";
		}
	
		if(!in_array($ext, $extensions)){
				$msg2 = "Extension not allowed.";
		}
		


	}
	
	if(isset($_POST['save']) && $_POST['save'] == 'save' && empty($msg) && empty($msg1) && empty($msg2)){
		$sql = 'SELECT * FROM ems_attachments where emp_num = "' . $_GET['ID'] . '" order by a_id desc';
		$qry = mysql_query($sql);
		
		$count_attachments = 1;
		
		if($qry && mysql_num_rows($qry) > 0)
		{
			$row = mysql_fetch_array($qry);
			$explode = explode('_',$row[3]);
			
			$count_attachments = $explode[1] + 1;
		}
		$fname = $_GET['ID'].'_'.$count_attachments.'_'.$_FILES["file"]["name"];
		move_uploaded_file($_FILES["file"]["tmp_name"], "attachments/" . $fname);	
		$val = $_FILES["file"]["size"] /1024;
		$size = number_format($val, 1, '.' ,' ');
		$type = $_FILES["file"]["type"];
		
		$qry = mysql_query("INSERT INTO ems_attachments (emp_num, path, file_name, description, size, type) 
		VALUES ('$_GET[ID]', 'attachments/$fname','$fname','$desc','$size kb','$type')");			
		$succ = "File successfully uploaded!";
	}
}

if(isset($_POST['delete']) && $_POST['delete']=="delete"){
	$chk = $_POST['del'];
	if($chk){
		foreach($chk as $del){

			$delete = mysql_query("SELECT path FROM ems_attachments WHERE a_id='$del' ");
			$fname = mysql_fetch_array($delete);
				if($fname[0]){
						unlink($fname[0]);		
				}
			$qry = mysql_query("DELETE FROM ems_attachments WHERE a_id='$del' ");
		}
		
		$succ = "File deleted.";
	}

}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html><title>iEMS</title>

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

	function checkAll(){
		var id = document.getElementsByName("del[]");	
		var chk = document.form_attachments.all.checked;
				if(chk){
						for(var i=0; i<id.length; i++){
							id[i].checked = true;
						}		
				}else{
						for(var i=0; i<id.length; i++){
							id[i].checked = false;
						}					
				}	
		return true;
	}
	
	function removeAttachment(){
		var id = document.getElementsByName("del[]");
			var valid = false;
			for(var i in id){
				if(id[i].checked){
					valid = true;
					break;
				}
			}
			
			if(valid){
				var x = confirm("Are you sure you want to delete selected file?");
					if(x){
						return true;
					}else{
						return false;
					}
			}else{
					alert("Select atleast one file to delete.");
					return false;
			}
	}
	
	function show_load(){
		document.getElementById('loading').style.display = "block";
	}
</script>
</head>

<body vlink="blue" alink="blue" onload="bread('<?php echo $_SERVER["PHP_SELF"];?>');">
<div id="container">
<?php include("menu.php"); ?>
<?php include("side_menu.php");?>


	<div id="col-lg-12">
		<form name="form_attachments" action="<?php $PHP_SELF;?>" method="POST" enctype="multipart/form-data" onsubmit="show_load();">
			<div class="right-form">
				<div class="container">
					<div class="page-header" style="width:70%">
					<h4><strong class="formTitle">  Attachments </strong></h4>						</div>
				</div>
			
				<div class="row col s12" style="margin-left:-10%;width:170%;">
					<div class="col s6" style="width:30%;">
						<label class="right-label">FILE: </label>
						<input type="file" name="file" id="file" <? echo $dis;?>/>[5 mb max]
					</div>
				</div>
				<div class="row col s12" style="margin-left:-10%;width:180%;">
					<div class="col s6" style="width:30%;">
						<label class="right-label">[.doc .docx .xls .xlsx .pdf .txt .jpeg, .jpg .png .gif .zip .rar] </label>
					</div>
				</div>
				<div class="input-field col s12" style="margin-left:-10%;width:180%;">
					<div class="col s6" style="width:40%;">
						<textarea style="margin-left:19%;margin-top:4%;font-size:13px!important;font-weight:bold!important;" placeholder="What's on your mind?" id="textarea1" class="materialize-textarea" name="desc" <? echo $dis;?>/></textarea>
						<label style="font-size:13px!important;"class="text" for="textarea1"><i class="fa fa-pencil"></i>  DESCRIPTION: </label>
					</div>
				</div><hr style="width:80%;margin-left:2%;margin-top:1%;">
				<div class="row col s12" style="margin-left:3%;">
					<?php
						if($_SESSION['emp_num']==$_GET['ID'] || $_SESSION['rights']==1 || $_SESSION['rights']==5) {
								echo '<input class="btn btn-primary" type="submit" class="upload" id="save" name="save" value="save"/>
									<input class="btn btn-primary" type="submit" class="delete" name="delete" value="delete" onclick="return removeAttachment();"/></td>';
						}
					?>
				</div>
			
			
			<div id="right_top">
            
            <div style="width:65%; padding-top: 12px;">
				<div  class="t">
                 <table border='0' width='100%'>
					<tr>
					<?php
						if($msg || $msg1|| $msg2){
							echo '<td colspan="3" class="err">',$msg.'<br/>'.$msg1.'<br>'.$msg2.'</td>';
						}elseif($succ){
							echo '<td class="succ" colspan="3">',$succ,'<hr/></td>';
						}
					?></tr>
						
					</tr>
						<td><img src="icons/loadingFP.gif" id="loading" style="display:none;"></td>
					</tr>
				 </table>
				 <hr/>
				<table border="0" width="100%" id="t_color">
					<tr>
						<td width="1px" style="background-color: #4f81bd; <? echo $chk;?>"><input type="checkbox" name="all" onclick="return checkAll();"/></td>
						<th>File name</th><th>Description</th><th>Size</th><th>Type</th>
					</tr>
					
					<?php
					$str = "SELECT a_id, file_name, description, size, type FROM ems_attachments WHERE emp_num='$_GET[ID]' order by 2 ";
						$pager = new PS_Pagination($conn, $str, 10, 5);	
						$pager->setDebug(true);
						$rs = $pager->paginate();
							if(!$rs) die(mysql_error());
								$x = "a";
						while($data = mysql_fetch_array($rs)){
							echo '<tr align="center" class="',$x,'">';
							echo '<td style="',$chk,'"><input type="checkbox" name="del[]" value="',$data[0],'"/></td>';						
							echo '<td style = "text-align : left; padding-left : 10%"><a href="download.php?download_file=',$data[1],' ">',$data[1],'</a></td>';
							echo '<td>',$data[2],'</td>';
							echo '<td>',$data[3],'</td>';
							echo '<td>',$data[4],'</td>';
							echo '<tr>';
							
							if($x=="a"){
										$x = $x . "b";
							}else{
										$x = "a";
							}
						}
				echo '</table>';
					ob_flush();
					?>
            </div>
      </div>
	<div id="footer">
<br/><p>Copyright 2011</p>     
	</div>		
      </div>

</div>
</form>
</div>
</body>
</html>
