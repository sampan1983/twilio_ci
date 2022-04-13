<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Add_group_numbers extends CI_Controller {


	function __construct(){

			parent::__construct();

			if (!isset($_SESSION['logged_in'])) {

				header('Location: '.base_url().'Login');

			}

					$this->load->model('Add_group_numbersModel');



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

		$result['getgroup'] = $this->Add_group_numbersModel->getgroup();
		$this->load->view('add_group_numbers',$result);
	}

	public function getid($id)
	{
		$this->load->model('View_group_numberModel');
		$result = $this->View_group_numberModel->getid($id);
		echo json_encode($result);
	}
	public function delete_group($id)
	{
		$id = str_replace("%20", " ", $id);
		$this->load->model('Add_group_numbersModel');
		$result = $this->Add_group_numbersModel->delete_group($id);
		echo json_encode($result);
	}
	public function getgroup()
	{
		$result = $this->Add_group_numbersModel->addgroup();
		redirect(base_url().'Groups');
	}
	public function edit_group(){
		$result = $this->Add_group_numbersModel->edit_group();
		redirect(base_url().'Groups');
	}
}

?>