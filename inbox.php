<?php
	ini_set('session.bug_compat_42',0);
	ini_set('session.bug_compat_warn',0);
	session_start();
	include("config_DB.php");
	include("functions.php");
	if(!isset($_SESSION['username'])){
		header("location: login.php");
	}
	chk_active($_SESSION['user_id']);
	// print_r($_COOKIE['ID']);
	// setcookie("ID", $_SESSION['username']);
	// unset($_COOKIE['notification']);
	// echo $str = "SELECT email, email2, b_manager_name FROM ems_employee AS e
							// INNER JOIN ems_business_units AS b ON e.b_id = b.b_id
							// INNER JOIN ems_users AS u ON e.emp_num = u.emp_num
							// WHERE u.rights=1 AND b.b_id=$_SESSION[b_id]";
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" 
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

	
<html lang="en">

	<head>

		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		
		<link rel="icon" href="icons/icon.png">

		<title>iEMS</title>
		
		<link href="css/inbox-modal-format.css" rel="stylesheet">
		<link href="css/home-format.css" rel="stylesheet">
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="css/plugins/metisMenu/metisMenu.min.css" rel="stylesheet">
		<link href="css/plugins/dataTables.bootstrap.css" rel="stylesheet">
		<link href="css/sb-admin-2.css" rel="stylesheet">

        <script type="text/javascript" src="jquery.js"></script>
        <script type="text/javascript" src="navigation.js"></script>
        <script type="text/javascript" src="jsFunctions.js"></script>
        <script type="text/javascript" src="jquery.tools.min.js"></script>
        <script type="text/javascript" src="easy.notification.js"></script>
        <script type="text/javascript" src="jquery.cookie.js"></script>
        <!--
            <link href="jquery-ui.css" rel="stylesheet" type="text/css"/>
            <script src="jquery-ui.min.js"></script>
            <script src="jquery.tools.min.js"></script>
            
            <link href="uploadify/uploadify.css" type="text/css" rel="stylesheet" />
            <script type="text/javascript" src="uploadify/swfobject.js"></script>
            <script type="text/javascript" src="uploadify/jquery.uploadify.v2.1.4.min.js"></script>
        -->
		<script type="text/javascript">
            $(document).ready(function(){
            
            function load_lv(ID,action){
                window.open("leave_undertime.php?ID="+ID+"&action="+action,"_self");
            }
            function load_un(ID,action){
                window.open("leave_undertime.php?ID="+ID+"&action="+action,"_self");
            }
            function load_ot(ID,action){
                window.open("ot.php?ID="+ID+"&action="+action,"_self");
            }
            function load_ob(ID,action){
                window.open("ob.php?ID="+ID+"&action="+action,"_self");
            }
            function load_off(ID,action){
                window.open("offset.php?ID="+ID+"&action="+action,"_self");
            }	  
            function load_rsrv(ID,action){
                window.open("equip_request.php?ID="+ID+"&action="+action,"_self");
            }	  
            function load_air(ID,action){
                window.open("airticket.php?ID="+ID+"&action="+action,"_self");
            }
            // function load()
            // {
            // setTimeout("refresh()", 60000)
            // }
            // function refresh(){
            // window.location.reload()
            // }
            // $.cookie("notification", null);	
                    // setup ul.tabs to work as tabs for each div directly under div.panes
            $("ul.tabs").tabs("div.panes > div");			
                $.ajax({
                    type : 'POST',
                    url : 'notification.php',		
                    success: function(data){
                        // if($.cookie("notification")!=data && $.cookie("user")!=$.cookie("ID")){
                            if(data!=""){
                                $("#nn").addClass('notify').text(data);
                            }
						/*var api = $("ul.tabs").data("tabs");
                        api.onClick(function(e, index){
                            if(index==1){
                                // var x = $("#nn").html();
                                // if(parseInt(x)>=1){
                                    $("#nn").slideUp(500);
                                    // $.cookie("notification", data, { expires: 1});																			
                            }
                        });	 */							
                    }				
                });	
            });
        </script>
	
	</head>
	
	
    <body alink="#1f57a0" vlink="#1f57a0" link="#1f57a0" onload="bread('<?php echo $_SERVER["PHP_SELF"];?>');">
		<?php include("menu.php"); ?>
	
    	<form name="form_view_ot" action="<?php $PHP_SELF;?>" method="POST">
			<div id="container">
			
				<?php
					include("func_inbox.php");
//JD-2012/06/25 - Two options only for Administrator?
//--------------------------------------------------------------------ADMIN-------------------------------------------------------------------//

					if($_SESSION['rights']==1){
						include("func_inbox1.php");
					}
//For Managers and Sales Admin		
//-----------------------------------------------------------------MANAGER--------------------------------------------------------------------//

					elseif($_SESSION['rights']==2 OR $_SESSION['rights']==4){
						include("func_inbox2.php");
					}
//JD-2012/06/25 - Cleaned the code
//------------------------------------------------------------------EMPLOYEE------------------------------------------------------------------//
					if($_SESSION['rights']==3){
						include("func_inbox3.php");
					}
//JD-2012/06/25 - Show only managers' applications for executive
//Pending Approvals
//------------------------------------------------------------------EXECUTIVE-----------------------------------------------------------------//

					elseif($_SESSION['rights']==5){
						include("func_inbox4.php");
					}
				?>
				
				<div id="dialog" style="display:none;">
					<input id="file_upload" name="file_upload" type="file" />
					<a href="javascript:$('#file_upload').uploadifyUpload();">Upload Files</a>
				</div>
				
			</div> <!-- container -->
    	</form>
		
		
		<?php include("footer.php"); ?>
		
		
		
		<script src="js/jquery.js"></script>
		<script src="js/sb-admin-2.js"></script>
		
		
		<script src="js/bootstrap.min.js"></script>
		<script src="js/docs.min.js"></script>
		<script src="js/plugins/metisMenu/metisMenu.min.js"></script>
		<script src="js/plugins/dataTables/jquery.dataTables.js"></script>
		<script src="js/plugins/dataTables/dataTables.bootstrap.js"></script>
		<script src="js/ie10-viewport-bug-workaround.js"></script>
		<script>
			$(document).ready(function() {
				$("#regular-breakdown-table").dataTable();
			});
			$(document).ready(function() {
				$("#probationary-breakdown-table").dataTable();
			});
			$(document).ready(function() {
				$("#consultant-breakdown-table").dataTable();
			});
			$(document).ready(function() {
				$("#casual-breakdown-table").dataTable();
			});
		</script>

	</body>
	
</html>