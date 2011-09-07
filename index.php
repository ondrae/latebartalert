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

function fifteenMinutes(){
	$minute = 0;
	$hour = 4;
	$merideim = 'am';
	$i = 00; //Midnight switch
	while ($merideim !='am' && $hour != 12 && $minute != 30){
	//Last train is 12:30am
		echo '<option value="'.$hour.':'.$minute.' '.$merideim.'">'.$hour.':'.$minute.' '.$merideim.'</option>';

		if ($minute == 45){
			$minute = 0;
			$hour = $hour + 1;
			if ($hour == 12 && $minute == 0){
				if ($i == 0){
					$merideim = 'pm';
					$i = 1;
				}
				else {
					$merideim = 'am';
				}
			}
		}
		else{
			$minute = $minute + 15;
		}
	}
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
	
		<div id="title">
			<a href="http://www.latebartalert.com"><img src="lateBartAlertLogoWhiteBG.original.png" alt="" /></a>
		</div><!--/title-->
	
		<div id="tagline">
			Late BART Alert will send you a text message if your train is going to be late. Sign up now to join our beta.
		</div><!--/tagline-->	
	
	</div><!--/head-->		
	</header>
	
	<div id="sectionBackground">
	<section>	
		<form method="post" action="handleForm.php">
			<fieldset>
			<h2>Which Train Do you Catch?</h2>
			<ol>	
				<li>
				<label for="startStation">Station you start at:</label> 
				<select name="startStation" required>
					<?php
					listStations($xml_stationList);
					?>
				</select>
				</li>
				
				<li>	
				<label>What time do you catch your train?</label>
				<select name="time" placeholder="Best guess is cool" type="text" />
					<?php
						fifteenMinutes();
					?>
				</select>
				</li>
				
				<li>	
				<label for="endStation">Station you end at:</label>
				<select name="endStation" required>
					<?php
					listStations($xml_stationList);
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
		Late Bart Alert is in still in Beta testing. It is being built by Andrew Hyder, an <a href="http://hackyourcity.com">Urban Hacker</a> from San Francisco.
	</footer>
	</div><!--/footerBackground-->

</body>
</html>
