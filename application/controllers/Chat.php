<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Chat extends CI_Controller {



	function __construct(){

			parent::__construct();

			if (!isset($_SESSION['logged_in'])) {

				header('Location: '.base_url().'Login');

			}

			else if (!isset($_SESSION['number'])) {

				header('Location: '.base_url().'index.php/Received_messages_new');

			}

			$this->load->model('ChatModel');

			$this->load->model('Received_messages_newModel');

		}



		function index(){

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

		$result['chatdata'] = $this->ChatModel->getChat();

		$result['gettwilio'] = $this->ChatModel->gettwilio();

			$this->load->view('chat',$result);

		}

		function sendmsg(){

			$result = $this->ChatModel->sendmsg();



			echo json_encode($result);



		}



		function delete(){

			// echo "in";

			$result1 = $this->ChatModel->delete();

			if ($result1) {

				$_SESSION['true'] = "200";

			}

			else{

				$_SESSION['true'] = "201";

			}

			// $result['chatdata'] = $this->ChatModel->getChat();

			// $result['gettwilio'] = $this->ChatModel->gettwilio();

			redirect(base_url().'Chat');

		}



	



	

	

	}

	?>

