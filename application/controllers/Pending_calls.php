<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Pending_calls extends CI_Controller {



		function __construct(){

			parent::__construct();

			if (!isset($_SESSION['logged_in'])) {

				header('Location: '.base_url().'Login');

			}

			$this->load->model('Pending_callsModel');

		}

	public function index()

	{	$this->load->model('User_listModel');

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

		$result['data_user'] = $this->User_listModel->get();

		$result['data'] =  $this->Pending_callsModel->get();

		$this->load->view('pending_calls',$result);

	}

	public function delete(){

		$result = $this->Pending_callsModel->delete();

		if ($result) {

			$_SESSION['delcall'] = '1';

		}

		else{

			$_SESSION['delcall'] = '0';

		}

		redirect(base_url().'Queued_Calls');

	}

	public function start(){
	$status =	$_REQUEST['status']; 
			$sql = $this->db->query("update tapp_voice_broadcast set readyToCall = '$status' where user_id = '".$_SESSION['id']."'");
			if ($sql) {
				$_SESSION['status'] = '1';
			}
			else{
				$_SESSION['status'] = '0';
			}
		redirect(base_url().'Queued_Calls');

	}

	public function startpendingcall(){

$result = $this->Pending_callsModel->startpendingcall();
	}



}

?>