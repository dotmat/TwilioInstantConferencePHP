<?php

// Incoming Voice number thats paired with this setup – used for voice Conferences etc.
$voiceNumber = “+1…”;

// Get the Variables from the HTTP POST, We want to know the BODY and the FROM so we can authorise and action the request.

$fromPhoneNumber = $_POST["From"];
$messageBody = $_POST["Body"];

// Check the phone number is on our authorised list if so action the SMS request.

// As this grows you want to put the numbers into an authorised DB and make a DB request regarding this.
// As this minute we are just going to look up against authorised number just in the IF field.

if ($fromPhoneNumber == “+1…” or “+44…”) // This is the list of authorised numbers that can make conf rooms.
{
// If the number is authorised then we are going to look at the body for what we need to make / do.

if ($messageBody == “Conference” or “Conf”)
{
// If the body is Conference we want to generate a 4 digit pin number and then generate a SMS message that can be
// forwarded out to the participants.

// The idea is that this script will reply with
// “A Conference has been setup, please call XYZ Number and enter pin 1234”

$confPin = rand(1000, 9999); // Generate a random pin number
$TwiMLResponse = “<Message>Conference Room Details:\r\nPhone Number: ” . $voiceNumber . “\r\nConference Pin: ” . $confPin. “</Message>”;
}
else // Catch all for whats left.
{
$TwiMLResponse = “<Message>Sorry, Me No understand. Try Again.</Message>”;
}
}
else
{
$TwiMLResponse = “<Message>Sorry, Your not authorised for this.</Message>”;
}
header(“content-type: text/xml”);
?>

<Response><?php echo $TwiMLResponse; ?></Response>
