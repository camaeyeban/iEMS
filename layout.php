<?php
require("mysql_db_connect.inc.php");
$dblink = new mysql_db_connect();

if (!$dblink)
	die("no connection");


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel='stylesheet' href='cssall.css' type='text/css' />
<script type="text/javascript" src="jquery.js">
</script>

<script type="text/javascript">
$(document).ready(function(){

//for the main navigator


      $("a.admin").mouseenter(function(){
         $(this).parent().find("ul.subnav").slideDown('fast').show();
      $(this).parent().hover(function(){
        }, function(){
          $(this).parent().find("ul.subnav").hide();
      });
      });
    
      $("a.eim").mouseenter(function(){
         $(this).parent().find("ul.subnav2").slideDown('fast').show();
      $(this).parent().hover(function(){
        }, function(){
          $(this).parent().find("ul.subnav2").hide();
      });
      });
    
      $("a.TR").mouseenter(function(){
         $(this).parent().find("ul.subnav3").slideDown('fast').show();
      $(this).parent().hover(function(){
        }, function(){
          $(this).parent().find("ul.subnav3").hide();
      });
      });
    
      $("a.AR").mouseenter(function(){
         $(this).parent().find("ul.subnav4").slideDown('fast').show();
      $(this).parent().hover(function(){
        }, function(){
          $(this).parent().find("ul.subnav4").hide();
      });
      });


    //for the submenus
          //Company Info   

     $(".comp").mouseenter(function(){
         $(this).parent().find(".subgen").slideDown('fast').show();
      $(this).parent().hover(function(){
        }, function(){
          $(this).parent().find(".subgen").hide();
      });
      });
      
      $(".job").mouseenter(function(){
         $(this).parent().find(".subjob").slideDown('fast').show();
      $(this).parent().hover(function(){
        }, function(){
          $(this).parent().find(".subjob").hide();
      });
      });
    
      $(".request").mouseenter(function(){
         $(this).parent().find(".subrqst").slideDown('fast').show();
      $(this).parent().hover(function(){
        }, function(){
          $(this).parent().find(".subrqst").hide();
      });
      });

});

</script>
</head>

<body>
<div id="container">
      <div id="banner">
           <table border='0' width='100%'>
                  <tr>
                       <td class="imgbanner"></td>
                       <td class="welcome" align='right' valign='bottom'>Welcome <a href='#'>Change Password</a> <a href='login.php'>Log out</a></td>
                  </tr>
           </table>
      </div>

      <div id="navigator">
           <ul class="topnav">
               <li><a href='#' class="admin">Admin</a>
                      <ul class="subnav">
                           <li><a href='#' class="comp"><img src='icons/compinfo.png'/></a>
                                  <ul class="subgen">
                                      <li><a href='comp_info.php'><img src='icons/gen.png'/></a></li>
                                      <li><a href='#'><img src='icons/bunits.png'/></a></li>
                                  </ul>
                           </li>
                           <li><a href='#' class="job"><img src='icons/job.png'/></a>
                                  <ul class="subjob">
                                      <li><a href='#'><img src='icons/jobtitle.png'/></a></li>
                                      <li><a href='#'><img src='icons/jobspec.png'/></a></li>
                                      <li><a href='#'><img src='icons/empstatus.png'/></a></li>
                                  </ul>
                           </li>
                           <li><a href='#'><img src='icons/users.png'/></a></li>
                      </ul>
               </li>
               <li>
                   <a href='#' class="eim">EIM</a>
                      <ul class="subnav2">
                           <li><a href='#'><img src='icons/emplist.png'/></a></li>
                      </ul>
               </li>
               <li><li><a href='#' class="TR">Transaction Request</a>
                      <ul class="subnav3">
                           <li><a href='#'><img src='icons/leave.png'/></a></li>
                           <li><a href='#'><img src='icons/offset.png'/></a></li>
                           <li><a href='#'><img src='icons/ot.png'/></a></li>
                           <li><a href='#'><img src='icons/ob.png'/></a></li>
                      </ul>
               </li>
               <li><li><a href='#' class="AR">Adminstrative Request</a>
                      <ul class="subnav4">
                           <li><a href='#' class="request"><img src='icons/request.png'/></a>
                                  <ul class="subrqst">
                                      <li><a href=''><img src='icons/rqst.png' /></a></li>
                                      <li><a href=''><img src='icons/rqstn.png' /></a></li>
                                  </ul>

                           </li>
                           <li><a href='#'><img src='icons/air.png'/></a></li>
                      </ul>
               </li>
           </ul>
      </div>

      <div id="right">
            <div>
                 <p class="title">Leave Summary</p>
            </div>
            <div id="content">
                 <table border='0' width='100%'>

                 </table>
            </div>
      </div>

</div>

</body>
</html>
