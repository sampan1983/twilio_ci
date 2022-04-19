<?php

defined('BASEPATH') OR exit('No direct script access allowed');

use Twilio\Rest\Client;

class Single_message extends CI_Controller {



	function __construct(){

			parent::__construct();

			if (!isset($_SESSION['logged_in'])) {

				header('Location: '.base_url().'Login');

			}


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

		$result['data'] = $this->User_listModel->get();

				$this->load->model('ClientModel');

		$result['contact'] = $this->ClientModel->get();

					$this->load->model('Bulk_smsModel');

		$result['tapp_template_msg'] = $this->Bulk_smsModel->tapp_template_msg();

		$this->load->view('single_message',$result);



	}

	// public function getcontact(){

	// 	$this->load->model('ClientModel');

	// 	$result = $this->ClientModel->get();

	// 	echo json_encode($result);

	// }



	public function getnum($id){

		$this->load->model('ClientModel');

		$result = $this->ClientModel->getnum($id);

		echo json_encode($result);

	}



	public function getmsg(){
		// require base_url().'vendor/autoload.php';
		$this->load->model('Single_messageModel');
		$result = $this->Single_messageModel->getmsg();
		echo json_encode($result);

	}

	public function gettwilionum()
	{
		   $val=$this->input->post('val');
		$this->load->model('Single_messageModel');
		$result = $this->Single_messageModel->gettwilionum($val);
		echo json_encode($result);

	}

}

?>

