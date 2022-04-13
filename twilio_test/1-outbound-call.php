<?php
// Get the PHP helper library from https://twilio.com/docs/libraries/php
use Twilio\Rest\Client;
require_once "Twilio/autoload.php";
include_once('../connection.php');
$query_1  = mysqli_query($con,"select * from tapp_twilio_account where service_type =  'twilio'");
while($row_sid = mysqli_fetch_array($query_1))
{
	$sid = $row_sid['twilio_sid'];
	$token = $row_sid['twilio_token'];
}
$query  = mysqli_query($con,"select * from tapp_voice_broadcast where user_number <> ''");
while($row = mysqli_fetch_array($query))
{
	$id = str_replace('+','',$row['id']);
	$call_id = str_replace('+','',$row['twilio_number']);
	$user_number = str_replace('+','',$row['user_number']);
	$agent_number = str_replace('+','',$row['agent_number']);
	$voice_file = $row['voice_file'];
	$caller_id = '+'.$call_id;
	$user_number = '+'.$user_number;
	$agent_number = '+'.$agent_number;


$client = new Client($sid, $token);
include_once('get_dir.php');
$target_dir = get_dir();
$to = $user_number;
$from = $caller_id;
$url ='http://'.$_SERVER['SERVER_NAME'].$target_dir;
try{
	$check_blacklist = mysqli_query($con,"select * from tapp_blacklist where number like '%".$user_number."%'");
	if(mysqli_num_rows($check_blacklist)<1)
{
$call = $client->calls->create(
  $to,
  $from,
  array(
    "url" => $url."2-call-answered.php?voice_file=$voice_file"
  )
);

$sql1 = mysqli_query($con,"INSERT INTO tapp_voice_broadcast_logs(twilio_number,user_number,voice_file,agent_number,is_called,date_time) VALUES ('".$caller_id."','".$user_number."','".$voice_file."','".$agent_number."','no',now())");
if($sql1)
{
	$delete = mysqli_query($con,"delete from tapp_voice_broadcast where id='".$id."'");
}
}
else
{
	$delete = mysqli_query($con,"delete from tapp_voice_broadcast where id='".$id."'");
}
}
catch(Exception $e)
{
	$delete = mysqli_query($con,"delete from tapp_voice_broadcast where id='".$id."'");
}
}
?>