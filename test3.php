<?php


//List out all the delayed stations in the delayed routes
function getDelayedStations($delayedRoutes){
	$routeList = getRouteList();
	for($i=0;$i<count($routeList);$i=$i+5){
		for($x=0;$x<count($delayedRoutes);$x++){
			if($routeList[$i+1]==$delayedRoutes[$x]){
				$routeNumbers[] = $routeList[$i+3];
			}
		}
	}
	//echoArray($routeNumbers);
	//Make API call to grab list of stations for each route
	$delayedStations = getDelayedStationNames($routeNumbers);
	//Get rid of duplicates
	$delayedStations = array_unique($delayedStations);
	
	return $delayedStations;
}



function getDelayedStationNames($routeNumbers){
	for($x=0;$x<count($routeNumbers);$x++){
		$apiKey = "EHDB-ZWQN-EKXT-VV5D";
		$requestStationList = "http://api.bart.gov/api/route.aspx?cmd=routeinfo&route=".$routeNumbers[$x]."&key=".$apiKey;
		$xml_List = simplexml_load_file($requestStationList) or die("feed not loading");
		for($i=0;$i<count($xml_List->routes->route->config->station);$i++){
			$delayedStations[] = (string) $xml_List->routes->route->config->station[$i];
		}
	sleep(1);
	}
	return $delayedStations;
}



//There is a major delay on the Daly City Line in the SFO, Millbrae, Daly City and East Bay directions
/*
//When alert says line, find the Route number
function alertSaysLine($lineKey, $lastAlert, $directionAbbr){
	$routeFirstName[] = $lastAlert[$lineKey-1];
		if($routeFirstName[0]=='City'){
			$routeFirstName[0] = $lastAlert[$lineKey-2]." ".$routeFirstName[0];
			}
		if($routeFirstName[0]=='Point'){
			$routeFirstName[0] = $lastAlert[$lineKey-2]." ".$routeFirstName[0];
			}
		if($routeFirstName[0]=="City/Millbrae"){
			$routeFirstName[0] = $lastAlert[$lineKey-2]." ".$routeFirstName[0];
			}
		//echoArray($routeFirstName);
		//Get abbriviation of $routeName, needs to be array
		
		$routeFirstAbbr = getAbbr($routeFirstName);
		//echoArray($routeFirstAbbr);
		//echo "WHAT!";
		if($routeFirstAbbr[0]=='DALY'){
			$routeFirstAbbr[1]='MLBR';
			$routeFirstAbbr[2]='SFIA';
			}
		echoArray($routeFirstAbbr);
		
		//echoArray($routeAbbrList);
		
		//With routeName and direction, get full route name
		for($i=0;$i<count($directionAbbr);$i++){
			for($x=0;$x<count($routeFirstAbbr);$x++){
				$routeNameAbbr[] = $routeFirstAbbr[$x]."-".$directionAbbr[$i];;
			}
		}
		//echoArray($routeFullName);
		
		//Build array of good route names
		$routeAbbrList = getRouteAbbrList();
		
		//Clean up route names that aren't real
		for($i=0;$a<count($routeAbbrList);$a++){
			for($x=0;$x<count($routeNameAbbr);$x++){
				if($routeNameAbbr[$x]==$routeAbbrList[$a]){
					$delayedRoutes[] = $routeNameAbbr[$x];
				}
			}
		}
		//echoArray($delayedRoutes);
		
		return $delayedRoutes;
		
}
*/


/*function getDelayedStationNames($routeNumbers){
	openDatabase();
	for($i=0;$i<count($routeNumbers);$i++){		
		$query="SELECT stations FROM routeStations WHERE number=".$routeNumbers[$i].";";
		$queryResults[]=mysql_query($query);
		sleep(5);		
	}
	mysql_close();
	echoArray($queryResults);
	for($x=0;$x<count($queryResults);$x++){
		$delayedStations=mysql_results($queryResults[$x]);
	}
	return $delayedStations;
}*/



function itSaysLine($lineKey, $lastAlert, $directionAbbr){
	$delayedLine = getDelayedLine($lineKey, $lastAlert); 
	//Needs to be array to get the abbr later
	//echo $delayedLine; 
	//Search the route name list for the beginning to match
	$routeNameList = getRouteNameList();
	//print_r($routeNameList);
	//Search the route name list for the lineName in the beginning and direction at the end
	for($i=0;$i<count($routeNameList);$i++){
		$lineNameKey = strpos($routeNameList[$i],$delayedLine);
		//echo $lineNameKey."<br />";
		for($a=0;$a<count($direction);$a++){
			$directionKey = strpos($routeNameList[$i],$direction[$a]);
			//echo $directionKey."<br />";
			if(($lineNameKey===0)&&($directionKey!==0)&&($directionKey!="")){
				$routeName[] = $routeNameList[$i];
			}
		}			
	}
	//print_r($routeName);
	return $routeName; 
}

