<?php
include 'sqlConnect.php';

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
		<LINK REL=StyleSheet HREF="lateBartStyle.css">
		
	
	</head>
	
<body>
	<header>
		<div class="topbar">
			<div class="fill">
				<div class="container">
					<a class="brand" href="#"><img src="lateBartLogo.png"></a>
				</div>
			</div>
		</div>		
	</header>
	
	<section>
	<div class="container" style="background:url(watchBG.png) bottom right no-repeat;">
	<div class="hero-unit">
		<h1>Never be late to work again.</h1>
		<p>Sign up below to receive a text message whenever <i>your</i> train is going to be late.</p>
	</div>
	
	<div class="row">
		<div class="span10">
			<form class="form-stacked" method="post" action="handleForm.php">
				<fieldset>
					<h2>Which Train Do you Catch?</h2>
					<label for="startStation">Station you start at:</label>
					<select name="startStation" required class="span8">
						<?php
						listStations($xml_stationList);
						?>
					</select>
					<label>What time do you catch your train?</label>
					<select name="time" placeholder="Best guess is cool" type="text" class="span8">
						<option value="4:00 am">4:00 am</option>
						<option value="4:15 am">4:15 am</option>
						<option value="4:30 am">4:30 am</option>
						<option value="4:45 am">4:45 am</option>
						<option value="5:00 am">5:00 am</option>
						<option value="5:15 am">5:15 am</option>
						<option value="5:30 am">5:30 am</option>
						<option value="5:45 am">5:45 am</option>
						<option value="6:00 am">6:00 am</option>
						<option value="6:15 am">6:15 am</option>
						<option value="6:30 am">6:30 am</option>
						<option value="6:45 am">6:45 am</option>
						<option value="7:00 am">7:00 am</option>
						<option value="7:15 am">7:15 am</option>
						<option value="7:30 am">7:30 am</option>
						<option value="7:45 am">7:45 am</option>
						<option value="8:00 am">8:00 am</option>
						<option value="8:15 am">8:15 am</option>
						<option value="8:30 am">8:30 am</option>
						<option value="8:45 am">8:45 am</option>
						<option value="9:00 am">9:00 am</option>
						<option value="9:15 am">9:15 am</option>
						<option value="9:30 am">9:30 am</option>
						<option value="9:45 am">9:45 am</option>
						<option value="10:00 am">10:00 am</option>
						<option value="10:15 am">10:15 am</option>
						<option value="10:30 am">10:30 am</option>
						<option value="10:45 am">10:45 am</option>
						<option value="11:00 am">11:00 am</option>
						<option value="11:15 am">11:15 am</option>
						<option value="11:30 am">11:30 am</option>
						<option value="11:45 am">11:45 am</option>
						<option value="12:00 pm">12:00 pm</option>
						<option value="12:15 pm">12:15 pm</option>
						<option value="12:30 pm">12:30 pm</option>
						<option value="12:45 pm">12:45 pm</option>
						<option value="1:00 pm">1:00 pm</option>
						<option value="1:15 pm">1:15 pm</option>
						<option value="1:30 pm">1:30 pm</option>
						<option value="1:45 pm">1:45 pm</option>
						<option value="2:00 pm">2:00 pm</option>
						<option value="2:15 pm">2:15 pm</option>
						<option value="2:30 pm">2:30 pm</option>
						<option value="2:45 pm">2:45 pm</option>
						<option value="3:00 pm">3:00 pm</option>
						<option value="3:45 pm">3:45 pm</option>
						<option value="4:00 pm">4:00 pm</option>
						<option value="4:15 pm">4:15 pm</option>
						<option value="4:30 pm">4:30 pm</option>
						<option value="4:45 pm">4:45 pm</option>
						<option value="5:00 pm">5:00 pm</option>
						<option value="5:15 pm">5:15 pm</option>
						<option value="5:30 pm">5:30 pm</option>
						<option value="5:45 pm">5:45 pm</option>
						<option value="6:00 pm">6:00 pm</option>
						<option value="6:15 pm">6:15 pm</option>
						<option value="6:30 pm">6:30 pm</option>
						<option value="6:45 pm">6:45 pm</option>
						<option value="7:00 pm">7:00 pm</option>
						<option value="7:15 pm">7:15 pm</option>
						<option value="7:30 pm">7:30 pm</option>
						<option value="7:45 pm">7:45 pm</option>
						<option value="8:00 pm">8:00 pm</option>
						<option value="8:15 pm">8:15 pm</option>
						<option value="8:30 pm">8:30 pm</option>
						<option value="8:45 pm">8:45 pm</option>
						<option value="9:00 pm">9:00 pm</option>
						<option value="9:15 pm">9:15 pm</option>
						<option value="9:30 pm">9:30 pm</option>
						<option value="9:45 pm">9:45 pm</option>
						<option value="10:00 pm">10:00 pm</option>
						<option value="10:15 pm">10:15 pm</option>
						<option value="10:30 pm">10:30 pm</option>
						<option value="10:45 pm">10:45 pm</option>
						<option value="11:00 pm">11:00 pm</option>
						<option value="11:15 pm">11:15 pm</option>
						<option value="11:30 pm">11:30 pm</option>
						<option value="11:45 pm">11:45 pm</option>
						<option value="12:00 am">12:00 am</option>
						<option value="12:15 am">12:15 am</option>
						<option value="12:30 am">12:30 am</option>	
					</select>
					<label for="endStation">Station you end at:</label>
					<select name="endStation" required class="span8">
						<?php
						listStations($xml_stationList);
						?>
					</select>
					<label>Phone number:</label>
					<input type="text" class="xlarge" name="phone" placeholder="415-NOT-LATE" /> <br />
					<input type="submit" class="btn primary" value="Sign Up">
				</fieldset>
			</form>
		</div>
		</div>
	</div>
	</section>

	<footer>
		<div class="container">
		<div class="row">
			<div class="span10">
				Late Bart Alert is in still in Beta testing. It is being built by Andrew Hyder, an <a href="http://hackyourcity.com">Urban Hacker</a> from San Francisco.
			</div>
		</div>
		</div>
	</footer>

</body>
</html>
