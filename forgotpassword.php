<?php
	error_reporting(E_ALL);
	error_reporting(E_STRICT);
	date_default_timezone_set('Asia/Taipei');
	include("phpmailer/class.phpmailer.php");
	include("phpmailer/class.smtp.php"); // optional, gets called from within class.phpmailer.php if not already loaded
	include_once("conf/email.conf");
	include("password.inc.php");
	$strconn = mysql_connect("localhost","root", "");
	$dbconn = mysql_select_db ("ems", $strconn);
	global $msg;

	if($_POST["bttnSubmit"] == "Reset Password"){	
		$qry1 = "SELECT e.emp_firstname, e.emp_lastname, e.email, u.emp_num FROM ems_employee e inner join ems_users u on e.emp_num = u.emp_num where ucase(u.username) = ucase('".$_POST['txtUsername']."')";
		// echo $qry1;
		$qryresult1 = mysql_query($qry1,$strconn) or die("Error: " . mysql_error());
		$row1 = mysql_fetch_array($qryresult1);
		$rec_count = mysql_num_rows($qryresult1);
		if($rec_count > 0){
			$password = generatePassword(3);
			$fname = $row1['emp_firstname'];	
			$lname = $row1['emp_lastname'];	
			$email = $row1['email'];	
			$emp_num = $row1['emp_num'];
			$mail = new PHPMailer();
			$mail->IsSMTP();
			$mail->SMTPAuth   = true;                  // enable SMTP authentication
			$mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
			$mail->Host       = GMAIL_SMTP_SERVER;      // sets GMAIL as the SMTP server
			$mail->Port       = GMAIL_SMTP_PORT;                   // set the SMTP port for the GMAIL server
			
			$mail->Username   = GMAIL_USERNAME;  // GMAIL username
			$mail->Password   = GMAIL_PASSWORD;            // GMAIL password
			
			$mail->AddReplyTo(GMAIL_USERNAME, GMAIL_SUPPORT_NAME);
			
			$mail->From       = GMAIL_USERNAME;
			$mail->FromName   = GMAIL_SUPPORT_NAME;
			$mail->Subject    = "iEMS: Forgot Password"; //"PHPMailer Test Subject via gmail";
			$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
			$mail->WordWrap   = 50; // set word wrap
			$body 		= "<p>A request was made to send you your email and password for iRipple Employee Management System. Your details are as follows:<br><br>"
						."Username: ".$_POST['txtUsername']."<br>"
						."Password: $password <br><br>"
						."This password is a temporary password. If you log in using this new temporary password then your old password will be replaced by the new one.<br><br>"
						."Regards,<br>iEMS Administrator<br><hr></p>";
			$mail->MsgHTML($body);
			$recipientName = $fname.' '.$lname;
			
			$mail->AddAddress($email,$recipientName);
			$mail->IsHTML(true); // send as HTML
			$mail->ErrorInfo;
			if(!$mail->Send()) {
				$msg = "Mailer Error: " . $mail->ErrorInfo;
			} else {
				$qryStatus = "UPDATE ems_users SET password = md5('$password') WHERE emp_num = $emp_num";
// echo $qryStatus;
				$qryStatusRes = mysql_query($qryStatus,$strconn) or die("Error: ". mysql_error());
				if(!$qryStatusRes){
					$msg = mysql_error();
				}else{
					$msg =  "Successfully reset your password, please check your registered email. <br>Click <a href='index.php'>here</a> to login.";
				}
				/*$qryStatus = "";
				$qryStatusRes = mysql_query($qryStatus,$strconn) or die("Error: ". mysql_error());
				if(!$qryStatusRes){
					$msg = mysql_error();
				}*/
			}
		}else{
			$msg = "Invalid Username.";
		}
// echo $msg;
	}
	
