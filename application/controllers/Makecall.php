<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Makecall extends CI_Controller {

	public function outgoing(){
		if (!empty($_REQUEST['PhoneNumber'])) {
		 $explode = explode('#',($_REQUEST['PhoneNumber']) );
		 $number = $explode[0];
		 $callerID = $explode[1];
		// }

		if (preg_match("/^[\d\+\-\(\) ]+$/", $number)) {
			$numberOrClient = "<Number>".$number."</Number>";
		}
		else{
			$numberOrClient = "<Client>".$number."</Client>";
		}

		$user_number = str_replace('+', '', $number);
		$voice_file = '';
		$recoding_ur = '';
		$agent_num = '';
		$caller_id = str_replace('+', '', $callerID); 
	}
		if(empty($_REQUEST['To'])) {

		?> 
<Response>
   	<Dial callerId="<?php echo $caller_id; ?>" record="record-from-answer" recordingStatusCallback= "https://emarketing.ecetek.com/smsapp/Makecall/record?to=<?php echo $number; ?>&amp;from=<?php echo $caller_id; ?>">
        <?php echo $numberOrClient; ?>
	</Dial>
</Response>
<?php 
}else { $to = substr($_REQUEST['To'],1); $from = substr($_REQUEST['From'],1); 
$sql = $this->db->query("SELECT * FROM tapp_twilio_number WHERE number='".$to."'");
$data = $sql->result_array();
foreach ($data as $key ) {
if(!empty($key['call_forward'])) 
{

}
// }

?>
	<Response>
   	<Dial callerId="<?php echo $from; ?>">
        <?php echo '16463966342'; ?>
	</Dial>
</Response>
<?php } }
}

	public function record() {
		$to = $_REQUEST['to'];
		$voice_file = '';
		$from = $_REQUEST['from'];
		$recording_url = $_REQUEST['RecordingUrl'];
 		$agent_num = '';
 		$get_user = $this->db->query("SELECT * FROM tapp_twilio_number where number = '".$from."'");
 		$data = $get_user->result_array();
 		foreach ($data as $key ) 
 		{
 		$user_id = $key['user_id'];
 		}
 		$sql = $this->db->query("insert into tapp_voice_broadcast_logs(twilio_number,user_number,voice_file,recording_url,agent_number,is_called,date_time,user_id)values('$from','$to','$voice_file','$recording_url','agent_num','yes',now(),'$user_id')");
 		// $query = $this->db->query("update tapp_voice_broadcast_logs set recording_url = '$recording_url' where id = '$id'");
	}	
}
?>