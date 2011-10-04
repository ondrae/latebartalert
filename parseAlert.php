<?php
include 'sqlConnect.php';
include 'cleanStationNames.php';
$whichAlert = 4
alertParser($whichAlert);

//Parses alert and returns array of delayed stations.
function alertParser($whichAlert){
	//Query last alert and turn it into an array.
	$lastAlert = getLastAlert($whichAlert);
	//Clean up some of the test.
	$lastAlert = cleanAlert($lastAlert);
	//Pull out direction of delay.
	$direction = getDirection($lastAlert);
	//Get directions abbreviation.
	$directionAbbr = getAbbr($direction);
	//Get array of all delayed stations.
	$delayedStations = getDelayedStations($lastAlert);
	print_r($delayedStations);
	return $delayedStations;
}

/*--------------------------------------------------------------------*/

function alertSaysAt($atKey, $lastAlert){
	for($i=0;$i<count($lastAlert)-$atKey;$i++){
		$delayedStations[] = $lastAlert[($atKey+$i+1)];
		if($delayedStations[$i]=='in'){
			array_pop($delayedStations);
			//print_r($delayedStations);
			return $delayedStations;
		}
	}	
}

function alertSaysLine($lineKey, $lastAlert){
	//echo $lineKey;
	$routeFirstName[0] = $lastAlert[$lineKey-1];
	//Check for more than one line
	if($lastAlert[$lineKey+1]=='AND'){
		$secondLine = array_slice($lastAlert,$lineKey+1);
		//print_r($secondLine);
		$lineKey2 = array_search('Line', $secondLine);
		//echo $secondLine[$lineKey2-1];
		$routeFirstName[] = $secondLine[$lineKey2-1];
		}
		//print_r($routeFirstName);
	//echoArray($routeFirstName);
	//Get abbriviation of $routeName, needs to be array
		
	$routeFirstAbbr = getAbbr($routeFirstName);
	//echoArray($routeFirstAbbr);
	
	//Get all route numbers
	$apiKey = "EHDB-ZWQN-EKXT-VV5D";
	$requestRouteNumbers = "http://api.bart.gov/api/route.aspx?cmd=routes&key=".$apiKey;
	$xml_numbersList = simplexml_load_file($requestRouteNumbers) or die("feed not loading");
	for($i=0;$i<count($xml_numbersList->routes->route);$i++){
		$routeNumbers[] = $xml_numbersList->routes->route[$i]->number;
	}
	//echoArray($routeNumbers);
	
	//Look through each route station list and keep the stations if Line name is included
	for($x=0;$x<count($routeNumbers);$x++){
		$requestStationList = "http://api.bart.gov/api/route.aspx?cmd=routeinfo&route=".$routeNumbers[$x]."&key=".$apiKey;
		$xml_List = simplexml_load_file($requestStationList) or die("feed not loading");
		for($i=0;$i<count($xml_List->routes->route->config->station);$i++){
			$allRouteStations[] = $xml_List->routes->route->config->station[$i];
			//echoArray($allRouteStations);
		}
		for($a=0;$a<count($routeFirstAbbr);$a++){
			if(in_array($routeFirstAbbr[$a], $allRouteStations)){
				//echo 'Boogaloo!';
				//echo($allRouteStations);
				for($z=0;$z<count($allRouteStations);$z++){
					$delayedStations[] = $allRouteStations[$z];
				}
			}
		}
		unset($allRouteStations);	
	}
	//echoArray($delayedStations);
	$delayedStations = array_unique($delayedStations);
	return $delayedStations;
}

//Finds the delayed stations by searching for 'at' or 'Line'
function getDelayedStations($lastAlert){
	//Does the alert say line?
	$lineKey = array_search('Line', $lastAlert);
	$atKey = array_search('at', $lastAlert);
	//echo $atKey;
	$betweenKey = array_search('between', $lastAlert);
	echo $betweenKey;
	if(is_int($lineKey)=='1'){
		//echo "Alert Says Line!";
		$delayedStations = alertSaysLine($lineKey, $lastAlert);
	}
	if(is_int($atKey)=='1'){
		//echo "Alert Says At <br/>";
		$delayedStationsFull = alertSaysAt($atKey, $lastAlert);
		$delayedStations = getAbbr($delayedStationsFull);
		}
	//If not at or line then ALL stations	
	if(is_int($atKey)=='0'){
		if(is_int($lineKey)=='0'){
			$allStations = getStationNames();
			for($i=1;$i<count($allStations);$i=$i+2){
				$delayedStations[] = $allStations[$i];
			}
		}
	}
	return $delayedStations;
}

//Gets abbriviation from station names, return array of abbrs
function getAbbr($names){
	//echo gettype($names);
	//echo count($names);
	//echoArray($names);
	$stationNameAbbrList = getStationNames();
	//echoArray($stationNameAbbrList);
	for($i=0;$i<count($names);$i++){
		if($names[$i]=="SFO"){
			$abbr[] = "SFIA";
			}
		if($names[$i]=="East Bay"){
			$abbr[] = "RICH";
			$abbr[] = "PITT";
			$abbr[] = "DUBL";
			$abbr[] = "FRMT";
			}
		if($names[$i]=="San Francisco"){
			$abbr[] = "SFIA";
			$abbr[] = "MLBR";
			$abbr[] = "DALY";
			}
		//echo $names[$i];
		$nameKey = array_search($names[$i], $stationNameAbbrList);
		//echo $nameKey."<br />";
		if($nameKey!=""){
			//echo $stationNameAbbrList[$nameKey+1].'<br/>';
			$abbr[] = $stationNameAbbrList[$nameKey+1];
			}
		}
	//print_r($abbr);
	$abbr = cleanArray($abbr);
	//print_r($abbr);
	return $abbr;
	}

