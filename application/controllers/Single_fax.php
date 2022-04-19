<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Single_fax extends CI_Controller {

	function __construct(){

			parent::__construct();

			if (!isset($_SESSION['logged_in'])) {

				header('Location: '.base_url().'Login');

			}
			$this->load->model('Single_faxModel');
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
			$this->load->view('single_fax',$result);
		}

		public function get_single_fax(){
			$result = $this->Single_faxModel->get_single_fax();
			// echo $result;
			redirect(base_url().'Single_fax');
		}
	}

?>