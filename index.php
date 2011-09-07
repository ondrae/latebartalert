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
					<option value="4:00am">4:00am</option>
					<option value="4:15am">4:15am</option>
					<option value="4:30am">4:30am</option>
					<option value="4:45am">4:45am</option>
					<option value="5:00am">5:00am</option>
					<option value="5:15am">5:15am</option>
					<option value="5:30am">5:30am</option>
					<option value="5:45am">5:45am</option>
					<option value="6:00am">6:00am</option>
					<option value="6:15am">6:15am</option>
					<option value="6:30am">6:30am</option>
					<option value="6:45am">6:45am</option>
					<option value="7:00am">7:00am</option>
					<option value="7:15am">7:15am</option>
					<option value="7:30am">7:30am</option>
					<option value="7:45am">7:45am</option>
					<option value="8:00am">8:00am</option>
					<option value="8:15am">8:15am</option>
					<option value="8:30am">8:30am</option>
					<option value="8:45am">8:45am</option>
					<option value="9:00am">9:00am</option>
					<option value="9:15am">9:15am</option>
					<option value="9:30am">9:30am</option>
					<option value="9:45am">9:45am</option>
					<option value="10:00am">10:00am</option>
					<option value="10:15am">10:15am</option>
					<option value="10:30am">10:30am</option>
					<option value="10:45am">10:45am</option>
					<option value="11:00am">11:00am</option>
					<option value="11:15am">11:15am</option>
					<option value="11:30am">11:30am</option>
					<option value="11:45am">11:45am</option>
					<option value="12:00pm">12:00pm</option>
					<option value="12:15pm">12:15pm</option>
					<option value="12:30pm">12:30pm</option>
					<option value="12:45pm">12:45pm</option>
					<option value="1:00pm">1:00pm</option>
					<option value="1:15pm">1:15pm</option>
					<option value="1:30pm">1:30pm</option>
					<option value="1:45pm">1:45pm</option>
					<option value="2:00pm">2:00pm</option>
					<option value="2:15pm">2:15pm</option>
					<option value="2:30pm">2:30pm</option>
					<option value="2:45pm">2:45pm</option>
					<option value="3:00pm">3:00pm</option>
					<option value="3:45pm">3:45pm</option>
					<option value="4:00pm">4:00pm</option>
					<option value="4:15pm">4:15pm</option>
					<option value="4:30pm">4:30pm</option>
					<option value="4:45pm">4:45pm</option>
					<option value="5:00pm">5:00pm</option>
					<option value="5:15pm">5:15pm</option>
					<option value="5:30pm">5:30pm</option>
					<option value="5:45pm">5:45pm</option>
					<option value="6:00pm">6:00pm</option>
					<option value="6:15pm">6:15pm</option>
					<option value="6:30pm">6:30pm</option>
					<option value="6:45pm">6:45pm</option>
					<option value="7:00pm">7:00pm</option>
					<option value="7:15pm">7:15pm</option>
					<option value="7:30pm">7:30pm</option>
					<option value="7:45pm">7:45pm</option>
					<option value="8:00pm">8:00pm</option>
					<option value="8:15pm">8:15pm</option>
					<option value="8:30pm">8:30pm</option>
					<option value="8:45pm">8:45pm</option>
					<option value="9:00pm">9:00pm</option>
					<option value="9:15pm">9:15pm</option>
					<option value="9:30pm">9:30pm</option>
					<option value="9:45pm">9:45pm</option>
					<option value="10:00pm">10:00pm</option>
					<option value="10:15pm">10:15pm</option>
					<option value="10:30pm">10:30pm</option>
					<option value="10:45pm">10:45pm</option>
					<option value="11:00pm">11:00pm</option>
					<option value="11:15pm">11:15pm</option>
					<option value="11:30pm">11:30pm</option>
					<option value="11:45pm">11:45pm</option>
					<option value="12:00am">12:00am</option>
					<option value="12:15am">12:15am</option>
					<option value="12:30am">12:30am</option>
					
					
					
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
