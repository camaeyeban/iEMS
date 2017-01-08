<?php
session_start();
ini_set('session.bug_compat_42',0);
ini_set('session.bug_compat_warn',0);

include("config_DB.php");
require_once("calendar/classes/tc_calendar.php");

if($_SESSION['rights']!=1){
	echo '<h1>',"Invalid URL!",'</h1>';
	return false;
}

function calendar1($date){
	$myCalendar = new tc_calendar("date1", true, false);
	$myCalendar->setIcon("calendar/images/iconCalendar.gif");
	$myCalendar->setPath("calendar/");
	$myCalendar->setYearInterval(1970, 2020);	  
	$myCalendar->setAlignment('left', 'bottom');	  
	  if($date!=""){
			$myCalendar->setDate(Date("d",strtotime($date)),Date("m",strtotime($date)),Date("Y",strtotime($date)));
		}	  
	$myCalendar->writeScript();
}

$title = $_POST['title'];
$day = isset($_REQUEST["date1"]) ? $_REQUEST["date1"] : "";
if($day!="0000-00-00"){
	$date = date("Y-m-d", strtotime($day)); 
}else{
	$date = date("Y-m-d");
}
$time = $_POST['time'];
$location = $_POST['location'];
$info = $_POST['info'];
$today = date("Y-m-d");

$fname = $_FILES["file"]["name"];		
$ftype = $_FILES["file"]["type"];
$fsize = $_FILES["file"]["size"];
$type = array('image/gif','image/jpeg','image/pjpeg','image/png');
$msg = array();

	
	if(isset($_POST['chk'])){
		if(empty($fname)){
			$photo = "photos/event_def.png";
		}else{
			$photo = "photos/" . $fname;
		}
	}else{
		if(empty($fname)){
			$photo = "photos/event_def.png";
		}else{
			$photo = "photos/" . $fname;
		}
	}

if(isset($_POST['save'])){
			move_uploaded_file($_FILES["file"]["tmp_name"], "photos/" . $fname);
			$qry = mysql_query("INSERT INTO ems_announcement (title, day, time, location, created_by, date_created, info, photo) VALUES('$title', '$date', '$time', '$location', '$_SESSION[fname]', '$today', '$info', '$photo' )");
		echo '<script>window.close();
				window.opener.location.reload();
				parent.refresh();</script>';

}elseif(isset($_POST['update'])){	
	// if(!in_array($ftype,$type)){
		// $msg[] = $ftype ." is invalid file type.";
	// }else{
		// if(empty($fname)){
			// $photo_file = "photos/event_def.png";
		// }else{
			// $photo_file = "photos/".$fname;
		// }
			move_uploaded_file($_FILES["file"]["tmp_name"], "photos/" . $fname);
			$qry = mysql_query("UPDATE ems_announcement SET title='$title', day='$date', time='$time', location='$location', info='$info', photo='$photo' WHERE ann_id='$_GET[ID]' ");
			echo '<script>window.close();
					window.opener.location.reload();
					parent.refresh();</script>';
}

$cc = "Create an Event";
if($_GET['ID']!="_create"){
	$qry = mysql_query("SELECT title, day, time, location, info, photo FROM ems_announcement WHERE ann_id='$_GET[ID]' ");
	$row = mysql_fetch_array($qry);
	
	$dday = date("Y-m-d", strtotime($row[1]));
	$cc = "Update Event";
}
?>




<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html><title>iEMS</title>
<head>
<link href="calendar/calendar.css" rel="stylesheet" type="text/css">
<script language="javascript" src="calendar/calendar.js"></script>
<link rel="stylesheet" href="cssall.css" type="text/css" />
<script type="text/javascript" src="jquery.js"></script>

<script type="text/javascript" src="navigation.js"></script>
<script type="text/javascript" src="jsFunctions.js"></script>

<script type="text/javascript">
	
function validate(){
	var title = document.form_ann.title.value;

		if(title==""){
			alert("Please provide a title.");
			return false;
		}
}

	$(document).ready(function(){

		
		if($("#attached").html()=="photos/event_def.png"){
			$(this).show();
			$("#file").hide();
			$("#lbl_chk").show();
		}else{
			if($("#attached").html()==""){
				$("#file").show();		
				$("#lbl_chk").hide();
			}else{
				$("#file").hide();
				$("#lbl_chk").show();
			}
		}
		
		$("#chk").click(function(){
			if($(this).is(":checked")==true){
				$("#file").show();
				$("#attached").hide();
			}else{
				$("#file").hide();
				$("#attached").show();		
			}
		});
	});
</script>

</head>

<body>
<form name="form_ann" action="<?php $PHP_SELF; ?>" method="POST" onsubmit="return validate();" enctype="multipart/form-data">
<div style="padding:10px 0 0 3px;">
<div><span class="title"><?php echo $cc;?></span></div>
	<div class="t" style="width:370px; height:auto; padding: 10px 0 0 0;">
	<table border="0" width="350px" cellpadding="8px">
		<?php if($msg) echo '<tr><td colspan="2" class="err">'.$msg[0].'</td></tr>'; ?>
		<tr>
			<td class="an">Title: <span class="a">*</span></td>
			<td><input type="text" name="title" size="45" value="<?php echo $row[0];?>"/></td>
		</tr>		
		
		<tr>
			<td class="an">When:</td>
			<td>
				<?php calendar1($dday);?>&nbsp;&nbsp;
				<select name="time">
					<?php 		
						if($row[2]){
							echo '<option>',$row[2],'</option>';				
						}
						echo '<option>12:00 am</option>';
						echo '<option>12:30 am</option>';
						for($i=1;$i<=11;$i++){
								echo '<option  selected>'.$i.':00 am</option>';
								echo '<option>'.$i.':30 am</option>';
						}
						echo '<option>12:00 pm</option>';
						echo '<option>12:30 pm</option>';
						for($i=1;$i<=11;$i++){
								echo '<option>'.$i.':00 pm</option>';
								echo '<option>'.$i.':30 pm</option>';
						}
					?>
				</select>
			</td>
		</tr>
		
		<tr>
			<td class="an">Location:</td>
			<td><input type="text" name="location" size="45" value="<?php echo $row[3];?>"/></td>
		</tr>	
		
		<tr>
			<td valign="top" class="an">More Info:</td>
			<td><textarea name="info" cols="45" rows="10"><?php echo $row[4];?></textarea>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<label id="lbl_chk"><input type="checkbox" id="chk" name="chk">Upload new photo</label>		
			</td>

		</tr>		
		
		<tr>
			<td valign="top" class="an">Photo:</td>
			<td>
				<input type="file" name="file" id="file" accept="image/gif,image/jpeg,image/pjpeg,image/png">
				<span id="attached"><?php echo $row[5]; ?></span>	
			</td>
		</tr>		
		
		<tr valign="bottom">
			<td colspan="2" style="font-size:11px;">Field marked with an asterisk <span class="a">*</span> is required.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<?php
				if($_GET['ID']=="_create"){
					echo '&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" name="save" class="save"/></td>';
				}else{
					echo '<input type="submit" name="update" class="update"/></td>';
				}
			
			?>
			
			
		</tr>	
		
	</table>
</div>
</div>
</form>
</body>


</html>

