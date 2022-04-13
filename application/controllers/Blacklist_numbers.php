<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Blacklist_numbers extends CI_Controller {



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

		$this->load->model('Blacklist_numbersModel');

		$result['BlackListData'] = $this->Blacklist_numbersModel->getdata();

		$this->load->view('blacklist_numbers',$result);

	}

	public function addnum(){

		$this->load->model('Blacklist_numbersModel');

		$result = $this->Blacklist_numbersModel->addnum();

		echo json_encode($result);

	}

	public function delete_blacklist($i){

	$this->load->model('Blacklist_numbersModel');

		$result = $this->Blacklist_numbersModel->delete_blacklist($i);

		echo json_encode($result);



	}



}

?>