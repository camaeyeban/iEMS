<?php
	//Administrator
	if($_SESSION['rights']=="1"){
		include("nav1.php");
	}

	elseif($_SESSION['rights']=="2" OR $_SESSION['rights']=="4"){
		$display = "";
		$hide = "";
			/*if($_SESSION['rights']==4){
				//$display = "style='display:none;'";
				//$emp = $_SESSION['emp_num'];
				//$EIM = '<li><a href=view_edit_personal.php?ID='.$emp.' class=\"eim2\" id=\"eim\">EIM</a></li>';
			}else{
				/*$hide = "style='display: none;'";
				$EIM = "<li><a href=\"#\" class=\"eim\"  id=\"eim\">EIM</a>
							<ul class=\"subnav2\">
								<li><a href=\"emp_info.php\"><img src=\"icons/emplist.png\"/></a></li>
							</ul>
						</li>";
				
			}*/
		include("nav2.php");
	}

	elseif($_SESSION['rights']=="3"){
		include("nav3.php");
	}
	else{
		include("nav5.php");
	}
?>