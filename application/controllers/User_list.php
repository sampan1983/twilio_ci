<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class User_list extends CI_Controller {



		function __construct(){

			parent::__construct();

			if (!isset($_SESSION['logged_in'])) {

				header('Location: '.base_url().'Login');

			}

			$this->load->model('User_listModel');



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

		$result['data'] = $this->User_listModel->get();

		$this->load->view('user_list',$result);

	}

	public function edit(){

		$result1 = $this->User_listModel->edit();

		echo json_encode($result1);

	}

public function delete(){

	$result2 = $this->User_listModel->delete();

	if ($result2) {

		$_SESSION['true'] = "200";

	}

	else{

		$_SESSION['true'] = "199";

	}

redirect(base_url().'My_Profile');
}
	public function add()
	{
		$result = $this->User_listModel->add();
		 if ($result)
		 {
		 	$_SESSION['added'] = 'New contact has been added';
		 }
		 else{
		 	$_SESSION['already'] = 'This email is already in added';
		 }
		 redirect(base_url().'My_Profile');
	}


}

?>