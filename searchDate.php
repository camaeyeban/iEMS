<?php
    		//$_POST['date_ot'] = "04/10/2015";

			session_start();
    		$hrs_ot = 0;
			$tempdate = $_POST['date_ot'];
			$ot_date_arr = explode('/',$tempdate);
			$ot_date = $ot_date_arr[2] . "-" . $ot_date_arr[0] . "-" . $ot_date_arr[1];
			//echo "<script> alert(".$ot_date."); </script>";
			include('config_DB.php');
			//echo "".$ot_date;
			$ot_record = array();	

			$user = $_SESSION[emp_num];
			//echo $user;
			$sql  = "SELECT * FROM ems_ot where date_ot = '$ot_date' AND emp_num = '$user' AND status = 'Pending'";
			$get  = mysql_query($sql);	

			if(!$get)
				die(mysql_error());
			$i = 0;
			//$hrs_ot = mysqli_fetch_field($get);
		
			while($row = mysql_fetch_array($get))
			{	//if($row[7] === 'Approved')
					$hrs_ot = $row[6];
			}	
			
			echo $hrs_ot;
?>