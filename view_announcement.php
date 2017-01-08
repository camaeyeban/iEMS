<?php
session_start();
ini_set('session.bug_compat_42',0);
ini_set('session.bug_compat_warn',0);

include("config_DB.php");
require_once("calendar/classes/tc_calendar.php");

$qry = mysql_query("SELECT  title, day, time, location, created_by, date_created, info FROM ems_announcement ORDER BY ann_id DESC" );

?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<title>iEMS</title>
<head>
<link rel="stylesheet" href="cssall.css" type="text/css" />
<script type="text/javascript" src="jquery.js"></script>

<script type="text/javascript" src="navigation.js"></script>
<script type="text/javascript" src="jsFunctions.js"></script>
<script type="text/javascript" src="jquery.tools.min.js"></script>

<script type="text/javascript">

	$(document).ready(function(){
		$('[class^=details]').hide();
		$('[class^=Title]').click(function() {
			var $this = $(this);
			var x = $this.attr('class');
		$('.details-' + x).toggle();
		// $('.details-' + x + ' > td').css("background-color", "#cfcfcf");
		// $('.details-' + x + ' > td').css("border", "1px solid #999");
			return false;
		});
		
		$("a").tooltip({});

	});
		
</script>

</head>
<body style="font-size: 11px; font-family:arial;padding-top:10px;">
	<div><span class="title">Summary of Events</span></div>
	<div class="t"  style="width:390px;">
			<table border="0" width="380px" id="t_color" cellpadding="2">
				<?php
					function str_trim($str){
						$len = strlen($str);
						if($len>=35){
							$val = substr($str, 0, 35);
							return $val."...";
						}else{
							return $str;
						}
					}	
				
					$id = 1;
					while($row = mysql_fetch_array($qry)){
						echo '<tr><td width="125px" colspan="2" style="cursor:pointer;font: bold 13px arial;  padding-left:8px;">&#8226; <a href="#" style="color:#555;" class="Title'.$id.'" title="'.$row[0].'">',str_trim($row[0]),'</a>
								<span class="an">('.date("M-d-Y", strtotime($row[5])).')</span></td></tr>';
						// echo '<tr><td colspan="2"><hr/></td></tr>';
						echo '<tr class="details-Title'.$id.'">
									<td class="an">&#8250; Time</td>
									<td>',date("M. d, Y", strtotime($row[1])),'&nbsp;&nbsp;&nbsp;',$row[2],'</td>
								</tr>';
						// echo '<tr class="details-Title'.$id.'"><td colspan="2"><hr/></td></tr>';

						echo '<tr class="details-Title'.$id.'">
									<td class="an">&#8250; Location</td>
									<td>',$row[3],'</td>
								</tr>';
						// echo '<tr class="details-Title'.$id.'"><td colspan="2"><hr/></td></tr>';

						echo '<tr class="details-Title'.$id.'">
									<td class="an">&#8250; Created by</td>
									<td>',$row[4],'</td>
								</tr>';
						// echo '<tr class="details-Title'.$id.'"><td colspan="2"><hr/></td></tr>';

						echo '<tr class="details-Title'.$id.'">
									<td class="an">&#8250; More Info</td>
									<td>',$row[6],'</td>
								</tr>';
						// echo '<tr class="details-Title'.$id.'"><td colspan="2"><hr/></td></tr>';
						$id+=1;
					}
				?>
			</table>
	</div>
</body>
</html>