<?php

// Check to see if a Conf Pin has been inputted. If so, make a Conf room with that pin.
$confPin = $_GET["Digits"];

// If no conf Pin ask the caller to enter a Conf pin or else hangup.
if (isset($confPin)){
$TwiMLResponse = “<Say voice=\”alice\”>Placing You into Conference Now.</Say><Dial><Conference>”. $confPin .”</Conference></Dial>”;
}
else
{
$TwiMLResponse = “<Gather method=\”GET\” timeout=\”25\” numDigits=\”4\”><Say voice=\”alice\”>Hello and welcome to the conference line. Please enter the Conference Pin.</Say></Gather><Say>I’m Sorry I didnt catch that</Say>”;

}

header(“content-type: text/xml”);
?>

<Response><?php echo $TwiMLResponse; ?></Response>