function getRouteAbbrList(){
	$routeList = getRouteList();
	for($i=1;$i<count($routeList);$i=$i+5)
	$routeAbbrList[]=$routeList[$i];
	$routeAbbrList = cleanArray($routeAbbrList);
	return $routeAbbrList;
	}

//Gets just the route names, returns an array
function getRouteNameList(){
	$routeList = getRouteList();
	for($i=0;$i<count($routeList);$i=$i+5)
	$routeNameList[]=$routeList[$i];
	$routeNameList = cleanArray($routeNameList);
	return $routeNameList;
	}

//Make an array contain only strings
function cleanArray($array){
	//print_r($array);
	for($i=0;$i<count($array);$i++){
		$array[$i] = strval($array[$i]);
	}
	//print_r($array);
	return $array;
}

//Get Route Info List
function getRouteList(){
	$apiKey = "EHDB-ZWQN-EKXT-VV5D";
	$requestRouteList = "http://api.bart.gov/api/route.aspx?cmd=routes&key=".$apiKey;
	$xml_routeList = simplexml_load_file($requestRouteList) or die("feed not loading");
	
	for($i=0;$i<count($xml_routeList->routes->route);$i++){
		$routeList[] = $xml_routeList->routes->route[$i]->name;
		$routeList[] = $xml_routeList->routes->route[$i]->abbr;
		$routeList[] = $xml_routeList->routes->route[$i]->routeID;
		$routeList[] = $xml_routeList->routes->route[$i]->number;
		$routeList[] = $xml_routeList->routes->route[$i]->color;
	}
	
	return $routeList;
}

//Get list of station names and abbriviations, returns array with names and abbr alternating
function getStationNames(){
	$apiKey = "EHDB-ZWQN-EKXT-VV5D";
	$requestStationList = "http://api.bart.gov/api/stn.aspx?cmd=stns&key=".$apiKey;
	$xml_stationList = simplexml_load_file($requestStationList) or die("feed not loading");
		
	for($i=0;$i<count($xml_stationList->stations->station);$i++){
		$stationNameAbbrList[] = $xml_stationList->stations->station[$i]->name;
		$stationNameAbbrList[] = $xml_stationList->stations->station[$i]->abbr;
	}
	return $stationNameAbbrList;
}



	
//Get the direction, returns an array with names in each element	
function getDirection($lastAlert){
	//echo 'look for directions';
	//one direction
	$directionKey = array_search(('direction'), $lastAlert);
	if($directionKey!=""){
		echo 'found one direction';
		$direction[] = $lastAlert[$directionKey - 1];
		$direction = array_reverse($direction);
		return $direction;	
	}else{
		//multiple directions
		$directionKey = array_search('directions', $lastAlert);
		if($directionKey!=""){
			echo 'found two directions';
			for($i=0;$i<count($lastAlert);$i++){
				$direction[] = $lastAlert[$directionKey - ($i+1)];
				if(end($direction)=="the"){
					array_pop($direction);
					$direction = array_reverse($direction);
					return $direction;
				}
			}
		}else{
			echo 'found no directions';
		}
	}	
}

function removeComma($string){
	if(strpos($string,",")!=""){
		$string = substr($string, 0, -1);
		return $string;
	}
	return $string;	
}



/*----------------------------------------------------------------*/
//Gets the Last Advisory, returns an array, the last element is always empty
function getLastAlert($whichAlert){
	openDatabase();
	$table = "advisories";
	$column = "advisory";		
	$query="SELECT * FROM $table";
	$result=mysql_query($query);		
	$num=mysql_numrows($result) - $whichAlert;
	$lastAlert=mysql_result($result,$num,$column);
	mysql_close();
	$lastAlert = explode(" ", $lastAlert); //Turn alert into array
	if(end($lastAlert)==""){
		array_pop($lastAlert);
	}
	//print_r($lastAlert);
	return $lastAlert;
}

//Cleans multiple word stations names into same array elements
function cleanAlert($lastAlert){
	//Joins the names with a slash in them
	if(in_array("/", $lastAlert)!=""){
		$slashKeys = array_keys($lastAlert, "/");
		//print_r($slashKeys);
		for($i=0;$i<count($slashKeys);$i++){
			//print_r($slashKeys[$i]);
			//echo "<br />";
			//echo $lastAlert[($slashKeys[$i]-1)];
			$newName = $lastAlert[($slashKeys[$i]-1)]."/".$lastAlert[($slashKeys[$i]+1)];
			$lastAlert[($slashKeys[$i]-1)] = $newName;
			$lastAlert[$slashKeys[$i]] = "";
			$lastAlert[($slashKeys[$i]+1)] = "";
			}
			$cleanedAlert = array_filter($lastAlert);
			$lastAlert = array_merge($cleanedAlert);
	}
	
	//Cleans the commas out
	for($i=0;$i<count($lastAlert);$i++){
		$lastAlert[$i] = removeComma($lastAlert[$i]);
	}
	
	//Joins multiple word names
	//Moved function to another file
	$lastAlert = cleanStationNames($lastAlert);
	
	//print_r($lastAlert);
	$lastAlert = array_values($lastAlert);
	//print_r($lastAlert);
	return $lastAlert;
}

function echoArray($array){
	for($i=0;$i<=count($array);$i++){
		echo $array[$i];
		echo " ";
		}
	echo "<br />";	
	}

?>