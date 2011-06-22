<?php
include_once 'sqlConnect.php';
include_once 'cleanStationNames.php';

//Establish variables names from form
$startStation = $_POST['start_station'];
$time = $_POST['time'];
$endStation = $_POST['end_station'];
$phone = $_POST['phone'];

function get_commute_station_list($startStation, $endStation){
	//Figure out the list of stations the commuter will travel through.
	
	//Get all route numbers
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
	
	
	
	
	
	
	
	
	
	
	return $commute_station_list	
}

//Establish query to insert data to MySQL table
$insert = "INSERT INTO $table VALUES ('','$start_station','$time','$end_station','$phone', '$commute_station_list')";

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
	<section id="lateTrainAlert">
	
	Awesome. We'll send you a text, email, or tweet whenever the train from
	<?php 
		echo $startStation . "leaving around" . $time . "headed towards" . $endStation . "is late";
		?>	
	
	 If you want to sign up for another train, maybe for your evening commute, then click <a href="http://textmeifmybartislate.us">here</a>.	
	</section>

	</div><!--/sectonBackground-->

	<footer>
		Late Bart is in still in Beta testing. It is being built by Andrew Hyder, a <a href="http://hackyourcity.com">City Hacker</a> from San Francisco.
	</footer>
	</div><!--/footerBackground-->

</body>
</html>