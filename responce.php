<?php



header('Content-type: text/xml');







 include("connection.php");











    $explode = explode('#',($_REQUEST['PhoneNumber']));



    $number =$explode[0];



    $callerId = $explode[1];







if (preg_match("/^[\d\+\-\(\) ]+$/", $number)) {



    $numberOrClient = "<Number>" . $number . "</Number>";



 } else {



    $numberOrClient = "<Client>" . $number . "</Client>";



 }



$user_number = str_replace('+','',$number);



 $voice_file ='';



 $agent_number ='';



 $caller_id = str_replace('+','',$callerId);



 $callerId1 = substr($caller_id, 1);



 $callerId12 = substr($callerId, 1);



 







  $sql1 = mysqli_query($con,"INSERT INTO tapp_voice_broadcast_logs(twilio_number,user_number,voice_file,agent_number,is_called,date_time) VALUES ('".$caller_id."','".$user_number."','". $voice_file."','".$agent_number."','yes',now())");



$id = $con->insert_id;



?>







<Response>



  <Dial callerId="<?php echo  $caller_id;?>" record="record-from-answer"



          recordingStatusCallback="https://myofferid.com/record_call.php?id=<?php echo $id;?>">



        <?php echo $numberOrClient ?>



    



    </Dial>



	



</Response>















