<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Add_twilio_number extends CI_Controller {



		function __construct(){

			parent::__construct();

			if (!isset($_SESSION['logged_in'])) {

				header('Location: '.base_url().'Login');

			}

			$this->load->model('Add_twilio_numberModel');



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

		$result['twilio_numbers'] = $this->Add_twilio_numberModel->gettwilionum();
		$result['sid'] = $this->Add_twilio_numberModel->gettype();

		$this->load->view('add_twilio_number',$result);

	}

	public function addnum(){

		$result = $this->Add_twilio_numberModel->addnum();

		echo json_encode($result);

	}

	public function delete(){

				$result = $this->Add_twilio_numberModel->delete();

		echo json_encode($result);

	}

	public function gettype(){

		$result = $this->Add_twilio_numberModel->gettype();

		echo json_encode($result);

	}

	public function edit(){

		$result = $this->Add_twilio_numberModel->edit();

		echo json_encode($result);

	}

	public function getuser2()
	{
	$this->load->model('User_listModel');
	$result = $this->User_listModel->getuser2();
	echo json_encode($result);
	}


}

?>