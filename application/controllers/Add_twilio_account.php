<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Add_twilio_account extends CI_Controller {



		function __construct(){

			parent::__construct();

			if (!isset($_SESSION['logged_in'])) {

				header('Location: '.base_url().'Login');

			}

			$this->load->model('Add_twilio_accountModel');

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

		$result['data_user'] = $this->User_listModel->get();

		$result['data'] = $this->Add_twilio_accountModel->get();

		$this->load->view('add_twilio_account',$result);

	}

	public function gettype(){

		$result = $this->Add_twilio_accountModel->get();

		echo json_encode($result);

	}

	public function edit(){

	$result = $this->Add_twilio_accountModel->edit();

	if ($result) {

		$_SESSION['update'] = '1';

	}

	else{

		$_SESSION['update'] = '0';

	}



	redirect(base_url().'Add_Account');

	}

	public function delete()
	{
	$result = $this->Add_twilio_accountModel->delete();
	if ($result) 
	{
	$_SESSION['delete'] = '1';
	}
	else
	{
	$_SESSION['delete'] = '0';
	}
	redirect(base_url().'Add_Account');
	}

	public function add()
	{
	$result = $this->Add_twilio_accountModel->add();
	if ($result) {
	$_SESSION['add_acc'] = 'Data added successfully';
	}
		redirect(base_url().'Add_Account');
	}

	public function getuser()
	{
	$this->load->model('User_listModel');
	$result = $this->User_listModel->getuser();
	echo json_encode($result);
	}
}

?>