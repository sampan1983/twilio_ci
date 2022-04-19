<?php

defined('BASEPATH') OR exit('No direct script access allowed');
use Twilio\Rest\Client;


class Voice_broadcast extends CI_Controller {

		function __construct(){

			parent::__construct();

			if (!isset($_SESSION['logged_in'])) {

				header('Location: '.base_url().'Login');

			}
	
			$this->load->model('Voice_broadcastModel');

		}

	public function index()
	{			
		$this->load->model('User_listModel');

		$result['data_user'] = $this->User_listModel->get();

		$this->load->model('ClientModel');

		$result['data'] = $this->ClientModel->get();

		$this->load->model('Single_messageModel');

		$result['sent_msg_log'] = $this->Single_messageModel->sentmsglog();

		$this->load->model('Failed_numbersModel');

		$result['failed_numbers'] = $this->Failed_numbersModel->failedmsglog();

		$this->load->model('Pending_numbersModel');

		$result['pending_numbers'] = $this->Pending_numbersModel->pendingmsglog();

		$this->load->model('Received_messages_newModel');

		$result['Received_messages_new'] = $this->Received_messages_newModel->receivedmsglog();
		$this->load->model('Received_messages_newModel');

		$result['Received_messages_new'] = $this->Received_messages_newModel->receivedmsglog();

		$this->load->model('User_listModel');
				$this->load->model('ClientModel');

		$result['clientdata'] = $this->ClientModel->get();

		$this->load->model('Add_group_numbersModel');

		$result['getgroup'] = $this->Add_group_numbersModel->getgroup();

		$result['data_user'] = $this->User_listModel->get();

			$result['data'] = $this->Voice_broadcastModel->getnum();

		$this->load->view('voice_broadcast',$result);

	}

	public function get_voice_broadcast(){
		$twilio_number = $_POST['twilio_number'];
		$agent_number = $_POST['agent_number'].'<br>';
		$result = $this->Voice_broadcastModel->get_voice_broadcast();
		if ($result) {
			$get_num = $this->db->get_where("tapp_voice_broadcast",array("readyToCall"=>'ready'));
			if ($get_num->num_rows()>0) {
				$get_sid =	$get_num->result_array();	
				foreach ($get_num->result() as $get_sid) { 
					$from = $get_sid->twilio_number;  ///twilio number
					echo $to = $get_sid->user_number;   ///reciever 
					$url = $get_sid->voice_file;
					$user_id1 = $get_sid->user_id;
					$get_service_type = $this->db->get_where("tapp_twilio_number",array("number" => $from, "user_id" => $user_id1));
					if ($get_service_type->num_rows()>0) {
					$get_service = $get_service_type->result_array(); 
					$service_type = $get_service[0]['service_type']; ///service type
					$get_twilio = $this->db->query("select * from tapp_twilio_account where user_id = '".$user_id1."' and service_type = '$service_type'");
					if ($get_twilio->num_rows()>0) {
					$get_acc = $get_twilio->result_array();
					$sid = $get_acc[0]['twilio_sid'];   /////twilio sid
					$token = $get_acc[0]['twilio_token'];  ////twilio token
					}
					$AccountSid = $sid;
					$AuthToken = $token;
					$Client = new Client($AccountSid,$AuthToken);
					try
					{
					$get_num = $this->db->query("select * from tapp_voice_broadcast order by date_time");
					if ($get_num->num_rows()>0) 
					{
						$get_sid =	$get_num->result_array();			
						for ($i=0; $i <sizeof($get_sid) ; $i++) 
						{
						$user_id = $get_sid[$i]['user_id']; 				
						$id = $get_sid[$i]['id'];
						$from = $get_sid[$i]['twilio_number'];  ///twilio number
						$to = $get_sid[$i]['user_number'];   ///reciever 
						$url = $get_sid[$i]['voice_file'];
						$Client->account->calls->create( $to,
														$from,
														array(
															"record"=>True,
															'url' => base_url()."/gather/".$url,
														"method" => "GET",
														"statusCallback" => base_url()."record",
														"statusCallbackMethod" => "POST"
														)
														);

					$sql1 = $this->db->query("INSERT INTO tapp_voice_broadcast_logs(twilio_number,user_number,voice_file,is_called,date_time,user_id) VALUES ('".$from."','".$to."','".$url."','no',now(),'".$user_id."')");
					if ($sql1) 
					{
						$delete = $this->db->query("delete from tapp_voice_broadcast where id='".$id."'");
					}
					}
					}
					}
					catch(Exception $e)
					{
						echo "delete from tapp_voice_broadcast where id='".$id."'";
					echo $e;
						$delete = $this->db->query("delete from tapp_voice_broadcast where id='".$id."'");
					// $file = fopen('call_bulk', 'w');
					// fwrite($file, $e);
					// fclose($file);
					}

				}
	}
		}
		else{
		}
		}
		redirect('Voice_broadcast');

}
}



// 		if(isset($_FILES["file1"]["name"]) )

// {

//    $temp = explode(".", $_FILES["file1"]["name"]);



//   $target_dir =  base_url();



//     if(end($temp) == 'mp3' || end($temp) == '.mp3')

//    { 

// $new_filename = round(microtime(true)) . '.' . end($temp);

// move_uploaded_file($_FILES["file1"]["tmp_name"], "voice_upload/" . $new_filename);

// $mediaUrl = $target_dir.'voice_upload/'.$new_filename;

//   }

//     else{

// 	   $_SESSION['failure_message_invalid'] = 'Invalid File Format For Audio File';

// 	    // header('Location: '.base_url().'Voice_broadcast');

// 	   die();

//    } 

// }

// else{

// 		$_SESSION['xlsx_error'] = 'Please add audio file';

// 		echo 'No contact file found';



// }		





	


?>




