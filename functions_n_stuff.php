//Retrun a list of stations betweeen teh start and end stop.
function getCommuterStationList($startStation, $endStation){
	//Figure out the list of stations the commuter will travel through.
	
	//Get all route numbers
	$requestRouteNumbers = "http://api.bart.gov/api/route.aspx?cmd=routes&key=".$apiKey;
	$xml_numbersList = simplexml_load_file($requestRouteNumbers) or die("feed not loading");
	for($i=0;$i<count($xml_numbersList->routes->route);$i++){
		$routeNumbers[] = $xml_numbersList->routes->route[$i]->number;
	}
	
	//Look through each route station list and keep the stations if Line name is included
	for($x=0;$x<count($routeNumbers);$x++){
		$requestStationList = "http://api.bart.gov/api/route.aspx?cmd=routeinfo&route=".$routeNumbers[$x]."&key=".$apiKey;
		$xml_List = simplexml_load_file($requestStationList) or die("feed not loading");
		for($i=0;$i<count($xml_List->routes->route->config->station);$i++){
			$allRouteStations[] = $xml_List->routes->route->config->station[$i];
			//echoArray($allRouteStations);
		}
		/*for($a=0;$a<count($routeFirstAbbr);$a++){
			if(in_array($routeFirstAbbr[$a], $allRouteStations)){
				//echo 'Boogaloo!';
				//echo($allRouteStations);
				for($z=0;$z<count($allRouteStations);$z++){
					$delayedStations[] = $allRouteStations[$z];
				}
			}
		}*/
		unset($allRouteStations);	
	}
	//echoArray($delayedStations);
	$delayedStations = array_unique($delayedStations);
	return $delayedStations;
	
	
	
	
	
	
	
	
	
	
	return $commute_station_list	
}
