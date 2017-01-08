<?php
    		//$_POST['date_ut'] = "04/10/2015";

			session_start();
    		
			$tempdate = $_POST['date_ut'];
			$ut_id =$_POST['ut_id'];
			$ut_date_arr = explode('/',$tempdate);
			$ut_date = $ut_date_arr[2] . "-" . $ut_date_arr[0] . "-" . $ut_date_arr[1];
			//echo "<script> alert(".$ut_date."); </script>";
			include('config_DB.php');
		
			//echo "".$ut_date;
			$ut_record = array();	
			
			$user = $_SESSION[emp_num];
			//echo $user;
			$sql  = "SELECT COUNT(*) FROM ems_undertime where '$tempdate' = date_un AND un_id != '$ut_id' AND emp_num = '$user' AND status IN ('Pending' ,'Approved')";
			$get  = mysql_query($sql);	

			if(!$get)
				die(mysql_error());
			$i = 0;
			//$hrs_ut = mysqli_fetch_field($get);
		
			while($row = mysql_fetch_array($get))
			{	//if($row[7] === 'Approved')
					$ut_count = $row[0];
			}	
			
			echo $ut_count;
			
?>