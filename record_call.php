<?php

include_once('connection.php');

 $recording_url = $_REQUEST['RecordingUrl'];

 $rowid = $_REQUEST['id'];

$update = mysqli_query($con,"update tapp_voice_broadcast_logs set recording_url='".$recording_url."' where id='".$rowid."'");

?>