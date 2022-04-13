<?php

defined('BASEPATH') OR exit('No direct script access allowed');
use Twilio\Rest\Client;


class Bulk_call extends CI_Controller {
	public function start_call(){	
		$this->load->model('Pending_callsModel');
		$result = $this->Pending_callsModel->start();
		print_r($result);
	}

	public function record(){
		$agent_number = 000000;
		$sql1 = $this->db->query("INSERT INTO tapp_voice_broadcast_logs(twilio_number,user_number,voice_file,agent_number,is_called,date_time) VALUES ('".$_REQUEST['From']."','".$_REQUEST['To']."','".$_REQUEST['RecordingUrl']."','".$agent_number."','no',now())"); 
	}

	public function gather($voice_file){
		header('Content-type: text/xml');
		$media_file = str_replace(' ','',$voice_file);
		?>
		<Response>
			<Gather action="<?php echo base_url() ?>process_gather" method="GET">
				<Play loop="1"><?php echo base_url().'voice_upload/'.$media_file ?></Play>
			</Gather>
			<Say>We didn't receive any input. Goodbye!</Say>
		</Response>
	<?php  }

  public function process_gather1()
  {
	header('Content-type: text/xml');  ?>
	<Response>
	<?php
		if (!empty($_SESSION['input'])) {
			$_SESSION['input'] .= ','.$_REQUEST['Digits'];
		}
		else{
			$_SESSION['input'] = $_REQUEST['Digits'];
		}
		$sql = $this->db->query("SELECT * FROM ivr_data WHERE user_input = '".$_REQUEST['Digits']."'");
		if ($sql->num_rows()>0) {
		foreach($sql->result() as $row) { ?>
		<Gather action='<?php echo base_url() ?>process_gather' method='GET'>
		<?php
			$explode = explode('.',$row->response);
			$ext = end($explode);
			if ($ext=='mp3') { ?>
			<Play><?php echo $row->response ?></Play>
		<?php }
			else{ ?>
			<Say><?php echo $row->response ?></Say>
		<?php	}	?>
		</Gather>
		<?php }  
		}
		else{ ?>
			<Say>You entered <?php echo $_REQUEST['Digits'] ?> But This is Invalid </Say>
			<Gather action='<?php echo base_url() ?>process_gather' method='GET'>
				<Say>Please press any key from 1 to 5 </Say>
			</Gather>
		<?php } ?>
		<Say>We didn't receive any input. Goodbye!</Say>
	</Response>
	<?php
  }

  public function process_gather()
  {  
	echo `<?xml version="1.0" encoding="UTF-8"?>`;
	
		if (!empty($_SESSION['input'])) {
			$_SESSION['input'] .= ','.$_REQUEST['Digits'];
		}
		else{
			$_SESSION['input'] = $_REQUEST['Digits'];
		}
		$sql = $this->db->query("SELECT * FROM ivr_data WHERE user_input = '".$_REQUEST['Digits']."'");
		if ($sql->num_rows()>0) {
		foreach($sql->result() as $row) { ?>
			<Response>
   	<Dial callerId="<?php echo $_REQUEST['From']; ?>">
        <?php echo $row->response; ?>
	</Dial>
		</Response>
		<?php }  
		}
		else{ ?>
			<Response>

			<Gather action='<?php echo base_url() ?>process_gather' method='GET'>
			<Say>You entered <?php echo $_REQUEST['Digits'] ?> But This is Invalid </Say>
			</Gather>
			</Response>
		<?php } ?>
	
	<?php
  }
}
?>

