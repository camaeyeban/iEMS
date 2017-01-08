<?php
    		//$_POST['date_ot'] = "04/10/2015";

			session_start();
    		
			$tempdate = $_POST['date_os'];
			$os_id =$_POST['os_id'];
			$os_date_arr = explode('/',$tempdate);
			$os_date = $os_date_arr[2] . "-" . $os_date_arr[0] . "-" . $os_date_arr[1];
			//echo "<script> alert(".$ot_date."); </script>";
			include('config_DB.php');
		
			//echo "".$ot_date;
			$os_record = array();	
			
			$user = $_SESSION[emp_num];
			//echo $user;
			$sql  = "SELECT COUNT(*) FROM ems_offset_new where '$os_date' = date_offset AND offset_id != '$os_id' AND emp_num = '$user' AND status IN ('Pending' ,'Approved')";
			$get  = mysql_query($sql);	

			if(!$get)
				die(mysql_error());
			$i = 0;
			//$hrs_ot = mysqli_fetch_field($get);
		
			while($row = mysql_fetch_array($get))
			{	//if($row[7] === 'Approved')
					$os_count = $row[0];
			}	
			
			echo $os_count;
			
?>