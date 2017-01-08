<?php
    		//$_POST['date_lv'] = "04/10/2015";

			session_start();
    		
			$tempdate = $_POST['date_lv'];
			$lv_id =$_POST['lv_id'];
			$lv_date_arr = explode('/',$tempdate);
			$lv_date = $lv_date_arr[2] . "-" . $lv_date_arr[0] . "-" . $lv_date_arr[1];
			//echo "<script> alert(".$lv_date."); </script>";
			include('config_DB.php');
		
			//echo "".$lv_date;
			$lv_record = array();	
			
			$user = $_SESSION[emp_num];
			//echo $user;
			$sql  = "SELECT COUNT(*) FROM ems_leave where '$tempdate' BETWEEN d_from and d_to AND leave_id != '$lv_id' AND emp_num = '$user' AND status IN ('Pending' ,'Approved')";
			$get  = mysql_query($sql);	

			if(!$get)
				die(mysql_error());
			$i = 0;
			//$hrs_lv = mysqli_fetch_field($get);
		
			while($row = mysql_fetch_array($get))
			{	//if($row[7] === 'Approved')
					$lv_count = $row[0];
			}	
			
			echo $lv_count;
			
?>