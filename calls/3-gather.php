<?php
// Create a route that will handle Twilio Gather verb action requests,
// sent as an HTTP POST to /gather in our application
/* require_once 'vendor/autoload.php'; */
require_once'../twilio-php-master/Services/Twilio.php';

use ../twilio-php-master/Twilio/TwiML;

// Use the Twilio PHP SDK to build an XML response 
$response = new Twiml();

// If the user entered digits, process their request
if (array_key_exists('Digits', $_POST)) {
    switch ($_POST['Digits']) {
    case 1:
        $response->say('You selected to take the survey. Thank you!');
        break;
    case 2:
        $response->say('You selected to hear a joke! Why did the robot cross the road? Because it was carbon bonded to the chicken!');
        break;
    default:
        $response->say('Sorry, I don\'t understand that choice.');
        $response->redirect('http://virtuemantra.com/twilapp/calls/2-call-answered.php');
    }
} else {
    // If no input was sent, redirect to the /voice route
    $response->redirect('http://virtuemantra.com/twilapp/calls/2-call-answered.php');
}

// Render the response as XML in reply to the webhook request
header('Content-Type: text/xml');
echo $response;