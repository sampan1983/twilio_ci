<?php



defined('BASEPATH') OR exit('No direct script access allowed');







class Keywords extends CI_Controller {







		function __construct(){



			parent::__construct();



			if (!isset($_SESSION['logged_in'])) {



				header('Location: '.base_url().'Login');



			}



			$this->load->model('KeywordsModel');



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



		$result['data'] = $this->KeywordsModel->get();



		$this->load->view('keywords',$result);



	}







	public function add(){



		$result1 = $this->KeywordsModel->add();

       

			if ($result1) {



			$_SESSION['new_key'] = '0';



		}



		else{



			$_SESSION['new_key'] = '1';



		}







		redirect(base_url().'Autoresponder_Keywords');



		// 		$result['data'] = $this->KeywordsModel->get();



		// $this->load->view('keywords',$result);



	}



	public function edit(){



		$result1 = $this->KeywordsModel->edit();



		if ($result1) {



			$_SESSION['key'] = '0';



		}



		else{



			$_SESSION['key'] = '1';



		}







		redirect(base_url().'Autoresponder_Keywords');



	}



public function delete($id){



				$result1 = $this->KeywordsModel->delete($id);



				if ($result1) {



			$_SESSION['keydel'] = '0';



		}



		else{



			$_SESSION['keydel'] = '1';



		}



				echo json_encode($result1);



}







}



?>