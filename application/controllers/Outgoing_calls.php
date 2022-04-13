<?php

defined('BASEPATH') OR exit('No direct script access allowed');
use Twilio\Rest\Client;


class Outgoing_calls extends CI_Controller {

		function __construct(){
		parent::__construct();
		if (!isset($_SESSION['logged_in'])) 
		{
		header('Location: '.base_url().'Login');
		}
		$this->load->model('Outgoing_callsModel');
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
	 $result['data'] = $this->Outgoing_callsModel->getnum();
	 $this->db->select("*");
	 $this->db->where('user_id',$_SESSION['id']);
	 $this->db->from("tapp_tbl_clients");
	 $result['contact_data'] = $this->db->get()->result();
	 // print_r($result['contact_data']);
	 $this->load->view('outgoing_calls',$result);

	}

	public function blacklist($elem){

		$result = $this->Outgoing_callsModel->blacklist($elem);

		echo $result;

	}
 	


}

?>