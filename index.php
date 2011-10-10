<?php
include 'sqlConnect.php';
include_once 'fifteenMinutes.php';

//Access the BART API and get the full station list
$requestStationList = "http://api.bart.gov/api/stn.aspx?cmd=stns&key=".$apiKey;
$xml_stationList = simplexml_load_file($requestStationList) or die("feed not loading");

//List stations as dropdown menu
function listStations($xml){
	for($i=0;$i<sizeof($xml->stations->station);$i++){
		echo "<option value=".'"'.$xml->stations->station[$i]->name.'"'.">";
		echo $xml->stations->station[$i]->name;
		echo "</option>";
	}
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
		<title>Late BART</title>
		<!--[if IE]>
		<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
		<!--<LINK REL=StyleSheet HREF="html5Reset.css" TYPE="text/css" MEDIA=screen>-->
		<link rel="stylesheet" href="http://twitter.github.com/bootstrap/1.3.0/bootstrap.min.css">
		<!--<LINK REL=StyleSheet HREF="lateBartStyle.css" TYPE="text/css" MEDIA=screen>-->
		
	
	</head>
	
<body>
	<header>
		<div class="topbar">
			<div class="fill">
				<div class="container">
					<a class="brand" href="#">Late BART</a>
					<ul class="nav">
					<li class="active"><a href="#">Home</a></li>
					<li><a href="#about">About</a></li>
					<li><a href="#contact">Contact</a></li>
					</ul>
				</div>
			</div>
		</div>		
	</header>
	
	<section>
		<div class="container">
		  <div class="hero-unit">
			<h1>Late BART</h1>
			<p>Late BART will send you a text message if your train is going to be late.</p>
		  </div>
		
			<div class="row">
				<div class="span10 offset3">
					<form method="post" action="handleForm.php">
						<fieldset>
							<h2>Which Train Do you Catch?</h2>
							<label for="startStation">Station you start at:</label>
							<select name="startStation" required>
								<?php
								listStations($xml_stationList);
								?>
							</select>
							<label>What time do you catch your train?</label>
							<select name="time" placeholder="Best guess is cool" type="text" />
								<?php
								fifteenMinutes();
								?>		
							</select>
							<label for="endStation">Station you end at:</label>
							<select name="endStation" required>
								<?php
								listStations($xml_stationList);
								?>
							</select>
							<label>Phone number:</label>
							<input type="submit" class="btn primary" value="Sign Up">
						</fieldset>
					</form>
				</div>
			</div>
	</section>

	<footer>
		<div class="row">
			<div class="span10 offset3">
				Late Bart Alert is in still in Beta testing. It is being built by Andrew Hyder, an <a href="http://hackyourcity.com">Urban Hacker</a> from San Francisco.
			</div>
		</div>
	</footer>

</body>
</html>
