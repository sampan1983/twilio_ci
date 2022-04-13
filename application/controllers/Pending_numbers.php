<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Pending_numbers extends CI_Controller {

	function __construct(){

			parent::__construct();

			if (!isset($_SESSION['logged_in'])) {

				header('Location: '.base_url().'Login');

			}
		$this->load->model('Pending_numbersModel');


		}

	public function index(){
		
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

		$this->load->model('Pending_numbersModel');

		$result['pmsg'] = $this->Pending_numbersModel->getpending();

		$this->load->view('pending_numbers',$result);

	}

	public function Queued(){
				
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

		$this->load->model('Pending_numbersModel');

		$result['pmsg'] = $this->Pending_numbersModel->getpending();
		$result['qmsg'] = $this->db->get('queued_msg');
		$this->load->view('queued',$result);

	}
	public function delete($id){

		$this->load->model('Pending_numbersModel');

		$result = $this->Pending_numbersModel->delete($id);

		echo json_encode($result);

	}
	public function sentpendingmsg()
	{
	$result = $this->Pending_numbersModel->sentpendingmsg();
	print_r($result);
	}



}

?>

