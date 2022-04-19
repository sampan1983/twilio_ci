<?php
// Get the PHP helper library from https://twilio.com/docs/libraries/php
require_once 'vendor/autoload.php'; // Loads the library
use Twilio\Rest\Client;

// Your Account Sid and Auth Token from twilio.com/user/account
$sid = "ACc7030a326c4c8e32e29cd8500e585212";
$token = "93c464daee5042e7e7f92ec297f1422a";
$client = new Client($sid, $token);

$to = "+917983644795";
$from = "+18326391235";
try
{
$call = $client->calls->create(
  $to,
  $from,
  array(
  /* 'url'=>'http://virtuemantra.com/twilapp/3.mp3' */
     "url" => "http://virtuemantra.com/twilapp/2-call-answered.php" 
	
  )
  );
}
  catch(Exception $e)
{
echo "Error:". $e->getMessage();
}





// Create a route that will handle Twilio webhook requests, sent as an
// HTTP POST to /voice in our application


use Twilio\Twiml;

// Use the Twilio PHP SDK to build an XML response
$response = new Twiml();

// Use the <Gather> verb to collect user input
$gather = $response->gather(array('numDigits' => 1));
// use the <Say> verb to request input from the user
$gather->say('For sales, press 1. For support, press 2.');

// If the user doesn't enter input, loop
$response->redirect('/voice');

// Render the response as XML in reply to the webhook request
header('Content-Type: text/xml');
echo $response;
