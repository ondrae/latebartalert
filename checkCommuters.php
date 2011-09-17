<?php
function checkCommuters(){
	include 'sqlConnect.php';
	echo $date = date("H:i:s");
	echo "\n";
	$table = "formAnswers";
	openDatabase();
	$query="SELECT * FROM $table";
	$result=mysql_query($query);
	while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
   		printf("ID: %s  Start Station: %s Time: %s End Station: %s Phone: %s Commute Stations: %s", $row[0], $row[1], $row[2], $row[3], $row[4], $row[5]);  
	}
	//echo $lastAdvisory;
	mysql_close();
	//include sendAlerts();
}

checkCommuters();
?>