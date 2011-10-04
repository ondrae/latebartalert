<?php
//Checks for commuters who are about to take a train.
//Returns their phone number in an array.
function checkCommuters($delayedStations){
	include 'sqlConnect.php';
	date_default_timezone_set('America/Los_Angeles');
	$alertTime = date("g:i a", strtotime("now"));
	$table = "formAnswers";
	openDatabase();
	$query="SELECT * FROM $table";
	$result=mysql_query($query);
	$contactInfo = [];
	while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
   		$commuterID = $row[0];
		$startStation = $row[1];
		$commuteTime = date("g:i a", strtotime($row[2]));
		$endStation = $row[3];
		$phone = $row[4];
		$commuteStations = $row[5];
		//Check time first, then stations
		$alertWindow = $commuteTime - $alertTime;
		//print_r($commuteTime);
		//Find commuters about to take train.
		if ($alertWindow < 15) {
			//Check their stations.
			foreach($commuteStations as $sta){
				//if found, get their phone num.
				if(in_array($sta, $delayedStations)==TRUE){
					$contactInfo[] = $phone;
					mysql_close();
					return $contactInfo;
				}
			}	
		}
	}
}
?>