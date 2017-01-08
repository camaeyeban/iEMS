<?php
			session_start();
    		
			
			
			include('config_DB.php');
			
			$comp_name = $_POST['comp_name'];
			$sql  = "SELECT COUNT(*) FROM ems_department where '$comp_name' = dept_name";
			$get  = mysql_query($sql);	

			if(!$get)
				die(mysql_error());
			$i = 0;
			
		
			while($row = mysql_fetch_array($get))
			{	
					$name_count = $row[0];
			}	
			
			echo $name_count;
			
?>