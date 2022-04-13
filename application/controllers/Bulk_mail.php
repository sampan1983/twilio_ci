<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Bulk_mail extends CI_Controller {

	function __construct(){

			parent::__construct();

			if (!isset($_SESSION['logged_in'])) {

				header('Location: '.base_url().'Login');

			}

			$this->load->model('Bulk_mailModel');

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

		$result['data'] = $this->User_listModel->get();

		$this->load->model('ClientModel');

		$result['clientdata'] = $this->ClientModel->get();

		$this->load->model('Add_group_numbersModel');

		$result['getgroup'] = $this->Add_group_numbersModel->getgroup();

				$this->load->model('Bulk_smsModel');

		$result['tapp_template_msg'] = $this->Bulk_smsModel->tapp_template_msg();

		$this->load->view('bulk_mail', $result);

	}


	public function send_bulk()
	{
					$this->load->model('Bulk_mailModel');
		$result = $this->Bulk_mailModel->send_bulk();
		print_r($result);
		redirect(base_url().'Bulk_mail');

	}


}

?>