<?php
    		//$_POST['date_ot'] = "04/10/2015";

			session_start();
    		
			$tempdate = $_POST['date_fr'];
			//$tempdate_to = $_POST['date_to'];
			$ob_id =$_POST['ob_id'];
			$ob_date_arr = explode('/',$tempdate);
			$ob_date = $ob_date_arr[2] . "-" . $ob_date_arr[0] . "-" . $ob_date_arr[1];
			//echo "<script> alert(".$ot_date."); </script>";
			include('config_DB.php');
		
			//echo "".$ot_date;
			$ob_record = array();	
			
			$user = $_SESSION[emp_num];
			//echo $user;
			$sql  = "SELECT COUNT(*) FROM ems_ob_new where ob_date LIKE '%$tempdate%' AND ob_id != '$ob_id' AND emp_num = '$user' AND status IN ('Pending for Approval' ,'Approved','Pending for Confirmation', 'Confirmed')";
			$get = mysql_query($sql);

			if(!$get)
				die(mysql_error());
			$i = 0;
			//$hrs_ot = mysqli_fetch_field($get);
		
			while($row = mysql_fetch_array($get))
			{	//if($row[7] === 'Approved')
					//echo '-> ' . $row[0];
					$ob_count = $row[0];
			}	
			
			echo $ob_count;
			
?>