<?php
function checkCommuters(){
	include 'sqlConnect.php';
	date_default_timezone_set('America/Los_Angeles');
	$alertTime = date("g:i a", strtotime("now"));
	//echo "\n";
	$table = "formAnswers";
	openDatabase();
	$query="SELECT * FROM $table";
	$result=mysql_query($query);
	while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
   		//printf("ID: %s  Start Station: %s Time: %s End Station: %s Phone: %s Commute Stations: %s", $row[0], $row[1], $row[2], $row[3], $row[4], $row[5]); 
		$commuteTime = date("g:i a", strtotime($row[3]));
		echo $alertWindow = $commuteTime - $alertTime;
		
	}
	//echo $lastAdvisory;
	mysql_close();
	//include sendAlerts();
}

checkCommuters();
?>


c = 9:15am
a = 9:07am

if c - a < 30min