//Does it say 'at'?
	$atKey = array_search('at', $lastAlert);
	if($atKey!=''){
		$delayedStation = itSaysAt($atKey, $delayedStation);
	}
	//Does it say 'Line'?
	//$lineKey = array_search('Line', $lastAlert);
	//if($lineKey!==''){
	//	$delayedStation = itSaysLine($lineKey, $delayedStation);
	//}
	
	//echoArray($delayedStation);
	return $delayedStation;	
}

//Grab the station name right before the 'at'
function itsSaysAt($atKey, $lastAlert){
	//Fill up delayedSttaion until it says 'in the'
	
	//$i=0;
	//$bb = count($lastAlert);
	//echo $bb;
	//while($i<(count($lastAlert)-$atKey){
	//	echo 'h';
	//	$delayedStation[] = $lastAlert[($atKey+$i)];
	//	$i++;
	//}
	//print_r($delayedStation);
	//if($delayedStation[$i]=='in'){
	//	array_pop($delayedStation);
	//}
	/*
		for($i=1;$i<(count($delayedStation)+1);$i++){
		$delayedStation[] = $lastAlert[($atKey+$i)];
		if($delayedStation[$i-1]=='West'){
			$delayedStation[$i] = $delayedStation." ".$lastAlert[($atKey+$i+1)];
		}
	}
	if()
	*/




//Gets the route name from the Line name or Station names and the directions, returns array
/*
function getRouteName($directionAbbr, $lastAlert){
	//does it say at?
	
	
	//does it say line?
	$lineBoo = array_search('Line', $lastAlert);
	//print_r($lineBoo);
	if($lineBoo!=""){
		$routeName = itSaysLine($lineBoo, $lastAlert, $directionAbbr);
		return $routeName;	
	}	
*/
/*	
	for($i=0;$i<count($directionAbbr);$i++){
		if($directionAbbr[$i]=='SFIA'){
			$routeNumber = 1;
		}
		if($directionAbbr[$i]=='PITT'){
			$routeNumber = 2;
		}
		if($directionAbbr[$i]=='RICH'){
			$routeNumber = 3;
		}
		if($directionAbbr[$i]=='FRMT'){
			$routeNumber = 4;
		}
		if($directionAbbr[$i]=='DALY'){
			$routeNumber = 5;
		}
		if($directionAbbr[$i]=='FRMT'){
			$routeNumber = 6;
		}
		if($directionAbbr[$i]=='MLBR'){
			$routeNumber = 7;
		}
		if($directionAbbr[$i]=='RICH'){
			$routeNumber = 8;
		}
		if($directionAbbr[$i]=='DALY'){
			$routeNumber = 11;
		}
		if($directionAbbr[$i]=='DUBL'){
			$routeNumber = 12;
		}
		$apiKey = "EHDB-ZWQN-EKXT-VV5D";
		$requestRouteStationList = "http://api.bart.gov/api/route.aspx?cmd=routeinfo&route=".$routeNumber."&key=".$apiKey;
		$xml_routeStationList = simplexml_load_file($requestRouteStationList) or die("feed not loading");
		for($x=0;$x<count($xml_routeList->routes->route->config);$x++){
			$routeStationList[$x] = $xml_routeStationList->routes->route->config->station[$x];
		}
		//for($a=0;$a<count($routeStationList);$a++){
		//	if($directionAbbr[$i]==$routeStation[$a]){
				
		//	}
		}
	}*/
}


/*	
	
	//Check for Line first
	$lineBoo = array_search('Line', $lastAlert);
	//print_r($lineBoo);
	if($lineBoo!=""){
		$routeName = itSaysLine($lineBoo, $lastAlert, $direction);
		return $routeName;	
	}	
	
	//Look for routes ending in direction abbr
	$routeList = getRouteList();
	//print_r($routeList);
	for($i=1;$i<count($routeList);$i=$i+5){
		$routeAbbrList[] = $routeList[$i];
	}
	$routeAbbrList = cleanArray($routeAbbrList);
	//print_r($routeAbbrList);
	//echoArray($routeAbbrList);
	//print_r($routeAbbrList);
	//print_r($directionAbbr);
	for($i=0;$i<count($routeAbbrList);$i++){
		for($a=0;$a<count($directionAbbr);$a++){
			$routeDirectionKey = strpos($routeAbbrList[$i],$directionAbbr[$a]);
			//print_r($routeDirectionKey);
			//Only routes where direction is at the end
			if($routeDirectionKey!=0){
				$routeName[] = $routeAbbrList[$i];
				}
		}	
	}
	//Check that the delayed station is on the route
	for($i=0;$i<count($routeName);$i++){
		for($a=1;$a<count($routeList);$a=$a+5){
			if($routeName[$i]==$routeList[$a]){
				$routeNumber[] = $routeList[$a+2];
			}
		}
	}
	$routeNumber = cleanArray($routeNumber);
	//print_r($routeNumber);
	
	//FInd delayed 'at' station
	$atKey = array_search('at', $lastAlert);
	$delayedStation[] = $lastAlert[($atKey+1)];
	//echoArray($delayedStation);
	$delayedStation = getAbbr($delayedStation);
	//echoArray($delayedStation);
	*/
	/*
	//Grab all the stations for each route, and see if the delayed 'at' station is there
	for($i=0;$i<count($routeNumber);$i++){
		$routeStationList = getRouteStationList($routeNumber[$i]);
		print_r($routeStationList);
		$stationOnRouteBoo = array_search($delayedStation, $routeStationList);
		print_r($stationOnRouteBoo);
	}
	*/	
	//return $routeName;	
