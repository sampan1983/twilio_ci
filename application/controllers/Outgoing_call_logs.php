<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Outgoing_call_logs extends CI_Controller {



		function __construct(){

			parent::__construct();

			if (!isset($_SESSION['logged_in'])) {

				header('Location :'.base_url().'Login');

			}

			$this->load->model('Outgoing_call_logsModel');



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

		$result['data'] = $this->Outgoing_call_logsModel->get();

		$this->load->view('outgoing_call_logs',$result);

	}

	public function delete(){

		$result = $this->Outgoing_call_logsModel->delete();

		if ($result) {

			$_SESSION['vdelete'] = '1';

		}

		else{

			$_SESSION['vdelete'] = '0';

		}

		redirect(base_url().'Call_Logs');

	}

	public function export()

	{

		$filename = 'Outgoing_call_logs.csv';

		$file  =  fopen('php://output','w');



		$cells[] = array('S.No.', 'To' ,'From','Voice','Date' );



		$result = $this->db->query("select * from tapp_voice_broadcast_logs where user_id = '".$_SESSION['id']."' order by date_time desc");

		$row = $result->result_array();

		for ($i=0; $i <sizeof($row) ; $i++) { 

		$d = $i+1;

		$cells[] = array($d ,$row[$i]['user_number'],$row[$i]['twilio_number'],$row[$i]['voice_file'],$row[$i]['date_time'] );

		}

	foreach ($cells as $cell ) {

		fputcsv($file, $cell);



	}

	fclose($file);



	header('Content-Type: text/csv');

	header('Content-Disposition: attachment;filename='.$filename);

	}



}

?>