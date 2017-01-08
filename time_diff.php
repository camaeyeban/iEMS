
<?php

include("functions.php");

$start_time = date("H:i", strtotime($_POST['start']));
$end_time = date("H:i", strtotime($_POST['end']));


$diff = getTimeDiff($start_time, $end_time);
		
echo $diff;

?>
