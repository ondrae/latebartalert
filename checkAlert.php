#!/usr/bin/php
<?php
function checkAlert(){
	include 'sqlConnect.php';
	//Check for a new BART alert
	$requestCurrentAdvisory = "http://api.bart.gov/api/bsa.aspx?cmd=bsa&key=$apiKey";
	$xml_currentAdvisory = simplexml_load_file($requestCurrentAdvisory) or die("feed not loading");
	
	//Set Station variable - Currently always system wide BART
	$currentStation = $xml_currentAdvisory->bsa->station;
	$currentAdvisory = $xml_currentAdvisory->bsa->description;

	//If no advisories then say so and be done
	if ($currentAdvisory != 'No delays reported.'){
		//Else check in mysql for last advisory to see if its changed
		$table = "advisories";
		openDatabase();
		$query="SELECT advisory FROM $table ORDER BY id DESC LIMIT 1";
		$result=mysql_query($query);
		$lastAdvisory = mysql_result($result, 0);
		if($currentAdvisory == $lastAdvisory){
			//echo "The current advisory $currentAdvisory is still in effect";
			mysql_close();
		} else {
			//echo "There is a brand new advisory of $currentAdvisory";
			$insert = "INSERT INTO $table VALUES ('','$currentStation','$currentAdvisory',NOW());";
			mysql_query($insert);
			mysql_close();
			include sendAlerts.php;
			sendAlerts($currentAdvisory, ['4153074175']); // Send every alert to me.
			include parseAlert.php;
			$delayedStations = alertParser();
			include checkCommuters.php;
			$contactInfo = checkCommuters($delayedStations);
			sendAlerts($currentAdvisory, $contactInfo);
		}
	}
} 

checkAlert();
?>
