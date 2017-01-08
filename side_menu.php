<?php
	include("config_DB.php");
?>

<html>

	<head>
		<script type="text/javascript" src="jsFunctions.js"></script>
		<script type="text/javascript" src="assets/js/materialize.min.js"></script>
		
    	<!-- Custom CSS -->
    	<link href="assets/css/simple-sidebar.css" rel="stylesheet">
    	<link href="css/bootstrap.min.css" rel="stylesheet">
	</head>
	
	<body>
		<?php
			$qry = mysql_query("SELECT path FROM ems_photos WHERE emp_num='$_GET[ID]' ");
			$data = mysql_fetch_array($qry);

			if($data[0]){
				$img = $data[0];
			}else{
				$img = "photos/default-image.png";
			}
		?>
				
	 <div id="wrapper">

        <!-- Sidebar -->
        <div id="sidebar-wrapper">
        	  
            <ul class="sidebar-nav">
                <li class="sidebar-brand">
                    <?php echo '<a href=view_edit_personal.php?ID='.$_GET['ID'].'>'?>PROFILE</a>
                </li>
				<?php
					echo '
					<li>
						<img src=',$img,' class="photo">
					</li>
					<li class="change-picture">
						<a href="photo.php?ID='.$_GET[ID].'">
							<button class="edit-profile btn btn-success btn-md btn-block" type="button"> Change Picture </button>
						</a>
					</li>
					';
				?>
                <li class="links">
                   <?php echo '<a href=view_edit_personal.php?ID='.$_GET['ID'].'>'?>PERSONAL DETAILS</a>
                </li>
                <li class="links">
                    <?php echo '<a href=view_edit_contacts.php?ID='.$_GET['ID'].'>'?>CONTACT DETAILS</a>
                </li>
                <li class="links">
                   <?php echo '<a href=view_edit_emergency.php?ID='.$_GET['ID'].'>'?>EMERGENCY CONTACTS</a>
                </li>
                <li class="links">
                   <?php echo '<a href=view_edit_dependents.php?ID='.$_GET['ID'].'>'?>DEPENDENTS</a>
                </li>
                <li class="links">
                    <?php echo '<a href=view_edit_job.php?ID='.$_GET['ID'].'>'?>JOB</a>
                </li>
                <li class="links">
                    <?php echo '<a href=view_edit_benefits.php?ID='.$_GET['ID'].'>'?>BENEFITS</a>
                </li>
                <li class="links">
                    <?php echo '<a href=view_edit_leave_summary.php?ID='.$_GET['ID'].'>'?>LEAVE SUMMARY</a>
                </li>
                <li class="links">
                    <?php echo '<a href=attachments.php?ID='.$_GET['ID'].'>'?>ATTACHMENT</a>
                </li>
            </ul>
		</div>
        
       
    </div>
 
    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Menu Toggle Script -->
    <script>
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
    </script>

</body>

      
	
</html>