//}

/*
//USes the route number to get the list of stations on the route
function getRouteStationList($routeNumber){
	$apiKey = "EHDB-ZWQN-EKXT-VV5D";
	$requestRouteStationList = "http://api.bart.gov/api/route.aspx?cmd=routeinfo&route=".$routeNumber."&key=".$apiKey;
	$xml_routeStationList = simplexml_load_file($requestRouteStationList) or die("feed not loading");
	
	for($i=0;$i<count($xml_routeList->routes->route->config);$i++){
		$routeStationList[] = $xml_routeStationList->routes->route->config->station[$i];
	}
	
	return $routeStationList;	
}
*/

//Looks for 'at', returns key or false
function lookForAt($lastAlert){
	$atKey = array_search('at', $lastAlert);
	return $atKey;
}

function getDelayStation($lastAlert, $atKey){
		$delayStation = $lastAlert[$atKey + 1];
		if($delayStation=="El"){
			$delayStation = $delayStation." ".$lastAlert[$atKey + 2];
			$delayStation = $delayStation." ".$lastAlert[$atKey + 3];
			if($delayStation=="El Cerrito del"){
				$delayStation = $delayStation." ".$lastAlert[$atKey + 4];
			}
		}
		if($delayStation=="North"){
			$delayStation = $delayStation." ".$lastAlert[$atKey + 2];
		}	
		if($delayStation=="San"){
			$delayStation = $delayStation." ".$lastAlert[$atKey + 2];
		}
		if($delayStation=="West"){
			$delayStation = $delayStation." ".$lastAlert[$atKey + 2];
		}
	return $delayStation;
}

//Build array of delayed routes
function delayedRoutes($sfBoo){
	if($sfBoo=="true"){
		$delayedRoutes = array();
		$delayedRoutes[] = '1';
		$delayedRoutes[] = '2';
		$delayedRoutes[] = '5';
		$delayedRoutes[] = '6';
		$delayedRoutes[] = '7';
		$delayedRoutes[] = '8';
		$delayedRoutes[] = '11';
		$delayedRoutes[] = '12';
	}
	return $delayedRoutes;
}

//Build array of delayed stations
function delayedStations($sfBoo){
	if($sfBoo=="true"){
		$delayedStations = array();
		$delayedStations[] = '16TH';
		$delayedStations[] = '24TH';
		$delayedStations[] = 'BALB';
		$delayedStations[] = 'CIVC';
		$delayedStations[] = 'EMBR';
		$delayedStations[] = 'GLEN';
		$delayedStations[] = 'MONT';
		$delayedStations[] = 'POWL';
	}else{
		$delayedStations[] = 'sfBoo';
		$delayedStations[] = 'is';
		$delayedStations[] = "false";
		}
	return $delayedStations;
}

function parseAlert(){
	$lastAlert = getLastAlert();
	
	//$sfBoo = lookForSF($lastAlert);

	/*
	if($sfBoo=="false"){
		$atKey = lookForAt($lastAlert);
		if($atKey=="false")
			echo "No AT found!";
		else{
			$delayTime = getDelayTime($lastAlert, $atKey);
			$delayStation = getDelayStation($lastAlert, $atKey);
			echo "<br />The delay is at $delayStation for ".$delayTime."s <br />";
		}
	}else{
		$delayedRoutes = delayedRoutes($sfBoo);
		$delayedStations = delayedStations($sfBoo);
		
		echo "The delayed routes are <br />";
		for($i=0;$i<count($delayedRoutes);$i++){
			echo $delayedRoutes[$i]."<br />";
			}
		
		echo "<br /> The delayed stations are <br />";
		for($i=0;$i<count($delayedStations);$i++){
			echo $delayedStations[$i]."<br />";
			}

		}
		*/
}
?>