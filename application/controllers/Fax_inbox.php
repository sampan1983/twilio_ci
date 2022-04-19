<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Fax_inbox extends CI_Controller {

	function __construct(){

			parent::__construct();

			if (!isset($_SESSION['logged_in'])) {

				header('Location: '.base_url().'Login');

			}
		$this->load->model('Fax_inboxModel');	
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

		$result['get_inbox'] = 		$this->Fax_inboxModel->get_data();
			$this->load->view('fax_inbox',$result);
		}

		public function delete($id)
		{
			$result = $this->Fax_inboxModel->delete($id);
			redirect(base_url().'Fax_Inbox');
		}
		public function get_fax()
		{
			$result = $this->Fax_inboxModel->get_fax();
			print_r($result);
		}
	}

?>