?>
<html>
<head>
<title>iRipple Employee Management System - Forgot Password</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="style.css" rel="stylesheet" type="text/css" />
</head>
<body bgcolor="#FFFFFF" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<!-- ImageReady Slices (source.psd) -->
<div align="center">
<table id="Table_01" width="780" border="0" cellpadding="0" cellspacing="0" align="center">
	<tr>
		<td width="780px" class="mainText" height="78px">
			<img src="images/index_01.gif" border="0" width="780" height="78" alt="rippleLogo" usemap="#rippleLogo" align="ABSBOTTOM">
			<map name="rippleLogo">
				<area shape="poly" coords="0,0,610,0,430,39,300,61,168,75,95,73,30,62,0,55" href="index.php" alt="Rippple Logo"/>
			</map>			
		</td>
	</tr>
	<tr>
		<td background="images/index_02.gif" width="780" height="27" valign="top" cellpadding="0" cellspacing="0">
		<div id="central"> 
          <ul id="navlist">
            <li><a id="n1" href="main.php">&nbsp;&nbsp;&nbsp;My Work&nbsp;&nbsp;&nbsp;</a></li>
            <li><a id="n2" href="incident.php">&nbsp;&nbsp;&nbsp;Issue Log&nbsp;&nbsp;&nbsp;&nbsp;</a></li>
            <li><a id="n3" href="#">My Schedules</a></li>
            <li><a id="n4" href="#">&nbsp;&nbsp;Documents&nbsp;&nbsp;</a></li>
            <li><a id="n5" href="#">&nbsp;&nbsp;Activities&nbsp;&nbsp;&nbsp;&nbsp;</a></li>
            <!-- TL-09/18/2009 Reports.php link -->
            <li><a id="n6" href="reports.php">&nbsp;&nbsp;&nbsp;&nbsp;Reports&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></li>
            <!-- TL-09/10/2009 - Settings.php link -->
            <li><a id="n7" href="settings.php">&nbsp;&nbsp;Settings&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></li>
          </ul>
        </div>
		</td>
	</tr>
	<tr>
		
      <td background="images/index_03.gif" width="780" height="420" valign="top" align="center">
	  <table width="95%" >
			<tr><td colspan="3" align="right"></td></tr>
			<tr>
				<td rowspan="2" valign="top" height="900px" style="padding-top:0px;">
					<table id="tbl_right1" width="720" border="0" cellpadding="0" cellspacing="0">
						<tr>
							<td background="images/border_01.gif" width="13" height="20"></td>
							<td background="images/border_02.gif" width="450" height="20"></td>
							<td background="images/border_03.gif" width="16" height="20"></td>
						</tr>
						<tr>
							<td background="images/border_04.gif" width="13" height="5"></td>
							<td background="images/border_05.gif" width="750" height="5" valign="top">
								<table width="100%">
									<tr>
			                        <td class="title_header3" height="20px">Forgot Password....</td>
	        		              </tr>
							<tr>
								<td class="txtcontent" height="460px" valign="top">
								<form name="frmForgotPassword" action="forgotpassword.php" method="post">
								<table>
									<tr>
										<td class="mainText" colspan="2">Enter your EMS user to reset your password.</td>
									</tr>
									<tr>
										<td class="mainText" width="100" align="right">Username:</td><td><input type="text" name="txtUsername" value="" class="mainText">
										</td>
									</tr>
									<tr>
										<td colspan="2" align="center"><br>
										<div class="buttonwrapper">
										<a class="ovalbutton" href="javascript:document.getElementById('bttnSubmit').click();"><span>Reset Password</span></a>
										</div> 
										<input type="submit" id="bttnSubmit" name="bttnSubmit" value="Reset Password"></td>
									</tr>
									<tr>
										<td colspan="2" class="mainTextErr"><?php echo $msg; ?></td>
									</tr>
								</table>
								</form>
								</td></tr>
						  </table>							
							</td>
							<td background="images/border_06.gif" width="16" height="5"></td>
						</tr>
						<tr>
							<td background="images/border_10.gif" width="13" height="13"></td>
							<td background="images/border_11.gif" width="410" height="13"></td>
							<td background="images/border_12.gif" width="16" height="13"></td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
	  </td>
	</tr>
	<tr>
		<td background="images/index_05.gif" width="780" height="61" alt=""></td>
	</tr>
</table>
</div>
 <script>document.getElementById('bttnSubmit').style.display="none";</script>
<!-- End ImageReady Slices -->
</body>
</html>
