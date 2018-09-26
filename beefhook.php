<?php

$i = 1;

while ($i < 12){

$SlackToken = "https://hooks.slack.com/services/YOUR_INCOMING_SLACK_TOKEN_HERE";
$SlackChannel = "#YOUR_SLACK_CHANNEL";

$cmd2 = "curl -s https://YOUR_BEEF_URL:3000/api/logs?token=YOUR_BEEF_API_KEY --insecure";

exec($cmd2,$output2);

$beefarray = array();

$beefarray = json_decode($output2[0], true);

$beefarray = $beefarray["logs"];

foreach($beefarray as $id){
if($id["type"] == "Zombie"){

$dateevent = strtotime($id["date"]);
$datenow = strtotime("now");

$datediff = $datenow - $dateevent;

if($datediff <= 5){

$message = ">*BeEF Hook!* ".$id["event"];

// Execute Slack Incoming Webhook
$cmd = 'curl -s -X POST --data-urlencode \'payload={"channel": "'.$SlackChannel.'", "username": "BeEFBot", "text": "'.$message.'", "icon_emoji": ":cow:"}\' '.$SlackToken.'';

echo $message;

exec($cmd);

}

}
}

sleep(5);

$i = $i + 1;

unset($cmd2);
unset($output2);
unset($beefarray);
unset($dateevent);
unset($datenow);
unset($datediff);
unset($message);
unset($cmd);

}
?>
