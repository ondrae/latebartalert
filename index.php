<?php
include 'sqlConnect.php';

//Access the BART API and get the full station list
$requestStationList = "http://api.bart.gov/api/stn.aspx?cmd=stns&key=".$apiKey;
$xml_stationList = simplexml_load_file($requestStationList) or die("feed not loading");

//List stations as dropdown menu
function listStations($xml){
	$stationList[];
	for($i=0;$i<sizeof($xml->stations->station);$i++){
		array_push($stationList,"<option value=".$xml->stations->station[$i]->name.">");
		array_push($stationList,$xml->stations->station[$i]->name);
		array_push($stationList,"</option>");
	}
	return $stationList;
}

function echoArray($array){
	for($i=0;$i<=count($array);$i++){
		echo $array[$i];
		echo " ";
		}
	echo "<br />";	
	}

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
	<section>
	<h2>Which Train Do you Catch?</h2>
		<form method="post" action="handleForm.php">
			<fieldset>
			<ol>	
				<li>
				<label for="startStation">Station you start at:</label> 
				<select name="startStation" required>
					<?php
					$stationList = listStations($xml_stationList);
					echoArray($stationList);
					?>
				</select>
				</li>
				
				<li>	
				<label>What time do you catch your train?</label>
				<select name="time" placeholder="Best guess is cool" type="text" />
					<option value="6:00 am">6:00 am</option>
					<option value="6:15am">6:15 am</option>
					<option value="6:30am">6:30 am</option>
					<option value="6:45am">6:45am</option>
					<option value="7:00am">7:00am</option>
					<option value="7:15am">7:15am</option>
					<option value="6:15am">6:15am</option>
					<option value="6:30am">6:30am</option>
					<option value="6:45am">6:45am</option>
					<option value="7:00am">7:00am</option>
				</select>
				</li>
				
				<li>	
				<label for="endStation">Station you end at:</label>
				<select name="endStation" required>
					<?php
					$stationList = listStations($xml_stationList);
					echoArray($stationList);
					?>
				</select>
				</li>
			
				<li>
				<label>Phone number:</label>
				<input type="text" name="phone" placeholder="415-NOT-LATE" /> <br />					</li>
				
				<li class="submit">
				<input type="submit" value="Sign Up" />
				</li>
			
			</ol>
			</fieldset>
		</form>
	</section>
	</div><!--/sectonBackground-->

	<footer>
		Late Bart is in still in Beta testing. It is being built by Andrew Hyder, an <a href="http://hackyourcity.com">Urban Hacker</a> from San Francisco.
	</footer>
	</div><!--/footerBackground-->

</body>
</html>
