<?php
include 'sqlConnect.php';

function checkAlert(){
	//Check for a new BART alert
	$requestCurrentAdvisory = "http://api.bart.gov/api/bsa.aspx?cmd=bsa&key".$apiKey;
	$xml_currentAdvisory = simplexml_load_file($requestCurrentAdvisory) or die("feed not loading");
	
	//Set Station variable - Currently always system wide BART
	$currentStation = $xml_currentAdvisory->bsa->station;
	$currentAdvisory = $xml_currentAdvisory->bsa->description;
	
	//If no advisories then say so and be done
	if ($currentAdvisory == "No delays reported."){
		echo $currentAdvisory;
	} else {
		//Else check in mysql for last advisory to see if its changed
		$table = "advisories";
		openDatabase();
		$query="SELECT * FROM $table ORDER BY id DESC LIMIT 1";
		$advisory=mysql_query($query);
		echo $advisory;
		//Latest advisory in table		
		$num=mysql_numrows($advisoriesy) - 1;
		$lastAdvisory=mysql_result($advisory,$num,"advisory");
		if($currentAdvisory == $lastAdvisory){
			echo "The current advisory $currentAdvisory is still in effect <br />";
			mysql_close();
		} else {
			echo "There is a brand new advisory of $currentAdvisory <br />";
			$insert = "INSERT INTO $table VALUES ('','$currentStation','$currentAdvisory')";
			mysql_query($insert);
			mysql_close();
			}
	}
} 

checkAlert();
?>
