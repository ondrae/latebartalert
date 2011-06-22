<?php
include_once 'sqlConnections.php';


/*------------------ Get all the form answers ---------------------*/

//Connect to MySQL
mysql_connect($host,$username,$password) or die('Unable to connect');
mysql_select_db($database);

//Get an array of all the form answers
$query="SELECT * FROM commuters";
$result=mysql_query($query);

//Get an array of all the advisories content		
$query2="SELECT * FROM advisories";
$advisories=mysql_query($query2);

//Close the connection
mysql_close();

//Return all of the form contents

echo "<b>Database Output</b><br />";

$num=mysql_num_rows($result);
$i=0;

while ($i < $num) {
	$startStation=mysql_result($result,$i,"start_station");
	$time=mysql_result($result,$i,"time");
	$endStation=mysql_result($result,$i,"end_station");
	$phone=mysql_result($result,$i,"phone");
	
	echo "$startStation  |  ";
	echo "$time  |  ";
	echo "$endStation  |  ";
	echo "$phone  |  ";
	
	$i++;
	echo "<br />";
	}

/*---------------------------Last Advisory-----------------------*/

	
//Return latest advisory
echo "<br /><b>Last Advisories</b><br />";		

$num2=mysql_numrows($advisories) - 1;
$advisory=mysql_result($advisories,$num2,"advisory");

echo "$advisory <br />";

/*-------------------------Current Advisory-------------------*/

echo "<br /><b>Current Advisory</b><br />";

//Check for a new BART alert
$requestCurrentAdvisory = "http://api.bart.gov/api/bsa.aspx?cmd=bsa&key=EHDB-ZWQN-EKXT-VV5D";
$xml_currentAdvisory = simplexml_load_file($requestCurrentAdvisory) or die("feed not loading");


//Set Station variable - Currently always system wide BART
$currentStation = $xml_currentAdvisory->bsa->station;
$currentAdvisory = $xml_currentAdvisory->bsa->description;

//If no advisories then say so and be done
if ($currentAdvisory == "No delays reported."){
	echo "The current advisory is ";
	echo $currentAdvisory."<br />";
	} else {
//Else check in mysql for last adivsory to see if its changed
		$column = "advisory";

		mysql_connect($host,$username,$password) or die('woops');
		mysql_select_db($database);
		
		$query="SELECT * FROM $table";
		$advisories=mysql_query($query);
		
		
//Latest advisory in table		
		$num=mysql_numrows($advisories) - 1;
		$lastAdvisory=mysql_result($advisories,$num,"advisory");
		
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


/*----------------------Advisories in Database-----------------*/

//Return All Advisories
echo "<br /><b>Database Advisories</b><br />";

$num=mysql_num_rows($advisories);
$i=0;

while ($i < $num) {
	$station=mysql_result($advisories,$i,"station");
	$advisory=mysql_result($advisories,$i,"advisory");
	
	echo "$station  |  ";
	echo "$advisory";
	
	$i++;
	echo "<br />";
	}




//List all the Routes
echo "<div style=\"float:right;>\"<br /><b>Route List</b><br />";

$requestRouteList = "http://api.bart.gov/api/route.aspx?cmd=routes&key=EHDB-ZWQN-EKXT-VV5D";
$xml_routeList = simplexml_load_file($requestRouteList) or die("feed not loading");

$routeList = array();

	for($i=0;$i<count($xml_routeList->routes->route);$i++){
		$routeList[] = $xml_routeList->routes->route[$i]->name;
		$routeList[] = $xml_routeList->routes->route[$i]->abbr;
		$routeList[] = $xml_routeList->routes->route[$i]->routeID;
		$routeList[] = $xml_routeList->routes->route[$i]->number;
		$routeList[] = $xml_routeList->routes->route[$i]->color;
	}

	for($i=0;$i<count($routeList);$i++){
		if(($i%5==0)&&($i>1)){
				echo "<br />";
				}
		echo $routeList[$i] . "<br />";
			}	
		

echo "<br /><br /></div>";




echo "<div style=\"float:left;\"><br /><b>Station List</b><br />";

$apiKey = "EHDB-ZWQN-EKXT-VV5D";

//Get list of stations
function listStations($apiKey){
$requestStationList = "http://api.bart.gov/api/stn.aspx?cmd=stns&key=".$apiKey;
$xml_stationList = simplexml_load_file($requestStationList) or die("feed not loading");

$stationNameList = array();
$stationAbbrList = array();

	for($i=0;$i<count($xml_stationList->stations->station);$i++){
		$stationNameList[] = $xml_stationList->stations->station[$i]->name;
		$stationAbbrList[] = $xml_stationList->stations->station[$i]->abbr;
	}

	for($a=0;$a<count($stationNameList);$a++){
		echo $stationNameList[$a]." ".$stationAbbrList[$a] . "<br />";
	}
}

listStations($apiKey);

echo "<br /></div></div>";
echo "</center>";

?>