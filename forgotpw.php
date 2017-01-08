<?php
session_start();
ini_set('session.bug_compat_42',0);
ini_set('session.bug_compat_warn',0);

include("config_DB.php");

// function check_username($user){
	// $qry = mysql_query("SELECT username FROM ems_users");
	// while($data = mysql_fetch_array($qry)){
		// $usernames[] = $data[0];
	// }
		// if(in_array($user, $usernames)){
			// $msg = "Pasok";
		// }else{
			// $msg = "Invalid username!";
		// }
	// return $msg;
// }

	error_reporting(E_ALL);
	error_reporting(E_STRICT);
	date_default_timezone_set('Asia/Taipei');
	include_once("phpmailer/class.phpmailer.php");
	include_once("phpmailer/class.smtp.php"); // optional, gets called from within class.phpmailer.php if not already loaded
	include_once("conf/email.conf");
	include_once("password.inc.php");
	include_once("config_DB.php");
	global $msg;
	$display = "style='display:  none;'";
	$msg = "";
	
	if(isset($_POST['reset'])){
		$qry1 = "SELECT e.emp_firstname, e.emp_lastname, e.email, u.emp_num FROM ems_employee e inner join ems_users u on e.emp_num = u.emp_num where ucase(u.username) = ucase('".$_POST['username']."')";
		// echo $qry1;
		$qryresult1 = mysql_query($qry1,$conn) or die("Error: " . mysql_error());
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
			$body 		= "<p>Below is your new iRipple Employee Management System password.<br/><br/>"
						."Username: ".$_POST['username']."<br/>"
						."Password: $password <br/><br/>"
						."This is only a temporary password. Please change your password immediately upon login.<br/><br/>"
						."Regards,<br>iEMS Administrator<br/><hr/></p>";
			$mail->MsgHTML($body);
			$recipientName = $fname.' '.$lname;
			
			$mail->AddAddress($email,$recipientName);
			$mail->IsHTML(true); // send as HTML
			$mail->ErrorInfo;
			if(!$mail->Send()) {
				$msg = "Mailer Error: " . $mail->ErrorInfo;
			} else {
				$qryStatus = "UPDATE ems_users SET password = md5('$password') WHERE emp_num = $emp_num";
				$qryStatusRes = mysql_query($qryStatus,$conn) or die("Error: ". mysql_error());
				if(!$qryStatusRes){
					$msg = mysql_error();
				}else{
					$msg2 =  "Your new password has been sent to '$email'. <br/>Kindly check your email. Click <a href='index.php'>here</a> to login.";
					
				}
				/*$qryStatus = "";
				$qryStatusRes = mysql_query($qryStatus,$conn) or die("Error: ". mysql_error());
				if(!$qryStatusRes){
					$msg = mysql_error();
				}*/
			}
		}else{
			$msg = "Invalid username.";
		}
	}
	
	
// $usrname = trim($_POST['username']);
// if(isset($_POST['reset'])){
	// $err =  check_username($usrname);
// }

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<title>iEMS</title>

 <!-- Bootstrap core CSS -->
    <link href="dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="dist/css/non-responsive.css" rel="stylesheet">
   
<script type="text/javascript">
	
	function validate(){
		var user = document.getElementById('user').value;
			if(user==""){
				alert("Please enter your username.");
				return false;
			}
	}
	
	function hide(){
		document.getElementById('img').style.display = "none";
	}
	
</script>


</head>

<body onload="javascript:document.getElementById('user').focus(); hide();">
 
 <div class = "jumbotron">
 	<div class ="formPW">
	<form class ="formPW" action="<?php $PHP_SELF;?>" method="post" name="forgotpw">
		<span class="large">Enter username to reset password.</span>
		<br><br>
		<input type="text" name="username" id="user"size="32" style="height:35px; border-radius:6px; padding-right:3px;color:black" />
		<?php echo $hide; ?>
		<button type="submit" name="reset" value="Reset Password" class="btn btn-default" onclick="return validate();"/>Reset Password</button>
		<br><br>
		<?php 
			if($msg){
				echo '<span class="err">',$msg,'</span>';
				}elseif($msg2){
					echo '<span style="color: blue;"><b>',$msg2,'</b></span>';
				}
				?>
		<br>
		<a class="back" style="color:white;" href="index.php">Back to login page -> </a>
	</form>
</div>
</div>

</body>
</html>