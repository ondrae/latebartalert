<?php
include_once 'sqlConnect.php';
$whichAlert = 2;

// Function Calls
echo "<center>";

$lastAlert = getLastAlert($whichAlert);
print_r($lastAlert);
echoArray($lastAlert);

$lastAlert = cleanAlert($lastAlert);
//print_r($lastAlert);
///echoArray($lastAlert);

echo "<br />Delayed Direction(s)<br />";
$direction = getDirection($lastAlert);
echoArray($direction);
//print_r($direction);

echo "<br />Delayed Direction(s) Abbriviation<br />";
$directionAbbr = getAbbr($direction);
echoArray($directionAbbr);
//print_r($directionAbbr);

echo "<br />Delayed Station(s) Abbriviation<br />";
$delayedStations = getDelayedStations($lastAlert);
echoArray($delayedStations);

echo "</center>";

/*--------------------------------------------------------------------*/

function alertSaysAt($atKey, $lastAlert){
	for($i=0;$i<count($lastAlert);$i++){
		$delayedStations[] = $lastAlert[($atKey+$i+1)];
		if($delayedStations[$i]=='in'){
			array_pop($delayedStations);
			return $delayedStations;
		}
	}	
}



function alertSaysLine($lineKey, $lastAlert){
	$routeFirstName[] = $lastAlert[$lineKey-1];
	if($routeFirstName[0]=='City'){
		$routeFirstName[0] = $lastAlert[$lineKey-2]." ".$routeFirstName[0];
	}elseif($routeFirstName[0]=='Point'){
		$routeFirstName[0] = $lastAlert[$lineKey-2]." ".$routeFirstName[0];
	}elseif($routeFirstName[0]=="City/Millbrae"){
		$routeFirstName[0] = $lastAlert[$lineKey-2]." ".$routeFirstName[0];
	}
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
		//echo "Alert Says At";
		$delayedStationsFull = alertSaysAt($atKey, $lastAlert);
		//print_r($delayedStations);
		for($i=0;$i<count($delayedStationsFull);$i++){
			if($delayedStationsFull[$i]=='West'/* || 'San' || 'Walnut' || 'Union' || 'Powell' || 'Pittsburg/Bay' || 'North' || 'Montgomery' || 'Lake' || 'Glen' || 'Downtown' || 'Daly' || 'Coliseum/Oakland' || 'Castro' || 'Bay' || 'Balboa'*/){
				$delayedStationsFull[$i] = $delayedStationsFull[$i]." ".$delayedStationsFull[$i+1];
				print_r($delayedStationsFull);	
			}
			array_pop($delayedStationsFull);
			print_r($delayedStationsFull);
			$delayedStations[] = getAbbr($delayedStationsFull[$i]);
			echoArray($delayedStations);
		}
	}
	
	
	return $delayedStations;
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


//Gets abbriviation from station names, return array of abbrs
function getAbbr($names){
	//print_r($name);
	$stationNameAbbrList = getStationNames();
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
		if($names[$i]=="24th"){
			$abbr[] = "24TH";
			}
		$nameKey = array_search($names[$i], $stationNameAbbrList);
		//echo $nameKey."<br />";
		if($nameKey!=""){
			$abbr[] = $stationNameAbbrList[$nameKey+1];
			}
		}
	//print_r($abbr);
	$abbr = cleanArray($abbr);
	return $abbr;
	}
	
//Get the direction, returns an array with names in each element	
function getDirection($lastAlert){
	//one direction
	$directionKey = array_search(('direction'), $lastAlert);
	if($directionKey!=""){
		$direction[] = $lastAlert[$directionKey - 1];
		$direction = array_reverse($direction);
		return $direction;	
	}else{
		//multiple directions
		$directionKey = array_search('directions', $lastAlert);
		if($directionKey!=""){
			for($i=0;$i<count($lastAlert);$i++){
				$direction[] = $lastAlert[$directionKey - ($i+1)];
				if(end($direction)=="the"){
					array_pop($direction);
					$direction = array_reverse($direction);
					return $direction;
				}
			}
		}
	}
	echo "It doesn't say direction(s)!";	
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
	$advisories=mysql_query($query);		
	$num=mysql_numrows($advisories) - $whichAlert;
	$lastAlert=mysql_result($advisories,$num,$column);
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
	for($i=0;$i<count($lastAlert);$i++){
		if($lastAlert[$i]=='City'){
			$lastAlert[$i-1] = $lastAlert[$i-1]." ".$lastAlert[$i];
			unset($lastAlert[$i]);
		}
		if($lastAlert[$i]=='Point'){
			$lastAlert[$i-1] = $lastAlert[$i-1]." ".$lastAlert[$i];
			unset($lastAlert[$i]);
		}	
		if($lastAlert[$i]=='Francisco'){
			$lastAlert[$i-1] = $lastAlert[$i-1]." ".$lastAlert[$i];
			unset($lastAlert[$i]);
		}
		if($lastAlert[$i]=='Bay'){
			$lastAlert[$i-1] = $lastAlert[$i-1]." ".$lastAlert[$i];
			unset($lastAlert[$i]);
		}
	}
	
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