<?php

if(isset($_POST['upload'])){
	echo "hello";
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<title>iEMS</title>
<head>
<link rel="stylesheet" href="cssall.css" type="text/css" />
<script type="text/javascript" src="jquery.js"></script>

<script type="text/javascript" src="navigation.js"></script>
<script type="text/javascript" src="jsFunctions.js"></script>

<link href="jquery-ui.css" rel="stylesheet" type="text/css"/>
<script src="jquery-ui.min.js"></script>
  
<link href="uploadify/uploadify.css" type="text/css" rel="stylesheet" />

<script type="text/javascript" src="uploadify/swfobject.js"></script>
<script type="text/javascript" src="uploadify/jquery.uploadify.v2.1.4.min.js"></script>
	
<script type="text/javascript">
	$(document).ready(function(){
		$("#dialog").dialog({
			modal: 'true',
			width: '470',
			title: 'Upload photo',
			height : '110'
		});
		
		$('#file_upload').uploadify({
			'uploader'  : 'uploadify/uploadify.swf',
			'script'    : 'uploadify/uploadify.php',
			'checkScript' : 'uploadify/check.php',
			'cancelImg' : 'uploadify/cancel.png',
			'folder'    : 'photos',
			'auto'      : false,
			'fileExt'     : '*.png;*.gif;*.jpeg,*.jpg',
			'fileDesc'    : 'Image files',
			// 'sizeLimit'   : 104850600,
			'wmode'       : 'transparent',
			'removeCompleted' : true,
			'onCheck'     : function(event,data,key) {
				$('#file_upload' + key).find('.percentage').text(' - Exists');
			}
		});
	});
</script>

<head>
<body>
<form>	

<div id="dialog" style="display:none;">
<input id="file_upload" name="file_upload" type="file" />
<a href="javascript:$('#file_upload').uploadifyUpload();">Upload Files</a>
</div>
</form>
</body>
<html>