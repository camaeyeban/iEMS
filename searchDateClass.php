<?php
    		//$_POST['date_ot'] = "04/10/2015";

			session_start();
			include('config_DB.php');
    		$ot_type = "";
			$tempdate = $_POST['date_ot'];
			$ot_date_arr = explode('/',$tempdate);
			$ot_date = $ot_date_arr[2] . "-" . $ot_date_arr[0] . "-" . $ot_date_arr[1];
			//echo "<script> alert(".$ot_date."); </script>";
		
			//echo "".$ot_date;
			$ot_record = array();	
			$sql  = "SELECT * FROM ems_special_days where '$ot_date' >= date_from && '$ot_date'<= date_to";
			$get  = mysql_query($sql);	

			if(!$get)
				die(mysql_error());
			$i = 0;
			//$hrs_ot = mysqli_fetch_field($get);
		
			while($row = mysql_fetch_array($get))
			{	//if($row[7] === 'Approved')
					$ot_type = $row[4];
			}	
			
			echo $ot_type;
?>