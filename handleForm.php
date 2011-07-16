<?php
include 'sqlConnect.php';
include 'cleanStationNames.php';
//include_once 'model.php';

//Establish variables names from form
$startStation = array($_POST['start_station']);
$time = $_POST['time'];
$endStation = array($_POST['end_station']);
$phone = $_POST['phone'];

$table = 'commuters';

//Get list of station names and abbriviations, returns array with names and abbr alternating
function getStationNames($apiKey){
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
function getAbbr($names, $apiKey){
	//print_r($names);
	$stationNameAbbrList = getStationNames($apiKey);
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

$startStation = getAbbr($startStation, $apiKey);
$endStation = getAbbr($endStation, $apiKey);
//print_r($startStation);
//print_r($endStation);
	
//Get all route numbers
$requestRouteNumbers = "http://api.bart.gov/api/route.aspx?cmd=routes&key=".$apiKey;
$xml_numbersList = simplexml_load_file($requestRouteNumbers) or die("feed not loading");
foreach($xml_numbersList->routes->route as $num){
	$routeNumbers[] = $num;
}
//Look through each route station list and keep the stations if $start and $end stations are included
foreach ($routeNumbers as $num){
	//Start with empty array each loop
	$fullStationList = array();
	$requestStationList = "http://api.bart.gov/api/route.aspx?cmd=routeinfo&route=".$num."&key=".$apiKey;
	//print $requestStationList;
	$xml_List = simplexml_load_file($requestStationList) or die("feed not loading");
	foreach($xml_List->routes->route->config->station as $station){
		$fullStationList[] = $station;	
	}
	//print 'Station list for route number '.$num.'<br/>';
	//print '<br/> The Starting station: '.$startStation[0].'<br/>';	
	$startKey = array_search($startStation[0], $fullStationList);
	//print '<br/>FOund start key: '.$startKey.'<br/>';
	if(is_int($startKey)){
		$endKey = array_search($endStation[0], $fullStationList);
		//print '<br/>Found end key: '.$endKey.'<br/>';
		//Figure out order of keys
		if(is_int($endKey)){
			if($endKey>$startKey){
				for($i=0;$i<=($endKey-$startKey);$i++){
					$commuterStations[] = $fullStationList[$i+$startKey];
					}
				//print_r($commuterStations);
				break;
				}
			elseif($startKey>$endKey){
				for($i=0;$i<=($startKey-$endKey);$i++){
					$commuterStations[] = $fullStationList[$i+$endKey];
					}
				//print_r($commuterStations);
				break;
				}
			}
		}
	}

	
//Establish query to insert data to MySQL table
$insert = "INSERT INTO $table VALUES ('','$start_station','$time','$end_station','$phone', '$commuterStations')";

//Insert the data
mysql_query($insert);

mysql_close();
?>

<!DOCTYPE html>

<html>

	<head>
		<meta charset="utf-8" />
		<title>Late BART Alert</title>
		<!--[if IE]>
		<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
		<!--<LINK REL=StyleSheet HREF="html5Reset.css" TYPE="text/css" MEDIA=screen>-->
		<LINK REL=StyleSheet HREF="lateBartStyle.css" TYPE="text/css" MEDIA=screen>
		
	
	</head>
	
<body>
	
	
	<header>
	<div id="hat">
	</div><!--/hat-->
	
	<div id="head">
		<div id="tagline">
			Late BART Alert will send you a text message if your train is going to be late. Sign up now to join our beta.
		</div><!--/tagline-->
	
		<div id="title">
			<a href="http://www.latebartalert.com"><img src="lateBartAlertLogoWhiteBG.original.png" alt="" /></a>
		</div><!--/title-->
	
	</div><!--/head-->		
	</header>
	
	<div id="sectionBackground">
	<section id="lateTrainAlert" style="height:600px">
	
	Awesome. We'll send you a text, email, or tweet whenever the train from
	<?php 
		echo $startStation[0] . "leaving around" . $time . "headed towards" . $endStation[0] . "is late";
		echo '<h1>'.$apiKey.'</h1>';
		?>	
	 If you want to sign up for another train, maybe for your evening commute, then click <a href="http://www.latebartalert.com">here</a>.	
	</section>

	</div><!--/sectonBackground-->

	<footer>
		Late Bart is in still in Beta testing. It is being built by Andrew Hyder, a <a href="http://hackyourcity.com">City Hacker</a> from San Francisco.
	</footer>
	</div><!--/footerBackground-->

</body>
</html>