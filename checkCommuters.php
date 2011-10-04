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
   		$commuterID = $row[0];
		$startStation = $row[1];
		$commuteTime = date("g:i a", strtotime($row[2]));
		$endStation = $row[3];
		$phone = $row[4];
		$commuteStations = $row[5];
		//Check time first, then stations
		$alertWindow = $commuteTime - $alertTime;
		print_r($commuteTime);
	}
	//echo $lastAdvisory;
	mysql_close();
	//include sendAlerts();
}

checkCommuters();
?>