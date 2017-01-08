
<?php 
ini_set('session.bug_compat_42',0);
ini_set('session.bug_compat_warn',0);

include("config_DB.php");

	echo '<option>',"--Select--",'</option>';
	echo '<option value="00">',"12:00 am",'</option>';
	echo '<option value="05">',"12:05 am",'</option>';	
	for($z=10;$z<=55;$z+=5){
		echo '<option value="',$z,'">',"12:".$z." am",'</option>';		
	}
	$val = 60;
	 for($i=1;$i<=11;$i++){
		echo '<option value="',$val,'">',$i.":00 am",'</option>';			
		echo '<option value="',$val+5,'">',$i.":05 am",'</option>';		
			for($x=10;$x<=55;$x+=5){
				echo '<option value="',$x+$val,'">',$i.":".$x." am",'</option>';
			 }
		$val+=60;
	 }
	// echo '<option>',"--:--",'</option>';
	echo '<option value="',$val,'">',"12:00 pm",'</option>';
	echo '<option value="',$val+5,'">',"12:05 pm",'</option>';	
	for($z=10;$z<=55;$z+=5){
		echo '<option value="',$z+$val,'">',"12:".$z." pm",'</option>';		
	}
	$val+=60;
	 for($i=1;$i<=11;$i++){
		echo '<option value="',$val,'">',$i.":00 pm",'</option>';			
		echo '<option value="',$val+5,'">',$i.":05 pm",'</option>';											 
			for($x=10;$x<=55;$x+=5){
				echo '<option value="',$x+$val,'">',$i.":".$x." pm",'</option>';
			 }
		$val+=60;
	 }
?>
