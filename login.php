<?php
  session_start();
  ini_set('session.bug_compat_42',0);
  ini_set('session.bug_compat_warn',0);
  require("mysql_db_connect.inc.php");
  $dblink = new mysql_db_connect();
  include("functions.php");

  if (!$dblink) die("no connection");

  if(isset($_SESSION['emp_num'])){
    header("location: inbox.php");
  }

  if($_GET['al']==md5($_SESSION['user_id'])){
    $msg = "";
  }

  if(isset($_GET['logout'])){
    $qry = mysql_query("UPDATE ems_active_user SET status='0' WHERE user_id='$_SESSION[user_id]' ");
    session_destroy();  
    header("location:login.php");
  }

  $username = $_POST['username'];
  $md5_password = md5($_POST['password']);
  $rights = $_POST['rights'];
  if(isset($_POST['login'])){

    if($rights==1){
      $qry = mysql_query("SELECT is_admin FROM ems_users WHERE username='$username' ");
      $data = mysql_result($qry, 0);
      
        if($data==1){
          $str = "AND is_admin='$data' ";
          $_SESSION['rights'] = 1;
        }else{
          $str = "AND rights='$rights' ";
        }
      
    }else{
      $str = "AND rights='$rights' ";
      $_SESSION['rights'] = $rights;
    }

    $strqry  = "SELECT COUNT('username'), status FROM ems_users WHERE username='$username' AND password='$md5_password' $str GROUP BY username";
    $qry = $dblink->db_qry($strqry);
    $result = $dblink->get_data($qry);
  
    if($result[0]==1 && $result[1]=="Enabled"){
      var_sessions($username,$rights); //sets all the sessions
      // if($_SESSION['emp_num']!=null && $_SESSION['dept_code']==null){
        // $msg = "Log in failed. User don't belong to any department.";
        // $msg2 = "Please contact your system administrator.";
        // unset($_SESSION['username']);
      // }elseif($_SESSION['emp_num']==null){// for admin without emp_num             
        // header("location:inbox.php");    
      // }else{   
      active_user($_SESSION['emp_num'], $_SESSION['user_id']);
      $_SESSION['username'] = $username;
      header("location:inbox.php");
    }elseif($result[0]==1 && $result[1]=="Disabled"){
      $msg = "User Disabled.<br/>";
      $msg2 = " Please contact your system administrator.";
    }elseif($result[0]==1){
      $msg = "Log in failed.";
    }else{
      $msg = "Log in failed.";
    }
  }

?>

<html lang="en">
  <head>

    <!-- Bootstrap core CSS -->
    <link href="dist/css/bootstrap.min.css" rel="stylesheet" />
	<link href="css/home-format.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="dist/css/non-responsive.css" rel="stylesheet" />
    <script type="text/javascript" src="jsFunctions.js"></script>
    <script type="text/javascript" src="jquery.js"></script>


    <script src="js/bootstrap.min.js"></script>

    <script type="text/javascript">
      $(document).ready(function(){
        $("#rights").hide();
        $("#msg").hide();
        $("#username").blur(function(){
          var username = $("#username").val();
          $.ajax({
            type: 'POST',
            url: 'filter_rights.php',
            data: 'username=' + username,
            cache: false,
            success: function(html){
              if(html!=""){
                $("#rights").show();
                $("#msg").show();
                $("#rights").html(html);
                  if($("option").size()==1){
                    $("#rights").css({'visibility' : 'hidden'});
                    $("#msg").css({'visibility' : 'hidden'});
                  }
              }
            }
          });
        }); 
      });
    </script>

  </head>

 <body onLoad="javascript:document.getElementById('username').focus();">
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
          <div id="navbar">
          <form action="<?php $PHP_SELF;?>" method="post" name="loginForm" id="loginForm" class="navbar-form navbar-left">
            <div class="form-group">
               <input type="text" class="form-control" name="username" id="username" placeholder="Username" size="25" required/>
               <input type="password" class="form-control" name="password" id="password" placeholder="Password" required/>
                <button  style="margin-top: 2%;" type="submit" name="login" value="" class="btn  btn-default"/>Log In</button>
                <br>
                <a href="forgotpw.php" title="Forgot your password?" style="font-size:12px;color:white;">Forgot your password?</a>
                 &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp
                  <select name="rights" id="rights"></select>
                <span class ="messg"><?php echo $err = ($msg) ? $msg: "";?></span></div>
               </form>
            </div>
        </div>
    </nav>

     <div class ="logo"><img src ="assets/images/ems_logo.jpg"></div>
     <div class ="logo_text">Employee Management System
      <br>
      <span>Daily Time Recording has never been this easier and faster.</span>
     </div>

    <div class="banner">
      <img src ="assets/images/banner2.png" style="width:82%"></img>
    </div>


     <div class="row">

      <div class="col-sm-2" style="margin-right:3%; border: 1px solid black; width: 25%; height: 40%; border-radius:2%;">
              <h2>Request Management</h2>
                  <p>These marketing boxes are a great place to put some informtion. These can contain summaries of what the company does
                  Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, 
                Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, </p>
      </div>

      <div class="col-sm-2" id="box" style="margin-right:3%; border: 1px solid black; width: 25%; height: 40%;  border-radius:2%;">
              <h2>Attendance Checking</h2>
                  <p>The images are set to be circular and responsive. Fusce dapibus, tellus ac cursus commodo
                    Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo
                    Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo</p>
      </div>
       <div class="col-sm-2" id="box" style="margin-right:3%; border: 1px solid black; width: 25%; height: 40%;  border-radius:2%;">
        
              <h2>Reports Generation</h2>
                  <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, 
                  tellus ac cursus commodo.Donec id elit non mi porta gravida at eget metus. 
                  Fusce dapibus, tellus ac cursus commodo, </p>
      </div>
    </div>

   
     <?php include("footer.php"); ?>

  </body>


</html>
