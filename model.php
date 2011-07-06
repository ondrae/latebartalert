<?php
//Get list of station names and abbriviations, returns array with names and abbr alternating
function getStationNames(){
	$apiKey = "EHDB-ZWQN-EKXT-VV5D";
	$requestStationList = "http://api.bart.gov/api/stn.aspx?cmd=stns&key=".$apiKey;
	$xml_stationList = simplexml_load_file($requestStationList) or die("feed not loading");
		
	for($i=0;$i<count($xml_stationList->stations->station);$i++){
		$stationNameAbbrList[] = $xml_stationList->stations->station[$i]->name;
		$stationNameAbbrList[] = $xml_stationList->stations->station[$i]->abbr;
	}
	//print_r($stationNameAbbrList);
	return $stationNameAbbrList;
}


//Gets abbriviation from station names, return array of abbrs
function getAbbr($names){
	//print_r($names);
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
		if($names[$i]=="San Francisco"){
			$abbr[] = "SFIA";
			$abbr[] = "MLBR";
			$abbr[] = "DALY";
			}
		$nameKey = array_search($names[$i], $stationNameAbbrList);
		if($nameKey!=""){
			$abbr[] = $stationNameAbbrList[$nameKey+1];
			}
		}
	$abbr = cleanArray($abbr);
	//print_r($abbr);
	return $abbr;
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
?>