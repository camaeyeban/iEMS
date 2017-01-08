<?php

@session_start();
ini_set('session.bug_compat_42',0);
ini_set('session.bug_compat_warn',0);

	include("config_DB.php");
	require("mysql_db_connect.inc.php");
	$dblink = new mysql_db_connect();
	if (!$dblink)
		die("no connection");
	include("functions.php");
	chk_active($_SESSION['user_id']);
	if(!isset($_SESSION['username'])){
		header("location: login.php");
	}
	
	//Restricts users whose rights is employee to export applications
	if($_SESSION['rights']==3){
		echo '<h1>',"Invalid URL",'</h1>';
		return false;
	}

	extract($_POST); //extract all form inputs in the previous pages

	//For Administrator/s
	if($_SESSION['rights']==1){
		switch($_POST['export_app']) //Name of the input
		{ //Value of input
			//START of LEAVE -----------------------------------------------------------------------------------------------------------------
			case 'export_leaveBtn':
			
				mysql_query("set names 'utf8'"); //JD-2012/12/03 - Added to fix character encoding mismatch between mysql and excel
				$getExcel = "SELECT date_Filed, CONCAT(e.emp_firstname,' ',e.emp_middlename,' ',e.emp_lastname), d_from, d_to, no_of_days, 
								l.type, reason, l.status
								FROM ems_leave as l
								INNER JOIN ems_employee as e ON e.emp_num = l.emp_num
								ORDER BY leave_id DESC";
			
				$res = mysql_query($getExcel);
			
				/** Error reporting */
				error_reporting(E_ALL);
				date_default_timezone_set('Asia/Manila'); //Timezone
			
				/** PHPExcel */
				require_once 'Classes/PHPExcel.php';
			
				// Create new PHPExcel object
				$objPHPExcel = new PHPExcel();

				$row = 4;
				while($mrow = mysql_fetch_assoc($res)) {
					set_time_limit(0); //Overrides the maximum execution time. Infinite
					$col = 0;
					foreach($mrow as $key=>$value) {
						$sheet = $objPHPExcel->getActiveSheet();
			
					//Styling the Worksheet
						$sheet->setTitle("iRipple Leave Applications");
						$objPHPExcel->getProperties()->setCreator($_SESSION['fullname']); //Name of the file creator
			
					//Merge certain cells and add value to it
						$sheet->mergeCells("A1:B1");
						$sheet->mergeCells("C1:D1");			
						$sheet->setCellValue("A1", "iRipple Leave Applications");
						$sheet->setCellValue("C1", "Prepared by: ".$_SESSION['fullname']); //show file creator inside the file			
			
					//Set Cell Values - Act as headers for each fields of the table
						$sheet->setCellValue('A3', 'Date Filed');
						$sheet->setCellValue('B3', 'Employee Name');
						$sheet->setCellValue('C3', 'From');
						$sheet->setCellValue('D3', 'To');
						$sheet->setCellValue('E3', 'No. of Days');
						$sheet->setCellValue('F3', 'Leave Type');
						$sheet->setCellValue('G3', 'Reason');
						$sheet->setCellValue('H3', 'Status');

					//Defines the width of the cells in Excel
						$sheet->setCellValueByColumnAndRow($col, $row, $value);
						$sheet->getColumnDimension("A")->setWidth(15); 
						$sheet->getColumnDimension("B")->setWidth(40); 
						$sheet->getColumnDimension("C")->setWidth(15); 
						$sheet->getColumnDimension("D")->setWidth(15); 
						$sheet->getColumnDimension("E")->setWidth(15); 
						$sheet->getColumnDimension("F")->setWidth(20); 
						$sheet->getColumnDimension("G")->setWidth(40); 
						$sheet->getColumnDimension("H")->setWidth(15);
			
					//Defines the alignment and font-weight of specific cells
						$sheet->getStyle("H".$sheet->getHighestRow())->getAlignment()->setWrapText(true);
						$sheet->getStyle("A")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
						$sheet->getStyle("F")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
						$sheet->getStyle("A3:H3")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
						$sheet->getStyle("A3:H3")->applyFromArray(array("font" => array( "bold" => true)));
						$col++; 
					} 
					$row++; 
				} 
			
				// Set active sheet index to the first sheet, so Excel opens this as the first sheet
				$objPHPExcel->setActiveSheetIndex(0);

				$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
				$objWriter->setPreCalculateFormulas(FALSE); 
				$objWriter->save('documents/emsAdmin-leaveApplications.xls'); //saves the file first
				//JD-2012/11/12 - Make message into a popup
				//JD-2012/11/23 - Changed from pop-up message to download box
				$file = 'documents/emsAdmin-leaveApplications.xls'; //locates the file to be downloaded
				
				//CREATE/OUTPUT THE HEADER
				header("Content-type: application/force-download");
				header("Content-Transfer-Encoding: Binary");
				header("Content-length: ".filesize($file));
				header("Content-disposition: attachment; filename=\"".basename($file)."\"");
				readfile($file);
				echo '<script>window.location.href="view_leave_undr.php";</script>'; //return to previous page
			break;
			//END of LEAVE -----------------------------------------------------------------------------------------------------------------------
			
			//START of UNDERTIME -----------------------------------------------------------------------------------------------------------------
			case 'export_underBtn': 
			
				mysql_query("set names 'utf8'"); //JD-2012/12/03 - Added to fix character encoding mismatch between mysql and excel
				$getExcel = "SELECT date_Filed, CONCAT(e.emp_firstname,' ',e.emp_middlename,' ',e.emp_lastname), date_un, nature_un, time, 
								reason, u.status
								FROM ems_undertime as u
								INNER JOIN ems_employee as e ON e.emp_num = u.emp_num
								ORDER BY un_id DESC";
				$res = mysql_query($getExcel);
				
				error_reporting(E_ALL);
				date_default_timezone_set('Asia/Manila');

				require_once 'Classes/PHPExcel.php';
				$objPHPExcel = new PHPExcel();
			
				$row = 4;
				while($mrow = mysql_fetch_assoc($res)) {
					set_time_limit(0);
					$col = 0;
					foreach($mrow as $key=>$value) {
						$sheet = $objPHPExcel->getActiveSheet();

					//Sets the title of the worksheet
						$sheet->setTitle("iRipple Undertime Applications");
						$objPHPExcel->getProperties()->setCreator($_SESSION['fullname']); //Name of the file creator
			
					//Merge certain cells and add value to it
						$sheet->mergeCells("A1:B1");
						$sheet->mergeCells("C1:D1");			
						$sheet->setCellValue("A1", "iRipple Undertime Applications");
						$sheet->setCellValue("C1", "Prepared by: ".$_SESSION['fullname']); //show file creator inside the file				
			
					//Set Cell Values - Act as headers for each fields of the table
						$sheet->setCellValue('A3', 'Date Filed');
						$sheet->setCellValue('B3', 'Employee Name');
						$sheet->setCellValue('C3', 'Date of Undertime');
						$sheet->setCellValue('D3', 'Nature of Undertime');
						$sheet->setCellValue('E3', 'Departure Time');
						$sheet->setCellValue('F3', 'Reason');
						$sheet->setCellValue('G3', 'Status');
			
					//Defines the width of the cells in Excel
						$sheet->setCellValueByColumnAndRow($col, $row, $value);
						$sheet->getColumnDimension("A")->setWidth(15);
						$sheet->getColumnDimension("B")->setWidth(40);
						$sheet->getColumnDimension("C")->setWidth(20);
						$sheet->getColumnDimension("D")->setWidth(23);
						$sheet->getColumnDimension("E")->setWidth(15);
						$sheet->getColumnDimension("F")->setWidth(40);
						$sheet->getColumnDimension("G")->setWidth(15);
			
					//Defines the alignment and font-weight of specific cells
						$sheet->getStyle("F".$sheet->getHighestRow())->getAlignment()->setWrapText(true);
						$sheet->getStyle("A")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
						$sheet->getStyle("A3:G3")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
						$sheet->getStyle("A3:G3")->applyFromArray(array("font" => array( "bold" => true)));
						$col++; 
					} 
					$row++; 
				}
			
				// Set active sheet index to the first sheet, so Excel opens this as the first sheet
				$objPHPExcel->setActiveSheetIndex(0);

				$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
				$objWriter->save('documents/emsAdmin-undertimeApplications.xls'); //saves the file first
				//JD-2012/11/12 - Make message into a popup
				//JD-2012/11/23 - Changed from pop-up message to download box
				$file = 'documents/emsAdmin-undertimeApplications.xls'; //locates the file to be downloaded
				
				//CREATE/OUTPUT THE HEADER
				header("Content-type: application/force-download");
				header("Content-Transfer-Encoding: Binary");
				header("Content-length: ".filesize($file));
				header("Content-disposition: attachment; filename=\"".basename($file)."\"");
				readfile($file);
				echo '<script>window.location.href="view_leave_undr.php";</script>'; //return to previous page
			break;
			//END of UNDERTIME -----------------------------------------------------------------------------------------------------------------------------
			
			//START of EMPLOYEE (EIM) List -----------------------------------------------------------------------------------------------------------------
			case 'export_infoBtn':
			
				mysql_query("set names 'utf8'"); //JD-2012/12/03 - Added to fix character encoding mismatch between mysql and excel
				$getExcel = "SELECT e.emp_num, CONCAT(e.emp_firstname,' ',e.emp_middlename,' ',e.emp_lastname), j.job_title_name, s.name,
								d.dept_name, e.date_employ, e.date_sep, CONCAT(e.address1,' ',e.city), e.mobile, 
								e.email, e.birthdate, e.sss, e.tin, e.pag_ibig, e.phil_health 
								FROM ems_employee AS e 
								LEFT JOIN ems_jobtitle AS j ON e.job_title_code = j.job_title_code
								LEFT JOIN ems_emp_status AS s ON e.code = s.code
								LEFT JOIN ems_department AS d ON e.dept_code = d.dept_code
								WHERE e.emp_num!=1";
			
				$res = mysql_query($getExcel);

				error_reporting(E_ALL);
				date_default_timezone_set('Asia/Manila');

				require_once 'Classes/PHPExcel.php';

				$objPHPExcel = new PHPExcel();

				$row = 4;
				while($mrow = mysql_fetch_assoc($res)) {
					set_time_limit(0);
					$col = 0;
					foreach($mrow as $key=>$value) {
						$sheet = $objPHPExcel->getActiveSheet();
						
					//Sets the title of the worksheet
						$sheet->setTitle("iRipple Employee List");
						$objPHPExcel->getProperties()->setCreator($_SESSION['fullname']); //Name of the file creator
			
					//Merge certain cells and add value to it
						$sheet->mergeCells("A1:B1");
						$sheet->mergeCells("C1:D1");			
						$sheet->setCellValue("A1", "iRipple Employee List");
						$sheet->setCellValue("C1", "Prepared by: ".$_SESSION['fullname']); //show the file creator inside the file
			
					//Set Cell Values - Act as headers for each fields of the table
						$sheet->setCellValue('A3', 'Employee Number');
						$sheet->setCellValue('B3', 'Employee Name');
						$sheet->setCellValue('C3', 'Job Title');
						$sheet->setCellValue('D3', 'Employment Status');
						$sheet->setCellValue('E3', 'Department');
						$sheet->setCellValue('F3', 'Date of Employment');
						$sheet->setCellValue('G3', 'Date of Separation');
						$sheet->setCellValue('H3', 'Address');
						$sheet->setCellValue('I3', 'Mobile Number');
						$sheet->setCellValue('J3', 'Email Address');
						$sheet->setCellValue('K3', 'Birthdate');
						$sheet->setCellValue('L3', 'SSS Number');
						$sheet->setCellValue('M3', 'TIN Number');
						$sheet->setCellValue('N3', 'Pag-Ibig');
						$sheet->setCellValue('O3', 'Phil-Health');
			
					//Defines the width of the cells in Excel
						$sheet->setCellValueByColumnAndRow($col, $row, $value); 
						$sheet->getColumnDimension("A")->setWidth(20); 
						$sheet->getColumnDimension("B")->setWidth(40); 
						$sheet->getColumnDimension("C")->setWidth(40); 
						$sheet->getColumnDimension("D")->setWidth(30); 
						$sheet->getColumnDimension("E")->setWidth(30); 
						$sheet->getColumnDimension("F")->setWidth(25); 
						$sheet->getColumnDimension("G")->setWidth(25); 
						$sheet->getColumnDimension("H")->setWidth(50); 
						$sheet->getColumnDimension("I")->setWidth(20); 
						$sheet->getColumnDimension("J")->setWidth(35);  
						$sheet->getColumnDimension("K")->setWidth(20);  
						$sheet->getColumnDimension("L")->setWidth(25);  
						$sheet->getColumnDimension("M")->setWidth(25);  
						$sheet->getColumnDimension("N")->setWidth(25);  
						$sheet->getColumnDimension("O")->setWidth(25);
			
					//Defines the alignment and font-weight of specific cells
					//First Line sets Text wrapping
						$sheet->getStyle("H".$sheet->getHighestRow())->getAlignment()->setWrapText(true); 
						$sheet->getStyle("A")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
						$sheet->getStyle("A3:O3")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
						$sheet->getStyle("A3:O3")->applyFromArray(array("font" => array( "bold" => true)));
						$col++; 
					} 
					$row++; 
				} 
			
				// Set active sheet index to the first sheet, so Excel opens this as the first sheet
				$objPHPExcel->setActiveSheetIndex(0);
				
				$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
				$objWriter->setPreCalculateFormulas(FALSE);
				$objWriter->save('documents/emsAdmin-employeeList.xls'); //saves the file first
				//JD-2012/11/12 - Make message into a popup
				//JD-2012/11/23 - Changed from pop-up message to download box
				$file = 'documents/emsAdmin-employeeList.xls'; //locates the file to be downloaded
				
				//CREATE/OUTPUT THE HEADER
				header("Content-type: application/force-download;");
				header("Content-Transfer-Encoding: Binary");
				header("Content-length: ".filesize($file));
				header("Content-disposition: attachment; filename=\"".basename($file)."\"");
				readfile($file);
				echo '<script>window.location.href="emp_info.php";</script>'; //return to previous page
			break; 
			//END of EMPLOYEE (EIM) List -----------------------------------------------------------------------------------------------------------------
			
			//START of OVERTIME --------------------------------------------------------------------------------------------------------------------------
			case 'export_overtimeBtn':
			
				mysql_query("set names 'utf8'"); //JD-2012/12/03 - Added to fix character encoding mismatch between mysql and excel
				$getExcel = "SELECT ot.date_filed, ot.date_ot, CONCAT(e.emp_firstname,' ',e.emp_middlename,' ',e.emp_lastname), ot.no_of_hours,
								ot.expected_output, ot.status
								FROM ems_ot as ot 
								JOIN ems_accomplishments as a ON ot.ot_id = a.ot_id
								JOIN ems_employee as e ON e.emp_num = ot.emp_num
								ORDER BY ot.ot_id DESC";
			
				$res = mysql_query($getExcel);

				error_reporting(E_ALL);
				date_default_timezone_set('Asia/Manila');

				require_once 'Classes/PHPExcel.php';

				$objPHPExcel = new PHPExcel();
			
				$row = 4;
				while($mrow = mysql_fetch_assoc($res)) {
					set_time_limit(0);
					$col = 0;
					foreach($mrow as $key=>$value) {
						$sheet = $objPHPExcel->getActiveSheet();

					//Sets the title of the worksheet
						$sheet->setTitle("iRipple Overtime Applications");
						$objPHPExcel->getProperties()->setCreator($_SESSION['fullname']); //Name of the file creator
			
					//Merge certain cells and add value to it
						$sheet->mergeCells("A1:B1");
						$sheet->mergeCells("C1:D1");
						$sheet->setCellValue("A1", "iRipple Overtime Applications");
						$sheet->setCellValue("C1", "Prepared by: ".$_SESSION['fullname']); //show file creator inside the file			
			
					//Set Cell Values - Act as headers for each fields of the table
						$sheet->setCellValue('A3', 'Date Filed');
						$sheet->setCellValue('B3', 'Date of Overtime');
						$sheet->setCellValue('C3', 'Employee Name');
						$sheet->setCellValue('D3', 'No. of Hours');
						$sheet->setCellValue('E3', 'Expected Output');
						$sheet->setCellValue('F3', 'Overtime Status');
						//$sheet->setCellValue'H3', 'Accomplishment Status');
			
					//Defines the width of the cells in Excel
						$sheet->setCellValueByColumnAndRow($col, $row, $value); 
						$sheet->getColumnDimension("A")->setWidth(20); 
						$sheet->getColumnDimension("B")->setWidth(20); 
						$sheet->getColumnDimension("C")->setWidth(40); 
						$sheet->getColumnDimension("D")->setWidth(15); 
						$sheet->getColumnDimension("E")->setWidth(40); 
						$sheet->getColumnDimension("F")->setWidth(15); 
						//$sheet->getColumnDimension("H")->setWidth(30);
			
					//Defines the alignment and font-weight of specific cells
						$sheet->getStyle("E".$sheet->getHighestRow())->getAlignment()->setWrapText(true); 
						$sheet->getStyle("A")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
						$sheet->getStyle("D")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
						$sheet->getStyle("A3:F3")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
						$sheet->getStyle("A3:F3")->applyFromArray(array("font" => array( "bold" => true)));
						$col++; 
					} 
					$row++; 
				} 
			
				// Set active sheet index to the first sheet, so Excel opens this as the first sheet
				$objPHPExcel->setActiveSheetIndex(0);

				$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
				$objWriter->save('documents/emsAdmin-otApplications.xls'); //saves the file first
				//JD-2012/11/12 - Make message into a popup
				//JD-2012/11/23 - Changed from pop-up message to download box
				$file = 'documents/emsAdmin-otApplications.xls'; //locates the file to be downloaded
				
				//CREATE/OUTPUT THE HEADER
				header("Content-type: application/force-download");
				header("Content-Transfer-Encoding: Binary");
				header("Content-length: ".filesize($file));
				header("Content-disposition: attachment; filename=\"".basename($file)."\"");
				readfile($file);
				echo '<script>window.location.href="view_ot_accomplishment.php";</script>'; //return to previous page
			break;
			//END of OVERTIME ----------------------------------------------------------------------------------------------------------------------------
			
			//START of OFFSET ----------------------------------------------------------------------------------------------------------------------------
			case 'export_offsetBtn':
			
				mysql_query("set names 'utf8'"); //JD-2012/12/03 - Added to fix character encoding mismatch between mysql and excel
				$getExcel = "SELECT o.date_Filed, CONCAT(e.emp_firstname,' ',e.emp_middlename,' ',e.emp_lastname), o.date_ot, o.ot_hours, 
								accomplishment, o.date_offset, o.status
								FROM ems_offset as o
								INNER JOIN ems_employee as e ON o.emp_num  = e.emp_num					
								ORDER BY o.offset_id DESC";
			
				$res = mysql_query($getExcel);

				error_reporting(E_ALL);
				date_default_timezone_set('Asia/Manila');

				require_once 'Classes/PHPExcel.php';

				$objPHPExcel = new PHPExcel();
			
				$row = 4;
				while($mrow = mysql_fetch_assoc($res)) {
					set_time_limit(0);
					$col = 0;
					foreach($mrow as $key=>$value) {
						$sheet = $objPHPExcel->getActiveSheet();

					//Sets the title of the worksheet
						$sheet->setTitle("iRipple Offset Applications");
						$objPHPExcel->getProperties()->setCreator($_SESSION['fullname']); //Name of the file creator
			
					//Merge certain cells and add value to it
						$sheet->mergeCells("A1:B1");
						$sheet->mergeCells("C1:D1");			
						$sheet->setCellValue("A1", "iRipple Offset Applications");
						$sheet->setCellValue("C1", "Prepared by: ".$_SESSION['fullname']); //show file creator inside the file			
			
					//Set Cell Values - Act as headers for each fields of the table
						$sheet->setCellValue('A3', 'Date Filed');
						$sheet->setCellValue('B3', 'Employee Name');
						$sheet->setCellValue('C3', 'Overtime Date');
						$sheet->setCellValue('D3', 'No. of Hours');
						$sheet->setCellValue('E3', 'Accomplishment');
						$sheet->setCellValue('F3', 'Offset Date');
						$sheet->setCellValue('G3', 'Offset Status');
		
					//Defines the width of the cells in Excel
						$sheet->setCellValueByColumnAndRow($col, $row, $value);
						$sheet->getColumnDimension("A")->setWidth(20); 
						$sheet->getColumnDimension("B")->setWidth(40); 
						$sheet->getColumnDimension("C")->setWidth(20); 
						$sheet->getColumnDimension("D")->setWidth(15); 
						$sheet->getColumnDimension("E")->setWidth(50); 
						$sheet->getColumnDimension("F")->setWidth(20); 
						$sheet->getColumnDimension("G")->setWidth(15);
			
					//Defines the alignment and font-weight of specific cells
						$sheet->getStyle("E".$sheet->getHighestRow())->getAlignment()->setWrapText(true);
						$sheet->getStyle("G".$sheet->getHighestRow())->getAlignment()->setWrapText(true); 
						$sheet->getStyle("A")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
						$sheet->getStyle("D")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
						$sheet->getStyle("A3:G3")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
						$sheet->getStyle("A3:G3")->applyFromArray(array("font" => array( "bold" => true)));
						$col++; 
					} 
					$row++; 
				} 
			
				// Set active sheet index to the first sheet, so Excel opens this as the first sheet
				$objPHPExcel->setActiveSheetIndex(0);

				$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
				$objWriter->save('documents/emsAdmin-offsetApplications.xls'); //saves the file first
				//JD-2012/11/12 - Make message into a popup
				//JD-2012/11/23 - Changed from pop-up message to download box
				$file = 'documents/emsAdmin-offsetApplications.xls'; //locates the file to be downloaded
				
				//CREATE/OUTPUT THE HEADER
				header("Content-type: application/force-download");
				header("Content-Transfer-Encoding: Binary");
				header("Content-length: ".filesize($file));
				header("Content-disposition: attachment; filename=\"".basename($file)."\"");
				readfile($file);
				echo '<script>window.location.href="view_offset_request.php";</script>'; //return to previous page
			break;
			//END of OFFSET ------------------------------------------------------------------------------------------------------------------------------
			
			//START of OFFICIAL BUSINESS -----------------------------------------------------------------------------------------------------------------
			case 'export_officialBtn':
			
				mysql_query("set names 'utf8'"); //JD-2012/12/03 - Added to fix character encoding mismatch between mysql and excel
				$getExcel = "SELECT date_Filed, CONCAT(e.emp_firstname,' ',e.emp_middlename,' ',e.emp_lastname), client_branch, ob_from, ob_to, purpose, 
								departure, arrival, status, total
								FROM ems_ob AS o
								INNER JOIN ems_employee AS e ON e.emp_num = o.emp_num
								ORDER BY o.ob_id DESC";
			
				$res = mysql_query($getExcel);

				error_reporting(E_ALL);
				date_default_timezone_set('Asia/Manila');

				require_once 'Classes/PHPExcel.php';

				$objPHPExcel = new PHPExcel();
			
				$row = 4;
				while($mrow = mysql_fetch_assoc($res)) {
					set_time_limit(0);
					$col = 0;
					foreach($mrow as $key=>$value) {
						$sheet = $objPHPExcel->getActiveSheet();

					//Sets the title of the worksheet
						$sheet->setTitle("iRipple OB Applications");
						$objPHPExcel->getProperties()->setCreator($_SESSION['fullname']); //Name of the file creator
			
					//Merge certain cells and add value to it
						$sheet->mergeCells("A1:B1");
						$sheet->mergeCells("C1:D1");			
						$sheet->setCellValue("A1", "iRipple OB Applications");
						$sheet->setCellValue("C1", "Prepared by: ".$_SESSION['fullname']); //show file creator inside the file			
			
					//Set Cell Values - Act as headers for each fields of the table
						$sheet->setCellValue('A3', 'Date Filed');
						$sheet->setCellValue('B3', 'Employee Name');
						$sheet->setCellValue('C3', 'Client Name');
						$sheet->setCellValue('D3', 'From');
						$sheet->setCellValue('E3', 'To');
						$sheet->setCellValue('F3', 'Purpose');
						$sheet->setCellValue('G3', 'Departure');
						$sheet->setCellValue('H3', 'Arrival');
						$sheet->setCellValue('I3', 'Status');
						$sheet->setCellValue('J3', 'Total Hours');
			
					//Defines the width of the cells in Excel
						$sheet->setCellValueByColumnAndRow($col, $row, $value); 
						$sheet->getColumnDimension("A")->setWidth(20); 
						$sheet->getColumnDimension("B")->setWidth(40); 
						$sheet->getColumnDimension("C")->setWidth(40); 
						$sheet->getColumnDimension("D")->setWidth(15); 
						$sheet->getColumnDimension("E")->setWidth(15); 
						$sheet->getColumnDimension("F")->setWidth(40); 
						$sheet->getColumnDimension("G")->setWidth(20); 
						$sheet->getColumnDimension("H")->setWidth(20); 
						$sheet->getColumnDimension("I")->setWidth(15);
						$sheet->getColumnDimension("J")->setWidth(15);
			
					//Defines the alignment and font-weight of specific cells
					//First line sets the textwrap attribute
						$sheet->getStyle("F".$sheet->getHighestRow())->getAlignment()->setWrapText(true);
						$sheet->getStyle("A")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
						$sheet->getStyle("A3:J3")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
						$sheet->getStyle("J")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
						$sheet->getStyle("A3:J3")->applyFromArray(array("font" => array( "bold" => true)));
						$col++; 
					} 
					$row++; 
				} 

				// Set active sheet index to the first sheet, so Excel opens this as the first sheet
				$objPHPExcel->setActiveSheetIndex(0);

				$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
				$objWriter->save('documents/emsAdmin-obApplications.xls'); //saves the file first
				//JD-2012/11/12 - Make message into a popup
				//JD-2012/11/23 - Changed from pop-up message to download box
				$file = 'documents/emsAdmin-obApplications.xls'; //locates the file to be downloaded
				
				//CREATE/OUTPUT THE HEADER
				header("Content-type: application/force-download");
				header("Content-Transfer-Encoding: Binary");
				header("Content-length: ".filesize($file));
				header("Content-disposition: attachment; filename=\"".basename($file)."\"");
				readfile($file);
				echo '<script>window.location.href="view_ob_request.php";</script>'; //return to previous page
			break;
			//END of OFFICIAL BUSINESS -------------------------------------------------------------------------------------------------------------------
			
			//START of RESERVATION -----------------------------------------------------------------------------------------------------------------------
			case 'export_reserveBtn':
			
				mysql_query("set names 'utf8'"); //JD-2012/12/03 - Added to fix character encoding mismatch between mysql and excel
				$getExcel = "SELECT r.date_Filed, CONCAT(e.emp_firstname,' ',e.emp_middlename,' ',e.emp_lastname), subject_purpose, 
								date_from, date_to, no_of_days, equip_list, r.status 
								FROM ems_equip_requests as r 
								INNER JOIN ems_employee as e ON r.emp_num  = e.emp_num
								ORDER BY r.erqst_id DESC";
			
				$res = mysql_query($getExcel);

				error_reporting(E_ALL);
				date_default_timezone_set('Asia/Manila');

				require_once 'Classes/PHPExcel.php';

				$objPHPExcel = new PHPExcel();
			
				$row = 4;
				while($mrow = mysql_fetch_assoc($res)) {
					set_time_limit(0);
					$col = 0;
					foreach($mrow as $key=>$value) {
						$sheet = $objPHPExcel->getActiveSheet();

					//Sets the title of the worksheet
						$sheet->setTitle("iRipple Equipment Reservation");
						$objPHPExcel->getProperties()->setCreator($_SESSION['fullname']); //Name of the file creator
			
					//Merge certain cells and add value to it
						$sheet->mergeCells("A1:B1");
						$sheet->mergeCells("C1:D1");			
						$sheet->setCellValue("A1", "iRipple Equipment Reservation");
						$sheet->setCellValue("C1", "Prepared by: ".$_SESSION['fullname']); //show file creator inside the file				
			
					//Set Cell Values - Act as headers for each fields of the table
						$sheet->setCellValue('A3', 'Date Filed');
						$sheet->setCellValue('B3', 'Employee Name');
						$sheet->setCellValue('C3', 'Purpose');
						$sheet->setCellValue('D3', 'From');
						$sheet->setCellValue('E3', 'To');
						$sheet->setCellValue('F3', 'No. of Days');
						$sheet->setCellValue('G3', 'Equipment List');
						$sheet->setCellValue('H3', 'Status');
			
					//Defines the width of the cells in Excel
						$sheet->setCellValueByColumnAndRow($col, $row, $value); 
						$sheet->getColumnDimension("A")->setWidth(20); 
						$sheet->getColumnDimension("B")->setWidth(40); 
						$sheet->getColumnDimension("C")->setWidth(50); 
						$sheet->getColumnDimension("D")->setWidth(15); 
						$sheet->getColumnDimension("E")->setWidth(15); 
						$sheet->getColumnDimension("F")->setWidth(15); 
						$sheet->getColumnDimension("G")->setWidth(50); 
						$sheet->getColumnDimension("H")->setWidth(15);

					//First Line sets the wrap text to a column
						$sheet->getStyle("C".$sheet->getHighestRow())->getAlignment()->setWrapText(true); 
						$sheet->getStyle("H".$sheet->getHighestRow())->getAlignment()->setWrapText(true); 
						$sheet->getStyle("A")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
						$sheet->getStyle("A3:H3")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
						$sheet->getStyle("A3:H3")->applyFromArray(array("font" => array( "bold" => true)));
						$col++; 
					} 
					$row++; 
				} 
			
				// Set active sheet index to the first sheet, so Excel opens this as the first sheet
				$objPHPExcel->setActiveSheetIndex(0);

				$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
				$objWriter->save('documents/emsAdmin-equipReservations.xls'); //saves the file first
				//JD-2012/11/12 - Make message into a popup
				//JD-2012/11/23 - Changed from pop-up message to download box
				$file = 'documents/emsAdmin-equipReservations.xls'; //locates the file to be downloaded
				
				//CREATE/OUTPUT THE HEADER
				header("Content-type: application/force-download");
				header("Content-Transfer-Encoding: Binary");
				header("Content-length: ".filesize($file));
				header("Content-disposition: attachment; filename=\"".basename($file)."\"");
				readfile($file);
				echo '<script>window.location.href="view_reservation.php";</script>'; //return to previous page
			break;
			//END of RESERVATION -------------------------------------------------------------------------------------------------------------------------

			//START of REQUISITION -----------------------------------------------------------------------------------------------------------------------
			case 'export_requisiteBtn':
			
				mysql_query("set names 'utf8'"); //JD-2012/12/03 - Added to fix character encoding mismatch between mysql and excel
				$getExcel = "SELECT r.date_Filed, CONCAT(e.emp_firstname,' ',e.emp_middlename,' ',e.emp_lastname), r.date_needed, r.items, 
								r.qty, amount, r.purpose, r.status
								FROM ems_equip_requisitions as r
								INNER JOIN ems_employee as e ON r.emp_num = e.emp_num
								ORDER BY r.erqstn_id DESC";
			
				$res = mysql_query($getExcel);

				error_reporting(E_ALL);
				date_default_timezone_set('Asia/Manila');

				require_once 'Classes/PHPExcel.php';

				$objPHPExcel = new PHPExcel();
			
				$row = 4;
				while($mrow = mysql_fetch_assoc($res)) {
					set_time_limit(0);
					$col = 0;
					foreach($mrow as $key=>$value) {
						$sheet = $objPHPExcel->getActiveSheet();

					//Sets the title of the worksheet
						$sheet->setTitle("iRipple Equipment Requisition");
						$objPHPExcel->getProperties()->setCreator($_SESSION['fullname']); //Name of the file creator
			
					//Merge certain cells and add value to it
						$sheet->mergeCells("A1:B1");
						$sheet->mergeCells("C1:D1");			
						$sheet->setCellValue("A1", "iRipple Equipment Requisition");
						$sheet->setCellValue("C1", "Prepared by: ".$_SESSION['fullname']); //show file creator inside the file				
			
					//Set Cell Values - Act as headers for each fields of the table
						$sheet->setCellValue('A3', 'Date Filed');
						$sheet->setCellValue('B3', 'Employee Name');
						$sheet->setCellValue('C3', 'Date Needed');
						$sheet->setCellValue('D3', 'Items');
						$sheet->setCellValue('E3', 'Quantity');
						$sheet->setCellValue('F3', 'Amount');
						$sheet->setCellValue('G3', 'Purpose');
						$sheet->setCellValue('H3', 'Status');
			
					//Defines the width of the cells in Excel
						$sheet->setCellValueByColumnAndRow($col, $row, $value); 
						$sheet->getColumnDimension("A")->setWidth(20); 
						$sheet->getColumnDimension("B")->setWidth(40); 
						$sheet->getColumnDimension("C")->setWidth(20); 
						$sheet->getColumnDimension("D")->setWidth(50); 
						$sheet->getColumnDimension("E")->setWidth(20); 
						$sheet->getColumnDimension("F")->setWidth(20); 
						$sheet->getColumnDimension("G")->setWidth(40); 
						$sheet->getColumnDimension("H")->setWidth(15);

					//First Line sets the wrap text to a column
						$sheet->getStyle("D".$sheet->getHighestRow())->getAlignment()->setWrapText(true); 
						$sheet->getStyle("E".$sheet->getHighestRow())->getAlignment()->setWrapText(true); 
						$sheet->getStyle("G".$sheet->getHighestRow())->getAlignment()->setWrapText(true);
						$sheet->getStyle("A")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
						$sheet->getStyle("H")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
						$sheet->getStyle("A3:H3")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
						$sheet->getStyle("A3:H3")->applyFromArray(array("font" => array( "bold" => true)));
						$col++; 
					} 
					$row++; 
				} 
			
				// Set active sheet index to the first sheet, so Excel opens this as the first sheet
				$objPHPExcel->setActiveSheetIndex(0);

				$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
				$objWriter->save('documents/emsAdmin-equipRequisitions.xls'); //saves the file first
				//JD-2012/11/12 - Make message into a popup
				//JD-2012/11/23 - Changed from pop-up message to download box
				$file = 'documents/emsAdmin-equipRequisitions.xls'; //locates the file to be downloaded
				
				//CREATE/OUTPUT THE HEADER
				header("Content-type: application/force-download");
				header("Content-Transfer-Encoding: Binary");
				header("Content-length: ".filesize($file));
				header("Content-disposition: attachment; filename=\"".basename($file)."\"");
				readfile($file);
				echo '<script>window.location.href="view_requisition.php";</script>'; //return to previous page
			break;
			//END of REQUISITION -------------------------------------------------------------------------------------------------------------------------

			//START of AIRTICKET -------------------------------------------------------------------------------------------------------------------------
			case 'export_airticketBtn':
			
				mysql_query("set names 'utf8'"); //JD-2012/12/03 - Added to fix character encoding mismatch between mysql and excel
				$getExcel = "SELECT a.date_Filed, CONCAT(e.emp_firstname,' ',e.emp_middlename,' ',e.emp_lastname), origin, destination, a.client,
								departure, arrival, purpose, a.status, amount
								FROM ems_air_ticket as a
								INNER JOIN ems_employee as e ON a.emp_num = e.emp_num
								ORDER BY a.at_id DESC";
			
				$res = mysql_query($getExcel);

				error_reporting(E_ALL);
				date_default_timezone_set('Asia/Manila');

				require_once 'Classes/PHPExcel.php';

				$objPHPExcel = new PHPExcel();
			
				$row = 4;
				while($mrow = mysql_fetch_assoc($res)) {
					set_time_limit(0);
					$col = 0;
					foreach($mrow as $key=>$value) {
						$sheet = $objPHPExcel->getActiveSheet();

					//Sets the title of the worksheet
						$sheet->setTitle("iRipple Airticket Applications");
						$objPHPExcel->getProperties()->setCreator($_SESSION['fullname']); //Name of the file creator
			
					//Merge certain cells and add value to it
						$sheet->mergeCells("A1:B1");
						$sheet->mergeCells("C1:D1");			
						$sheet->setCellValue("A1", "iRipple Airticket Applications");
						$sheet->setCellValue("C1", "Prepared by: ".$_SESSION['fullname']); //show file creator inside the file				
			
					//Set Cell Values - Act as headers for each fields of the table
						$sheet->setCellValue('A3', 'Date Filed');
						$sheet->setCellValue('B3', 'Employee Name');
						$sheet->setCellValue('C3', 'Origin');
						$sheet->setCellValue('D3', 'Destination');
						$sheet->setCellValue('E3', 'Client');
						$sheet->setCellValue('F3', 'Departure');
						$sheet->setCellValue('G3', 'Arrival');
						$sheet->setCellValue('H3', 'Purpose');
						$sheet->setCellValue('I3', 'Status');
						$sheet->setCellValue('J3', 'Amount');
			
					//Defines the width of the cells in Excel
						$sheet->setCellValueByColumnAndRow($col, $row, $value); 
						$sheet->getColumnDimension("A")->setWidth(20); 
						$sheet->getColumnDimension("B")->setWidth(40); 
						$sheet->getColumnDimension("C")->setWidth(40); 
						$sheet->getColumnDimension("D")->setWidth(40); 
						$sheet->getColumnDimension("E")->setWidth(40); 
						$sheet->getColumnDimension("F")->setWidth(40); 
						$sheet->getColumnDimension("G")->setWidth(30); 
						$sheet->getColumnDimension("H")->setWidth(50); 
						$sheet->getColumnDimension("I")->setWidth(15); 
						$sheet->getColumnDimension("J")->setWidth(15);

					//First Line sets the wrap text to a column
						$sheet->getStyle("C".$sheet->getHighestRow())->getAlignment()->setWrapText(true); 
						$sheet->getStyle("D".$sheet->getHighestRow())->getAlignment()->setWrapText(true); 
						$sheet->getStyle("F".$sheet->getHighestRow())->getAlignment()->setWrapText(true);
						$sheet->getStyle("G".$sheet->getHighestRow())->getAlignment()->setWrapText(true);
						$sheet->getStyle("H".$sheet->getHighestRow())->getAlignment()->setWrapText(true);
						$sheet->getStyle("A")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
						$sheet->getStyle("A3:J3")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
						$sheet->getStyle("A3:J3")->applyFromArray(array("font" => array( "bold" => true)));
						$col++; 
					} 
					$row++; 
				} 
			
				// Set active sheet index to the first sheet, so Excel opens this as the first sheet
				$objPHPExcel->setActiveSheetIndex(0);

				$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
				$objWriter->save('documents/emsAdmin-airticketRqsts.xls'); //saves the file first
				//JD-2012/11/12 - Make message into a popup
				//JD-2012/11/23 - Changed from pop-up message to download box
				$file = 'documents/emsAdmin-airticketRqsts.xls'; //locates the file to be downloaded
				
				//CREATE/OUTPUT THE HEADER
				header("Content-type: application/force-download");
				header("Content-Transfer-Encoding: Binary");
				header("Content-length: ".filesize($file));
				header("Content-disposition: attachment; filename=\"".basename($file)."\"");
				readfile($file);
				echo '<script>window.location.href="view_airticket_request.php?searchby=0&search=&submit=search";</script>'; //return to previous page
			break;
			//END of AIRTICKET ---------------------------------------------------------------------------------------------------------------------------
		}
	}
	
	//For Managers
	//JD-2013/05/22 - Replaced all dept_code='$depcode' with b_manager_name='$bman' 
	//					to get and export the applications of a manager in one or more departments
	//-----> Start of modification
	elseif($_SESSION['rights']==2){
		extract($_POST);
		
		switch($_POST['export']) //Name of the input
		{
			//START of LEAVE -----------------------------------------------------------------------------------------------------------------------------
			case 'export_leaveBtn': //Value of the input
				$report = stripslashes($report);
				$qoic = stripslashes($qoic);
				
				mysql_query("set names 'utf8'"); //JD-2012/12/03 - Added to fix character encoding mismatch between mysql and excel
				//JD-2013/05/22 - Added table ems_business_units to get manager name in one or more department
				//				- Replaced dept_code='$depcode' with b.b_manager_name='$bman'
				//JD-2014/03/18 - Replaced b.b_id=e.b_id with b.dept_code = e.dept_code
				$getExcel = "SELECT date_Filed, CONCAT(e.emp_firstname,' ',e.emp_middlename,' ',e.emp_lastname), d_from, d_to, 
								no_of_days, l.type, reason, l.status
								FROM ems_leave as l
								INNER JOIN ems_employee as e ON e.emp_num = l.emp_num
								INNER JOIN ems_users AS u ON e.emp_num = u.emp_num
								LEFT JOIN ems_business_units b ON b.dept_code = e.dept_code
								WHERE (b.b_manager_name='$bman' OR (e.dept_code IN($qoic) AND rights!=2) 
								OR (e.dept_code IN ($report) AND rights=2))
								AND l.emp_num!='$emp_num' and l.emp_num!='$_SESSION[emp_num]'
								ORDER BY leave_id DESC";

				$res = mysql_query($getExcel);
			
				/** Error reporting */
				error_reporting(E_ALL);
				date_default_timezone_set('Asia/Manila');
			
				/** PHPExcel */
				require_once 'Classes/PHPExcel.php';
			
				// Create new PHPExcel object
				//echo date('H:i:s') . " Create new PHPExcel object\n";
				$objPHPExcel = new PHPExcel();
			
				$row = 4;
				while($mrow = mysql_fetch_assoc($res)) {
					set_time_limit(0);
					$col = 0;
					foreach($mrow as $key=>$value) {
						$sheet = $objPHPExcel->getActiveSheet();
			
					//Styling the Worksheet
					//Sets the title of the worksheet
						$sheet->setTitle("iRipple Leave Applications");
						$objPHPExcel->getProperties()->setCreator($_SESSION['fullname']); //Name of the file creator
			
					//Merge certain cells and add value to it
						$sheet->mergeCells("A1:B1");
						$sheet->mergeCells("C1:D1");			
						$sheet->setCellValue("A1", "iRipple Leave Applications");
						$sheet->setCellValue("C1", "Prepared by: ".$_SESSION['fullname']); //show file creator inside the file					

					//Set Cell Values - Act as headers for each fields of the table
						$sheet->setCellValue('A3', 'Date Filed');
						$sheet->setCellValue('B3', 'Employee Name');
						$sheet->setCellValue('C3', 'From');
						$sheet->setCellValue('D3', 'To');
						$sheet->setCellValue('E3', 'No. of Days');
						$sheet->setCellValue('F3', 'Leave Type');
						$sheet->setCellValue('G3', 'Reason');
						$sheet->setCellValue('H3', 'Status');

					//Defines the width of the cells in Excel
						$sheet->setCellValueByColumnAndRow($col, $row, $value);
						$sheet->getColumnDimension("A")->setWidth(15); 
						$sheet->getColumnDimension("B")->setWidth(40); 
						$sheet->getColumnDimension("C")->setWidth(15); 
						$sheet->getColumnDimension("D")->setWidth(15); 
						$sheet->getColumnDimension("E")->setWidth(15); 
						$sheet->getColumnDimension("F")->setWidth(25); 
						$sheet->getColumnDimension("G")->setWidth(40); 
						$sheet->getColumnDimension("H")->setWidth(15);

					//Defines the alignment and font-weight of specific cells
						$sheet->getStyle("G".$sheet->getHighestRow())->getAlignment()->setWrapText(true);
						$sheet->getStyle("A")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
						$sheet->getStyle("A3:H3")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
						$sheet->getStyle("A3:H3")->applyFromArray(array("font" => array( "bold" => true)));
						$col++; 
					} 
					$row++; 
				} 
			
				// Set active sheet index to the first sheet, so Excel opens this as the first sheet
				$objPHPExcel->setActiveSheetIndex(0);

				$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
				$objWriter->save('documents/emsManager-leaveApplications.xls'); //saves the file first
				//JD-2012/11/12 - Make message into a popup
				//JD-2012/11/23 - Changed from pop-up message to download box
				$file = 'documents/emsManager-leaveApplications.xls'; //locates the file to be downloaded
				
				//CREATE/OUTPUT THE HEADER
				header("Content-type: application/force-download");
				header("Content-Transfer-Encoding: Binary");
				header("Content-length: ".filesize($file));
				header("Content-disposition: attachment; filename=\"".basename($file)."\"");
				readfile($file);
				echo '<script>window.location.href="view_leave_undr.php?searchby=0&search=&submit=search_lv";</script>'; //return to previous page
			break;
			//END of LEAVE ------------------------------------------------------------------------------------------------------------------------------

			//START of UNDERTIME ------------------------------------------------------------------------------------------------------------------------
			case 'export_underBtn':
				
				$report = stripslashes($report);
				$qoic = stripslashes($qoic);
				
				mysql_query("set names 'utf8'"); //JD-2012/12/03 - Added to fix character encoding mismatch between mysql and excel
				//JD-2013/05/22 - Added table ems_business_units to get manager name in one or more department
				//				- Replaced dept_code='$depcode' with b.b_manager_name='$bman'
				//JD-2014/03/18 - Replaced b.b_id=e.b_id with b.dept_code = e.dept_code
				$getExcel = "SELECT date_Filed, CONCAT(e.emp_firstname,' ',e.emp_middlename,' ',e.emp_lastname), date_un, nature_un, time, reason, u.status
								FROM ems_undertime as u
								INNER JOIN ems_employee as e ON e.emp_num = u.emp_num
								INNER JOIN ems_users AS us ON e.emp_num = us.emp_num
								LEFT JOIN ems_business_units b ON b.dept_code = e.dept_code
								WHERE (b.b_manager_name='$bman' OR (e.dept_code IN($qoic) AND rights!=2) OR (e.dept_code IN ($report) AND rights=2))
								AND u.emp_num!='$empnum' AND u.emp_num!='$_SESSSION[emp_num]'
								ORDER BY un_id DESC";
				$res = mysql_query($getExcel);
				
				/** Error reporting */
				error_reporting(E_ALL);
				date_default_timezone_set('Asia/Manila');

				/** PHPExcel */
				require_once 'Classes/PHPExcel.php';

				$objPHPExcel = new PHPExcel();
				
				$row = 4;
				while($mrow = mysql_fetch_assoc($res)) {
					set_time_limit(0);
					$col = 0;
					foreach($mrow as $key=>$value) {
						$sheet = $objPHPExcel->getActiveSheet();

					//Styling the Worksheet
					//Sets the title of the worksheet
						$sheet->setTitle("iRipple Undertime Applications");
						$objPHPExcel->getProperties()->setCreator($_SESSION['fullname']); //Name of the file creator

					//Merge certain cells and add value to it
						$sheet->mergeCells("A1:B1");
						$sheet->mergeCells("C1:D1");			
						$sheet->setCellValue("A1", "iRipple Undertime Applications");
						$sheet->setCellValue("C1", "Prepared by: ".$_SESSION['fullname']); //show file creator inside the file				

					//Set Cell Values - Act as headers for each fields of the table
						$sheet->setCellValue('A3', 'Date Filed');
						$sheet->setCellValue('B3', 'Employee Name');
						$sheet->setCellValue('C3', 'Date of Undertime');
						$sheet->setCellValue('D3', 'Nature');
						$sheet->setCellValue('E3', 'Departure');
						$sheet->setCellValue('F3', 'Reason');
						$sheet->setCellValue('G3', 'Status');

					//Defines the width of the cells in Excel
						$sheet->setCellValueByColumnAndRow($col, $row, $value);
						$sheet->getColumnDimension("A")->setWidth(15); 
						$sheet->getColumnDimension("B")->setWidth(40); 
						$sheet->getColumnDimension("C")->setWidth(30); 
						$sheet->getColumnDimension("D")->setWidth(20); 
						$sheet->getColumnDimension("E")->setWidth(15); 
						$sheet->getColumnDimension("F")->setWidth(40); 
						$sheet->getColumnDimension("G")->setWidth(20);

					//Defines the alignment and font-weight of specific cells
						$sheet->getStyle("A")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
						$sheet->getStyle("G")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
						$sheet->getStyle("A3:G3")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
						$sheet->getStyle("A3:G3")->applyFromArray(array("font" => array( "bold" => true)));
						$col++; 
					} 
					$row++; 
				} 

				// Set active sheet index to the first sheet, so Excel opens this as the first sheet
				$objPHPExcel->setActiveSheetIndex(0);

				$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
				$objWriter->save('documents/emsManager-undertimeApplications.xls'); //saves the file first
				//JD-2012/11/12 - Make message into a popup
				//JD-2012/11/23 - Changed from pop-up message to download box
				$file = 'documents/emsManager-undertimeApplications.xls'; //locates the file to be downloaded
				
				//CREATE/OUTPUT THE HEADER
				header("Content-type: application/force-download");
				header("Content-Transfer-Encoding: Binary");
				header("Content-length: ".filesize($file));
				header("Content-disposition: attachment; filename=\"".basename($file)."\"");
				readfile($file);
				echo '<script>window.location.href="view_leave_undr.php";</script>'; //return to previous page
			break;
			//END of UNDERTIME ---------------------------------------------------------------------------------------------------------------------------

			//START of EIM -------------------------------------------------------------------------------------------------------------------------------
			case 'export_infoBtn':
				
				$report = stripslashes($report);
				$qoic = stripslashes($qoic);
				
				mysql_query("set names 'utf8'"); //JD-2012/12/03 - Added to fix character encoding mismatch between mysql and excel
				//				- Replaced dept_code='$depcode' with b.b_manager_name='$bman'
				//JD-2014/03/18 - Replaced b.b_id=e.b_id with b.dept_code = e.dept_code
				$getExcel = "SELECT e.emp_num, CONCAT(e.emp_firstname,' ',e.emp_middlename,' ',e.emp_lastname), j.job_title_name, s.name,
								d.dept_name, b.b_manager_name, e.date_employ, e.date_sep, CONCAT(e.address1,', ',e.city), e.mobile, 
								e.email, e.birthdate, e.sss, e.tin, e.pag_ibig, e.phil_health
								FROM ems_employee AS e 
								LEFT JOIN ems_jobtitle AS j ON e.job_title_code = j.job_title_code
								LEFT JOIN ems_emp_status AS s ON e.code = s.code
								LEFT JOIN ems_department AS d ON e.dept_code = d.dept_code
								LEFT JOIN ems_business_units AS b ON b.dept_code = e.dept_code
								LEFT JOIN ems_users AS u ON u.emp_num = e.emp_num 
								WHERE (b.b_manager_name='$bman' OR (e.dept_code IN ($qoic) AND rights!=2) OR (e.dept_code IN ($report) AND rights=2))
								AND e.emp_num!=1 ORDER BY e.emp_num ASC";

				$res = mysql_query($getExcel);
				//echo $getExcel; //2012-12-03 - Removed. Prevents manager export to function
				
				/** Error reporting */
				error_reporting(E_ALL);
				date_default_timezone_set('Asia/Manila');

				/** PHPExcel */
				require_once 'Classes/PHPExcel.php';

				// Create new PHPExcel object
				//echo date('H:i:s') . " Create new PHPExcel object\n";
				$objPHPExcel = new PHPExcel();

				$row = 4;
				while($mrow = mysql_fetch_assoc($res)) {
					set_time_limit(0);
					$col = 0;
					foreach($mrow as $key=>$value) {
						$sheet = $objPHPExcel->getActiveSheet();
						
					//Sets the title of the worksheet
						$sheet->setTitle("iRipple Employee List");
						$objPHPExcel->getProperties()->setCreator($_SESSION['fullname']); //Name of the file creator
			
					//Merge certain cells and add value to it
						$sheet->mergeCells("A1:B1");
						$sheet->mergeCells("C1:D1");			
						$sheet->setCellValue("A1", "iRipple Employee List");
						$sheet->setCellValue("C1", "Prepared by: ".$_SESSION['fullname']); //show the file creator inside the file
			
					//Set Cell Values - Act as headers for each fields of the table
						$sheet->setCellValue('A3', 'Employee Number');
						$sheet->setCellValue('B3', 'Employee Name');
						$sheet->setCellValue('C3', 'Job Title');
						$sheet->setCellValue('D3', 'Employment Status');
						$sheet->setCellValue('E3', 'Department');
						$sheet->setCellValue('F3', 'Manager');
						$sheet->setCellValue('G3', 'Date of Employment');
						//$sheet->setCellValue('H3', 'Date of Resignation');
						$sheet->setCellValue('H3', 'Date of Separation');
						//$sheet->setCellValue('I3', 'Gender');
						$sheet->setCellValue('I3', 'Address');
						$sheet->setCellValue('J3', 'Mobile Number');
						//$sheet->setCellValue('L3', 'Work Number');
						$sheet->setCellValue('K3', 'Email Address');
						$sheet->setCellValue('L3', 'Birthdate');
						$sheet->setCellValue('M3', 'SSS Number');
						$sheet->setCellValue('N3', 'TIN Number');
						$sheet->setCellValue('O3', 'Pag-Ibig');
						$sheet->setCellValue('P3', 'Phil-Health');
			
					//Defines the width of the cells in Excel
						$sheet->setCellValueByColumnAndRow($col, $row, $value); 
						$sheet->getColumnDimension("A")->setWidth(20); 
						$sheet->getColumnDimension("B")->setWidth(40); 
						$sheet->getColumnDimension("C")->setWidth(40); 
						$sheet->getColumnDimension("D")->setWidth(20); 
						$sheet->getColumnDimension("E")->setWidth(30); 
						$sheet->getColumnDimension("F")->setWidth(40); 
						$sheet->getColumnDimension("G")->setWidth(25); 
						//$sheet->getColumnDimension("H")->setWidth(30); 
						$sheet->getColumnDimension("H")->setWidth(25); 
						//$sheet->getColumnDimension("I")->setWidth(15);  
						$sheet->getColumnDimension("I")->setWidth(50);  
						$sheet->getColumnDimension("J")->setWidth(20);  
						//$sheet->getColumnDimension("L")->setWidth(30);  
						$sheet->getColumnDimension("K")->setWidth(30);  
						$sheet->getColumnDimension("L")->setWidth(15);  
						$sheet->getColumnDimension("M")->setWidth(20);  
						$sheet->getColumnDimension("N")->setWidth(20);  
						$sheet->getColumnDimension("O")->setWidth(20);  
						$sheet->getColumnDimension("P")->setWidth(20);
			
					//Defines the alignment and font-weight of specific cells
					//First Line sets Text wrapping
						$sheet->getStyle("I".$sheet->getHighestRow())->getAlignment()->setWrapText(true); 
						$sheet->getStyle("A")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
						$sheet->getStyle("A3:P3")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
						$sheet->getStyle("A3:P3")->applyFromArray(array("font" => array( "bold" => true)));
						$col++; 
					} 
					$row++; 
				} 

				// Set active sheet index to the first sheet, so Excel opens this as the first sheet
				$objPHPExcel->setActiveSheetIndex(0);

				$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
				$objWriter->setPreCalculateFormulas(FALSE);
				$objWriter->save('documents/emsManager-employeeList.xls'); //saves the file first
				//JD-2012/11/12 - Make message into a popup
				//JD-2012/11/23 - Changed from pop-up message to download box
				$file = 'documents/emsManager-employeeList.xls'; //locates the file to be downloaded
				
				//CREATE/OUTPUT THE HEADER
				header("Content-type: application/force-download; charset=UTF-8");
				header("Content-Transfer-Encoding: Binary");
				header("Content-length: ".filesize($file));
				header("Content-disposition: attachment; filename=\"".basename($file)."\"");
				readfile($file);
				echo '<script>window.location.href="emp_info.php";</script>'; //return to previous page
			break;
			//END of EIM -------------------------------------------------------------------------------------------------------------------------------
			
			//START of OVERTIME ------------------------------------------------------------------------------------------------------------------------
			case 'export_overtimeBtn':
				
				$report = stripslashes($report);
				$qoic = stripslashes($qoic);
				
				mysql_query("set names 'utf8'"); //JD-2012/12/03 - Added to fix character encoding mismatch between mysql and excel
				//JD-2013/05/22 - Added table ems_business_units to get manager name in one or more department
				//				- Replaced dept_code='$depcode' with b.b_manager_name='$bman'
				//JD-2014/03/18 - Replaced b.b_id=e.b_id with b.dept_code = e.dept_code
				$getExcel = "SELECT ot.date_filed, ot.date_ot, CONCAT(e.emp_firstname,' ',e.emp_middlename,' ',e.emp_lastname), ot.no_of_hours,
								ot.expected_output, ot.status
								FROM ems_ot as ot 
								INNER JOIN ems_accomplishments as a ON ot.ot_id = a.ot_id 
								INNER JOIN ems_employee as e ON e.emp_num = ot.emp_num 
								INNER JOIN ems_users AS us ON e.emp_num = us.emp_num
								LEFT JOIN ems_business_units AS b ON b.dept_code = e.dept_code
								WHERE (b.b_manager_name='$bman' OR (e.dept_code IN ($qoic) AND rights!=2) OR (e.dept_code IN ($report) AND rights=2))
								AND ot.emp_num!='$empnum' and ot.emp_num!='$_SESSION[emp_num]'
								ORDER BY ot.ot_id DESC";
				
				$res = mysql_query($getExcel);

				error_reporting(E_ALL);
				date_default_timezone_set('Asia/Manila');

				require_once 'Classes/PHPExcel.php';

				$objPHPExcel = new PHPExcel();
			
				$row = 4;
				while($mrow = mysql_fetch_assoc($res)) {
					set_time_limit(0);
					$col = 0;
					foreach($mrow as $key=>$value) {
						$sheet = $objPHPExcel->getActiveSheet();

					//Sets the title of the worksheet
						$sheet->setTitle("iRipple Overtime Applications");
						$objPHPExcel->getProperties()->setCreator($_SESSION['fullname']); //Name of the file creator
			
					//Merge certain cells and add value to it
						$sheet->mergeCells("A1:B1");
						$sheet->mergeCells("C1:D1");
						$sheet->setCellValue("A1", "iRipple Overtime Applications");
						$sheet->setCellValue("C1", "Prepared by: ".$_SESSION['fullname']); //show file creator inside the file			
			
					//Set Cell Values - Act as headers for each fields of the table
						$sheet->setCellValue('A3', 'Date Filed');
						$sheet->setCellValue('B3', 'Date of Overtime');
						$sheet->setCellValue('C3', 'Employee Name');
						$sheet->setCellValue('D3', 'No. of Hours');
						$sheet->setCellValue('E3', 'Expected Output');
						$sheet->setCellValue('F3', 'Overtime Status');
						//$sheet->setCellValue('H3', 'Accomplishment Status');
			
					//Defines the width of the cells in Excel
						$sheet->setCellValueByColumnAndRow($col, $row, $value); 
						$sheet->getColumnDimension("A")->setWidth(20); 
						$sheet->getColumnDimension("B")->setWidth(20); 
						$sheet->getColumnDimension("C")->setWidth(40); 
						$sheet->getColumnDimension("D")->setWidth(15); 
						$sheet->getColumnDimension("E")->setWidth(50); 
						$sheet->getColumnDimension("F")->setWidth(20); 
						//$sheet->getColumnDimension("H")->setWidth(30);
			
					//Defines the alignment and font-weight of specific cells
						$sheet->getStyle("E".$sheet->getHighestRow())->getAlignment()->setWrapText(true); 
						$sheet->getStyle("A")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
						$sheet->getStyle("D")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
						$sheet->getStyle("A3:F3")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
						$sheet->getStyle("A3:F3")->applyFromArray(array("font" => array( "bold" => true)));
						$col++; 
					} 
					$row++; 
				} 
			
				// Set active sheet index to the first sheet, so Excel opens this as the first sheet
				$objPHPExcel->setActiveSheetIndex(0);

				$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
				$objWriter -> save('documents/emsMan-otApplications.xls'); //saves the file first
				//JD-2012/11/12 - Make message into a popup
				//JD-2012/11/23 - Changed from pop-up message to download box
				$file = 'documents/emsMan-otApplications.xls'; //locates the file to be downloaded
				
				//CREATE/OUTPUT THE HEADER
				@header("Content-type: application/force-download");
				@header("Content-Transfer-Encoding: Binary");
				@header("Content-length: ".filesize($file));
				@header("Content-disposition: attachment; filename=\"".basename($file)."\"");
				readfile($file);
				/*echo '<script>window.location.href="view_ot_accomplishment.php?searchby=0&search=&submit=search";</script>'; //return to previous page*/
			break;
			//END of OVERTIME ----------------------------------------------------------------------------------------------------------------------------
			
			//START of OFFSET ----------------------------------------------------------------------------------------------------------------------------
			case 'export_offsetBtn':
				
				$report = stripslashes($report);
				$qoic = stripslashes($qoic);
				
				mysql_query("set names 'utf8'"); //JD-2012/12/03 - Added to fix character encoding mismatch between mysql and excel
				//JD-2013/05/22 - Added table ems_business_units to get manager name in one or more department
				//				- Replaced dept_code='$depcode' with b.b_manager_name='$bman'
				//JD-2014/03/18 - Replaced b.b_id=e.b_id with b.dept_code = e.dept_code
				$getExcel = "SELECT o.date_Filed, CONCAT(e.emp_firstname,' ',e.emp_middlename,' ',e.emp_lastname), o.date_ot, o.ot_hours, 
								accomplishment, o.date_offset, o.status
								FROM ems_offset as o
								INNER JOIN ems_employee as e ON o.emp_num  = e.emp_num
								INNER JOIN ems_users AS us ON e.emp_num = us.emp_num
								LEFT JOIN ems_business_units AS b ON b.dept_code = e.dept_code
								WHERE (b.b_manager_name='$bman' OR (e.dept_code IN($qoic) AND rights!=2) OR (e.dept_code IN ($report) AND rights=2)) 
								AND o.emp_num!='$empnum' and o.emp_num!='$_SESSION[emp_num]'
								ORDER BY o.offset_id DESC";
			
				$res = mysql_query($getExcel);

				error_reporting(E_ALL);
				date_default_timezone_set('Asia/Manila');

				require_once 'Classes/PHPExcel.php';

				$objPHPExcel = new PHPExcel();
			
				$row = 4;
				while($mrow = mysql_fetch_assoc($res)) {
					set_time_limit(0);
					$col = 0;
					foreach($mrow as $key=>$value) {
						$sheet = $objPHPExcel->getActiveSheet();

					//Sets the title of the worksheet
						$sheet->setTitle("iRipple Offset Applications");
						$objPHPExcel->getProperties()->setCreator($_SESSION['fullname']); //Name of the file creator
			
					//Merge certain cells and add value to it
						$sheet->mergeCells("A1:B1");
						$sheet->mergeCells("C1:D1");			
						$sheet->setCellValue("A1", "iRipple Offset Applications");
						$sheet->setCellValue("C1", "Prepared by: ".$_SESSION['fullname']); //show file creator inside the file				
			
					//Set Cell Values - Act as headers for each fields of the table
						$sheet->setCellValue('A3', 'Date Filed');
						$sheet->setCellValue('B3', 'Employee Name');
						$sheet->setCellValue('C3', 'Overtime Date');
						$sheet->setCellValue('D3', 'No. of Hours');
						$sheet->setCellValue('E3', 'Accomplishment');
						$sheet->setCellValue('F3', 'Offset Date');
						$sheet->setCellValue('G3', 'Offset Status');
			
					//Defines the width of the cells in Excel
						$sheet->setCellValueByColumnAndRow($col, $row, $value); 
						$sheet->getColumnDimension("A")->setWidth(15); 
						$sheet->getColumnDimension("B")->setWidth(40); 
						$sheet->getColumnDimension("C")->setWidth(15); 
						$sheet->getColumnDimension("D")->setWidth(15); 
						$sheet->getColumnDimension("E")->setWidth(50); 
						$sheet->getColumnDimension("F")->setWidth(15); 
						$sheet->getColumnDimension("G")->setWidth(15);
			
					//Defines the alignment and font-weight of specific cells
						$sheet->getStyle("E".$sheet->getHighestRow())->getAlignment()->setWrapText(true);
						$sheet->getStyle("A")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
						$sheet->getStyle("G")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
						$sheet->getStyle("A3:G3")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
						$sheet->getStyle("A3:G3")->applyFromArray(array("font" => array( "bold" => true)));
						$col++; 
					} 
					$row++; 
				} 
			
				// Set active sheet index to the first sheet, so Excel opens this as the first sheet
				$objPHPExcel->setActiveSheetIndex(0);

				$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
				$objWriter->save('documents/emsManager-offsetApplications.xls'); //saves the file first
				//JD-2012/11/12 - Make message into a popup
				//JD-2012/11/23 - Changed from pop-up message to download box
				$file = 'documents/emsManager-offsetApplications.xls'; //locates the file to be downloaded
				
				//CREATE/OUTPUT THE HEADER
				header("Content-type: application/force-download");
				header("Content-Transfer-Encoding: Binary");
				header("Content-length: ".filesize($file));
				header("Content-disposition: attachment; filename=\"".basename($file)."\"");
				readfile($file);
				echo '<script>window.location.href="view_offset_request.php?searchby=0&search=&submit=search";</script>'; //return to previous page
			break;
			//END of OFFSET ----------------------------------------------------------------------------------------------------------------------------

			//START of OFFICIAL BUSINESS -----------------------------------------------------------------------------------------------------------------
			case 'export_officialBtn':
				
				$report = stripslashes($report);
				$qoic = stripslashes($qoic);
				
				mysql_query("set names 'utf8'"); //JD-2012/12/03 - Added to fix character encoding mismatch between mysql and excel
				//JD-2013/05/22 - Added table ems_business_units to get manager name in one or more department
				//				- Replaced dept_code='$depcode' with b.b_manager_name='$bman'
				//JD-2014/03/18 - Replaced b.b_id=e.b_id with b.dept_code = e.dept_code
				$getExcel = "SELECT date_Filed, CONCAT(e.emp_firstname,' ',e.emp_middlename,' ',e.emp_lastname), client_branch, purpose,
								ob_from, ob_to, departure, arrival, total, o.status
								FROM ems_ob AS o
								INNER JOIN ems_employee AS e ON e.emp_num = o.emp_num
								INNER JOIN ems_users AS us ON e.emp_num = us.emp_num
								LEFT JOIN ems_business_units AS b ON b.dept_code = e.dept_code
								WHERE (b.b_manager_name='$bman' OR (e.dept_code IN($qoic) AND rights!=2) OR (e.dept_code IN ($report) AND rights=2)) 
								AND o.emp_num!='$empnum' AND o.emp_num!='$_SESSION[emp_num]'
								ORDER BY o.ob_id DESC";
			
				$res = mysql_query($getExcel);
				
				error_reporting(E_ALL);
				date_default_timezone_set('Asia/Manila');

				require_once 'Classes/PHPExcel.php';

				$objPHPExcel = new PHPExcel();
			
				$row = 4;
				while($mrow = mysql_fetch_assoc($res)) {
					set_time_limit(0);
					$col = 0;
					foreach($mrow as $key=>$value) {
						$sheet = $objPHPExcel->getActiveSheet();

					//Sets the title of the worksheet
						$sheet->setTitle("iRipple OB Applications");
						$objPHPExcel->getProperties()->setCreator($_SESSION['fullname']); //Name of the file creator
			
					//Merge certain cells and add value to it
						$sheet->mergeCells("A1:B1");
						$sheet->mergeCells("C1:D1");			
						$sheet->setCellValue("A1", "iRipple OB Applications");
						$sheet->setCellValue("C1", "Prepared by: ".$_SESSION['fullname']); //show file creator inside the file				
			
					//Set Cell Values - Act as headers for each fields of the table
						$sheet->setCellValue('A3', 'Date Filed');
						$sheet->setCellValue('B3', 'Employee Name');
						$sheet->setCellValue('C3', 'Client Name');
						$sheet->setCellValue('D3', 'Purpose');
						$sheet->setCellValue('E3', 'From');
						$sheet->setCellValue('F3', 'To');
						$sheet->setCellValue('G3', 'Departure');
						$sheet->setCellValue('H3', 'Arrival');
						$sheet->setCellValue('I3', 'Total Hours');
						$sheet->setCellValue('J3', 'Status');
			
					//Defines the width of the cells in Excel
						$sheet->setCellValueByColumnAndRow($col, $row, $value); 
						$sheet->getColumnDimension("A")->setWidth(20); 
						$sheet->getColumnDimension("B")->setWidth(40); 
						$sheet->getColumnDimension("C")->setWidth(40); 
						$sheet->getColumnDimension("D")->setWidth(50); 
						$sheet->getColumnDimension("E")->setWidth(15); 
						$sheet->getColumnDimension("F")->setWidth(15); 
						$sheet->getColumnDimension("G")->setWidth(15); 
						$sheet->getColumnDimension("H")->setWidth(15); 
						$sheet->getColumnDimension("I")->setWidth(15); 
						$sheet->getColumnDimension("J")->setWidth(15);
			
					//First Line sets the wrap text to a column
						$sheet->getStyle("D".$sheet->getHighestRow())->getAlignment()->setWrapText(true); 
						$sheet->getStyle("A")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
						$sheet->getStyle("J")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
						$sheet->getStyle("A3:J3")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
						$sheet->getStyle("A3:J3")->applyFromArray(array("font" => array( "bold" => true)));
						$col++; 
					} 
					$row++; 
				} 
			
				// Set active sheet index to the first sheet, so Excel opens this as the first sheet
				$objPHPExcel->setActiveSheetIndex(0);

				$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
				$objWriter->save('documents/emsManager-obApplications.xls'); //saves the file first
				//JD-2012/11/12 - Make message into a popup
				//JD-2012/11/23 - Changed from pop-up message to download box
				$file = 'documents/emsManager-obApplications.xls'; //locates the file to be downloaded
				
				//CREATE/OUTPUT THE HEADER
				header("Content-type: application/force-download");
				header("Content-Transfer-Encoding: Binary");
				header("Content-length: ".filesize($file));
				header("Content-disposition: attachment; filename=\"".basename($file)."\"");
				readfile($file);
				echo '<script>window.location.href="view_ob_request.php?searchby=0&search=&submit=search";</script>'; //return to previous page
			break;
			//END of OFFICIAL BUSINESS -------------------------------------------------------------------------------------------------------------------
			
			//START of RESERVATION -----------------------------------------------------------------------------------------------------------------------
			case 'export_reserveBtn':
				
				$report = stripslashes($report);
				$qoic = stripslashes($qoic);
				
				mysql_query("set names 'utf8'"); //JD-2012/12/03 - Added to fix character encoding mismatch between mysql and excel
				//JD-2013/05/22 - Added table ems_business_units to get manager name in one or more department
				//				- Replaced dept_code='$depcode' with b.b_manager_name='$bman'
				//JD-2014/03/18 - Replaced b.b_id=e.b_id with b.dept_code = e.dept_code
				$getExcel = "SELECT r.date_Filed, CONCAT(e.emp_firstname,' ',e.emp_middlename,' ',e.emp_lastname), subject_purpose, client_branch, 
								date_from, date_to, no_of_days, equip_list, r.status
								FROM ems_equip_requests as r 
								INNER JOIN ems_employee as e ON r.emp_num  = e.emp_num
								INNER JOIN ems_users AS us ON e.emp_num = us.emp_num
								LEFT JOIN ems_business_units AS b ON b.dept_code = e.dept_code
								WHERE (b.b_manager_name='$bman' OR (e.dept_code IN($qoic) AND rights!=2) OR (e.dept_code IN ($report) AND rights=2)) 
								AND r.emp_num!='$empnum' AND r.emp_num!='$_SESSION[emp_num]'
								ORDER BY r.erqst_id DESC";
			
				$res = mysql_query($getExcel);

				error_reporting(E_ALL);
				date_default_timezone_set('Asia/Manila');

				require_once 'Classes/PHPExcel.php';

				$objPHPExcel = new PHPExcel();
			
				$row = 4;
				while($mrow = mysql_fetch_assoc($res)) {
					set_time_limit(0);
					$col = 0;
					foreach($mrow as $key=>$value) {
						$sheet = $objPHPExcel->getActiveSheet();

					//Sets the title of the worksheet
						$sheet->setTitle("iRipple Equipment Reservation");
						$objPHPExcel->getProperties()->setCreator($_SESSION['fullname']); //Name of the file creator
			
					//Merge certain cells and add value to it
						$sheet->mergeCells("A1:B1");
						$sheet->mergeCells("C1:D1");			
						$sheet->setCellValue("A1", "iRipple Equipment Reservation");
						$sheet->setCellValue("C1", "Prepared by: ".$_SESSION['fullname']); //show file creator inside the file				
			
					//Set Cell Values - Act as headers for each fields of the table
						$sheet->setCellValue('A3', 'Date Filed');
						$sheet->setCellValue('B3', 'Employee Name');
						$sheet->setCellValue('C3', 'Purpose');
						$sheet->setCellValue('D3', 'Client/Branch');
						$sheet->setCellValue('E3', 'From');
						$sheet->setCellValue('F3', 'To');
						$sheet->setCellValue('G3', 'No. of Days');
						$sheet->setCellValue('H3', 'Equipment List');
						$sheet->setCellValue('I3', 'Status');
			
					//Defines the width of the cells in Excel
						$sheet->setCellValueByColumnAndRow($col, $row, $value); 
						$sheet->getColumnDimension("A")->setWidth(15); 
						$sheet->getColumnDimension("B")->setWidth(40); 
						$sheet->getColumnDimension("C")->setWidth(40); 
						$sheet->getColumnDimension("D")->setWidth(40); 
						$sheet->getColumnDimension("E")->setWidth(15); 
						$sheet->getColumnDimension("F")->setWidth(15); 
						$sheet->getColumnDimension("G")->setWidth(15); 
						$sheet->getColumnDimension("H")->setWidth(40);
						$sheet->getColumnDimension("I")->setWidth(15);

					//First Line sets the wrap text to a column
						$sheet->getStyle("C".$sheet->getHighestRow())->getAlignment()->setWrapText(true); 
						$sheet->getStyle("H".$sheet->getHighestRow())->getAlignment()->setWrapText(true);
						$sheet->getStyle("A")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
						$sheet->getStyle("A3:I3")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
						$sheet->getStyle("A3:I3")->applyFromArray(array("font" => array( "bold" => true)));
						$col++; 
					} 
					$row++; 
				} 
			
				// Set active sheet index to the first sheet, so Excel opens this as the first sheet
				$objPHPExcel->setActiveSheetIndex(0);

				$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
				$objWriter->save('documents/emsManager-equipReservation.xls'); //saves the file first
				//JD-2012/11/12 - Make message into a popup
				//JD-2012/11/23 - Changed from pop-up message to download box
				$file = 'documents/emsManager-equipReservation.xls'; //locates the file to be downloaded
				
				//CREATE/OUTPUT THE HEADER
				header("Content-type: application/force-download");
				header("Content-Transfer-Encoding: Binary");
				header("Content-length: ".filesize($file));
				header("Content-disposition: attachment; filename=\"".basename($file)."\"");
				readfile($file);
				echo '<script>window.location.href="view_reservation.php?searchby=0&search=&submit=search";</script>'; //return to previous page
			break;
			//END of RESERVATION -------------------------------------------------------------------------------------------------------------------------

			//START of REQUISITION -----------------------------------------------------------------------------------------------------------------------
			case 'export_requisiteBtn':
				
				$report = stripslashes($report);
				$qoic = stripslashes($qoic);
				
				mysql_query("set names 'utf8'"); //JD-2012/12/03 - Added to fix character encoding mismatch between mysql and excel
				//JD-2013/05/22 - Added table ems_business_units to get manager name in one or more department
				//				- Replaced dept_code='$depcode' with b.b_manager_name='$bman'
				//JD-2014/03/18 - Replaced b.b_id=e.b_id with b.dept_code = e.dept_code
				$getExcel = "SELECT r.date_Filed, CONCAT(e.emp_firstname,' ',e.emp_middlename,' ',e.emp_lastname), r.date_needed, r.items, r.qty, 
								amount, r.purpose, r.status
								FROM ems_equip_requisitions as r
								INNER JOIN ems_employee as e ON r.emp_num  = e.emp_num
								INNER JOIN ems_users AS us ON e.emp_num = us.emp_num
								LEFT JOIN ems_business_units AS b ON b.dept_code = e.dept_code
								WHERE (b.b_manager_name='$bman' OR (e.dept_code IN($qoic) AND rights!=2) OR (e.dept_code IN ($report) AND rights=2)) 
								AND r.emp_num!='$empnum' AND r.emp_num!='$_SESSION[emp_num]'
								ORDER BY r.erqstn_id DESC";
			
				$res = mysql_query($getExcel);

				error_reporting(E_ALL);
				date_default_timezone_set('Asia/Manila');

				require_once 'Classes/PHPExcel.php';

				$objPHPExcel = new PHPExcel();
			
				$row = 4;
				while($mrow = mysql_fetch_assoc($res)) {
					set_time_limit(0);
					$col = 0;
					foreach($mrow as $key=>$value) {
						$sheet = $objPHPExcel->getActiveSheet();

					//Sets the title of the worksheet
						$sheet->setTitle("iRipple Equipment Requisition");
						$objPHPExcel->getProperties()->setCreator($_SESSION['fullname']); //Name of the file creator
			
					//Merge certain cells and add value to it
						$sheet->mergeCells("A1:B1");
						$sheet->mergeCells("C1:D1");			
						$sheet->setCellValue("A1", "iRipple Equipment Requisition");
						$sheet->setCellValue("C1", "Prepared by: ".$_SESSION['fullname']); //show file creator inside the file				
			
					//Set Cell Values - Act as headers for each fields of the table
						$sheet->setCellValue('A3', 'Date Filed');
						$sheet->setCellValue('B3', 'Employee Name');
						$sheet->setCellValue('C3', 'Date Needed');
						$sheet->setCellValue('D3', 'Items');
						$sheet->setCellValue('E3', 'Quantity');
						$sheet->setCellValue('F3', 'Amount');
						$sheet->setCellValue('G3', 'Purpose');
						$sheet->setCellValue('H3', 'Status');
			
					//Defines the width of the cells in Excel
						$sheet->setCellValueByColumnAndRow($col, $row, $value); 
						$sheet->getColumnDimension("A")->setWidth(15); 
						$sheet->getColumnDimension("B")->setWidth(40); 
						$sheet->getColumnDimension("C")->setWidth(20); 
						$sheet->getColumnDimension("D")->setWidth(40); 
						$sheet->getColumnDimension("E")->setWidth(30); 
						$sheet->getColumnDimension("F")->setWidth(30); 
						$sheet->getColumnDimension("G")->setWidth(40);
						$sheet->getColumnDimension("H")->setWidth(15);

					//First Line sets the wrap text to a column
						$sheet->getStyle("D".$sheet->getHighestRow())->getAlignment()->setWrapText(true); 
						$sheet->getStyle("E".$sheet->getHighestRow())->getAlignment()->setWrapText(true); 
						$sheet->getStyle("F".$sheet->getHighestRow())->getAlignment()->setWrapText(true); 
						$sheet->getStyle("G".$sheet->getHighestRow())->getAlignment()->setWrapText(true);
						$sheet->getStyle("A")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
						$sheet->getStyle("A3:H3")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
						$sheet->getStyle("A3:H3")->applyFromArray(array("font" => array( "bold" => true)));
						$col++; 
					} 
					$row++; 
				} 
			
				// Set active sheet index to the first sheet, so Excel opens this as the first sheet
				$objPHPExcel->setActiveSheetIndex(0);

				$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
				$objWriter->save('documents/emsManager-equipRequisition.xls'); //saves the file first
				//JD-2012/11/12 - Make message into a popup
				//JD-2012/11/23 - Changed from pop-up message to download box
				$file = 'documents/emsManager-equipRequisition.xls'; //locates the file to be downloaded
				
				//CREATE/OUTPUT THE HEADER
				header("Content-type: application/force-download");
				header("Content-Transfer-Encoding: Binary");
				header("Content-length: ".filesize($file));
				header("Content-disposition: attachment; filename=\"".basename($file)."\"");
				readfile($file);
				echo '<script>window.location.href="view_requisition.php?searchby=0&search=&submit=search";</script>'; //return to previous page
			break;
			//END of REQUISITION -------------------------------------------------------------------------------------------------------------------------

			//START of AIRTICKET -------------------------------------------------------------------------------------------------------------------------
			case 'export_airticketBtn':
				
				$report = stripslashes($report);
				$qoic = stripslashes($qoic);
				
				mysql_query("set names 'utf8'"); //JD-2012/12/03 - Added to fix character encoding mismatch between mysql and excel
				//JD-2013/05/22 - Added table ems_business_units to get manager name in one or more department
				//				- Replaced dept_code='$depcode' with b.b_manager_name='$bman'
				//JD-2014/03/18 - Replaced b.b_id=e.b_id with b.dept_code = e.dept_code
				$getExcel = "SELECT a.date_Filed, CONCAT(e.emp_firstname,' ',e.emp_middlename,' ',e.emp_lastname), client, origin, destination, purpose,
								departure, arrival, a.status, amount
								FROM ems_air_ticket as a
								INNER JOIN ems_employee as e ON a.emp_num  = e.emp_num
								INNER JOIN ems_users AS us ON e.emp_num = us.emp_num
								LEFT JOIN ems_business_units AS b ON b.dept_code = e.dept_code
								WHERE (b.b_manager_name='$bman' OR (e.dept_code IN($qoic) AND rights!=2) OR (e.dept_code IN ($report) AND rights=2)) 
								AND a.emp_num!='$empnum' AND a.emp_num!='$_SESSION[emp_num]'
								ORDER BY a.at_id DESC";
			
				$res = mysql_query($getExcel);

				error_reporting(E_ALL);
				date_default_timezone_set('Asia/Manila');

				require_once 'Classes/PHPExcel.php';

				$objPHPExcel = new PHPExcel();
			
				$row = 4;
				while($mrow = mysql_fetch_assoc($res)) {
					set_time_limit(0);
					$col = 0;
					foreach($mrow as $key=>$value) {
						$sheet = $objPHPExcel->getActiveSheet();

					//Sets the title of the worksheet
						$sheet->setTitle("iRipple Airticket Applications");
						$objPHPExcel->getProperties()->setCreator($_SESSION['fullname']); //Name of the file creator
			
					//Merge certain cells and add value to it
						$sheet->mergeCells("A1:B1");
						$sheet->mergeCells("C1:D1");			
						$sheet->setCellValue("A1", "iRipple Airticket Applications");
						$sheet->setCellValue("C1", "Prepared by: ".$_SESSION['fullname']); //show file creator inside the file				
			
					//Set Cell Values - Act as headers for each fields of the table
						$sheet->setCellValue('A3', 'Date Filed');
						$sheet->setCellValue('B3', 'Employee Name');
						$sheet->setCellValue('C3', 'Client');
						$sheet->setCellValue('D3', 'Origin');
						$sheet->setCellValue('E3', 'Destination');
						$sheet->setCellValue('F3', 'Purpose');
						$sheet->setCellValue('G3', 'Departure');
						$sheet->setCellValue('H3', 'Arrival');
						$sheet->setCellValue('I3', 'Status');
						$sheet->setCellValue('J3', 'Amount');
			
					//Defines the width of the cells in Excel
						$sheet->setCellValueByColumnAndRow($col, $row, $value); 
						$sheet->getColumnDimension("A")->setWidth(15); 
						$sheet->getColumnDimension("B")->setWidth(40); 
						$sheet->getColumnDimension("C")->setWidth(40); 
						$sheet->getColumnDimension("D")->setWidth(30); 
						$sheet->getColumnDimension("E")->setWidth(30); 
						$sheet->getColumnDimension("F")->setWidth(40); 
						$sheet->getColumnDimension("G")->setWidth(25); 
						$sheet->getColumnDimension("H")->setWidth(25); 
						$sheet->getColumnDimension("I")->setWidth(15); 
						$sheet->getColumnDimension("J")->setWidth(20);

					//First Line sets the wrap text to a column
						$sheet->getStyle("C".$sheet->getHighestRow())->getAlignment()->setWrapText(true);
						$sheet->getStyle("D".$sheet->getHighestRow())->getAlignment()->setWrapText(true);
						$sheet->getStyle("E".$sheet->getHighestRow())->getAlignment()->setWrapText(true);
						$sheet->getStyle("F".$sheet->getHighestRow())->getAlignment()->setWrapText(true);
						$sheet->getStyle("G".$sheet->getHighestRow())->getAlignment()->setWrapText(true);
						$sheet->getStyle("H".$sheet->getHighestRow())->getAlignment()->setWrapText(true);
						$sheet->getStyle("A")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
						$sheet->getStyle("A3:J3")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
						$sheet->getStyle("A3:J3")->applyFromArray(array("font" => array( "bold" => true)));
						$col++; 
					} 
					$row++; 
				} 
			
				// Set active sheet index to the first sheet, so Excel opens this as the first sheet
				$objPHPExcel->setActiveSheetIndex(0);

				$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
				$objWriter->save('documents/emsManager-airticketRqsts.xls'); //saves the file first
				//JD-2012/11/12 - Make message into a popup
				//JD-2012/11/23 - Changed from pop-up message to download box
				$file = 'documents/emsManager-airticketRqsts.xls'; //locates the file to be downloaded
				
				//CREATE/OUTPUT THE HEADER
				header("Content-type: application/force-download");
				header("Content-Transfer-Encoding: Binary");
				header("Content-length: ".filesize($file));
				header("Content-disposition: attachment; filename=\"".basename($file)."\"");
				readfile($file);
				echo '<script>window.location.href="view_airticket_request.php?searchby=0&search=&submit=search";</script>'; //return to previous page
			break;
			//END of AIRTICKET ---------------------------------------------------------------------------------------------------------------------------
		}
	}
?>