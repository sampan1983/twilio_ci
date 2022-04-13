<?php



defined('BASEPATH') OR exit('No direct script access allowed');







class Received_messages_new extends CI_Controller {







	function __construct(){



			parent::__construct();



			if (!isset($_SESSION['logged_in'])) {



				header('Location: '.base_url().'Login');



			}



			$this->load->model('Received_messages_newModel');



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

		$this->load->model('User_listModel');



		$result['data'] = $this->User_listModel->get();



		$result['new_recieve'] = $this->Received_messages_newModel->getnewrecieve();



		$this->load->model('Received_messages_newModel');



		$result['Received_messages_new'] = $this->Received_messages_newModel->receivedmsglog();



		$this->load->view('received_messages_new',$result);



	}



	public function delete($id){



		$result = $this->Received_messages_newModel->delete($id);

		

		echo json_encode($result);



	}



	public function search(){



		$result = $this->Received_messages_newModel->search();



		echo json_encode($result);



	}



	public function searchnum(){



		$result = $this->Received_messages_newModel->searchnum();



		echo json_encode($result);



	}







	public function chat($id){



				$result = $this->Received_messages_newModel->chat($id);



		echo json_encode($result);



	}

	public function receivedmsg()

	{

		$result = $this->Received_messages_newModel->receivedmsg();

		echo $result;

	}

	public function delete_s(){

		$result = $this->Received_messages_newModel->delete_s();

		redirect(base_url().'Inbox');

	}



	



}



?>



