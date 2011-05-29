<?php
//Access the BART API and get the full station list
$requestStationList = "http://api.bart.gov/api/stn.aspx?cmd=stns&key=EHDB-ZWQN-EKXT-VV5D";
$xml_stationList = simplexml_load_file($requestStationList) or die("feed not loading");

//List stations as dropdown menu
function listStations($xml){
	for($i=0;$i<sizeof($xml->stations->station);$i++){
		echo "<option value=".$xml->stations->station[$i]->name.">";
		echo $xml->stations->station[$i]->name;
		echo "</option>";
	}
}
?>

<!DOCTYPE html>

<html>

	<head>
		<meta charset="utf-8" />
		<title>Text Me If My BART Is Late</title>
		<!--[if IE]>
		<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
		<!--<LINK REL=StyleSheet HREF="html5Reset.css" TYPE="text/css" MEDIA=screen>-->
		<LINK REL=StyleSheet HREF="trapprStyle.css" TYPE="text/css" MEDIA=screen>
		
	
	</head>
	
<body>
	
	
	<header>
	<div id="header">
	<div id="hat">
	</div><!--/hat-->
	
	<div id="head">
		<div id="tagline">
			Late Bart Alert will send you a text message if <i>your</i> train is going to be late.
		</div><!--/tagline-->
	
		<div id="title">
			<a href="http://textmeifmybartislate.us"><img src="lateBartAlertLogoWhiteBG.original.png" alt="" /></a>
		</div><!--/title-->
	
	</div><!--/head-->
	</div><!--/header-->		
	</header>
	
	<div id="sectionBackground">
	<section>
	<div id="section">
	
		<form method="post" action="handleForm.php">
			<fieldset>
			<legend>Which Train Do you Catch?</legend>
			<ol>	
				<li>
				<label>Station you start at:</label> 
				<select name="startStation" required>
					<?php
					listStations($xml_stationList);
					?>
				</select>
				</li>
				
				<li>	
				<label>What time do you catch your train?</label>
				<select name="time" placeholder="08:30am" type="text" />
					<option value="6:00am">6:00am</option>
					<option value="6:15am">6:15am</option>
					<option value="6:30am">6:30am</option>
					<option value="6:45am">6:45am</option>
					<option value="7:00am">7:00am</option>
					<option value="7:15am">7:15am</option>
					<option value="6:15am">6:15am</option>
					<option value="6:30am">6:30am</option>
					<option value="6:45am">6:45am</option>
					<option value="7:00am">7:00am</option>
				</select>
				<span class="note">Best guess is cool</span><br />
				</li>
				
				<li>	
				<label for="endStation">Station you end at:</label>
				<select name="endStation" required>
					<?php
					listStations($xml_stationList);
					?>
				</select>
				</li>
				<!--
				<li>
				<label>E-mail:</label>
				<input type="email" name="email" placeholder="NeverLate@ToWork.com" />
				<span class="note">If you want us to email you.</span>
				</li>
				-->
				<li>
				<label>Phone number and carrier:</label>
				<input type="text" name="phone" placeholder="415-555-5555" /> <br />
				<select id="carrierBox" name="carrier">
					<option value="att">ATT</option>
					<option value="sprint">Sprint</option>
					<option value="verizon">Verizon</option>
					<option value="tmobile">T-Mobile</option>
					<option value="metropcs">Metro PCS</option>
				</select>
				<span class="note">So that we can text you</span>
				</li>
				<!--
				<li>
				<label>Twitter: @</label>
				<input type="text" name="twitter" placeholder="AlwaysOnTime">
				<span class="note">If you want us to tweet you</span>
				</li>
				-->
				<li class="submit">
				<input type="submit" value="Sign Up" />
				</li>
			
			</ol>
			</fieldset>
		</form>
		</div><!--/section-->
	</section>
	</div><!--/sectonBackground-->

	<footer>
	<div id="footer">
		Late Bart is in still in Beta testing. It is being built by Andrew Hyder, an <a href="http://hackyourcity.com">Urban Hacker</a> from San Francisco.
	</div><!--footer-->
	</footer>
	</div><!--/footerBackground-->

</body>
</html>