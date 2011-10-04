<?php
$contactInfo[] = '4153074175';
$alert = 'What, what!';
sendAlerts($alert, $contactInfo);

function sendAlerts($alert, $contactInfo){
	// Include the PHP TwilioRest library
	require "Services/Twilio.php";
	
	$AccountSid = 'ACfc1d0ccae37d58b8cc736b8e6bc2c695';
	$AuthToken = 'b67e2e97b2cc138e90471b9043f7a9b8';
	
	// Instantiate a new Twilio Rest Client
	$client = new Services_Twilio($AccountSid, $AuthToken);
	 
	/* Your Twilio Number or Outgoing Caller ID */
	$from= '4156250104';

	// Iterate over all our server admins
    foreach ($contectInfo as $to) {
        // Send a new outgoinging SMS by POST'ing to the SMS resource
        $client->account->sms_messages->create($from, $to, $alert);
    }
}
?>