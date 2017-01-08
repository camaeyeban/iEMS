<?php
    		//$_POST['date_ot'] = "04/10/2015";

			session_start();
    		
			$tempdate = $_POST['date_ot'];
			$ot_id =$_POST['ot_id'];
			$ot_date_arr = explode('/',$tempdate);
			$ot_date = $ot_date_arr[2] . "-" . $ot_date_arr[0] . "-" . $ot_date_arr[1];
			//echo "<script> alert(".$ot_date."); </script>";
			include('config_DB.php');
		
			//echo "".$ot_date;
			$ot_record = array();	
			
			$user = $_SESSION[emp_num];
			//echo $user;
			$sql  = "SELECT COUNT(*) FROM ems_ot where '$ot_date' = date_ot AND ot_id != '$ot_id' AND emp_num = '$user' AND status IN ('Pending' ,'Approved','Used')";
			$get  = mysql_query($sql);	

			if(!$get)
				die(mysql_error());
			$i = 0;
			//$hrs_ot = mysqli_fetch_field($get);
		
			while($row = mysql_fetch_array($get))
			{	//if($row[7] === 'Approved')
					$ot_count = $row[0];
			}	
			
			echo $ot_count;
			
?>