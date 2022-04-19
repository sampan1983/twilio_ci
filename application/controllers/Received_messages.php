<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Received_messages extends CI_Controller {



		function __construct(){

			parent::__construct();

			if (!isset($_SESSION['logged_in'])) {

				header('Location :'.base_url().'Login');

			}

			$this->load->model('Received_messagesModel');

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
		$this->load->model('Received_messages_newModel');

		$result['Received_messages_new'] = $this->Received_messages_newModel->receivedmsglog();

		$this->load->model('User_listModel');

		$result['data'] = $this->User_listModel->get();

		$result['tabledata'] = $this->Received_messagesModel->getdata();

		$this->load->view('received_messages',$result);

	}

	public function searchnum(){

		$result = $this->Received_messagesModel->searchnum();

		echo json_encode($result);

	}

	public function search(){

		$result = $this->Received_messagesModel->search();

		echo json_encode($result);

	}



	public function export($month="null",$year="no",$num_msg="default"){





if ($year=="no") {

	$year = "";

}

if ($month=="null") {

	$month = "";

}



if ($num_msg=="default") {

	$num_msg = "";

}



$filename = 'received_messages.csv';

// set headers to download file

header( 'Content-Type: text/csv' );

header( 'Content-Disposition: attachment;filename='.$filename);



$file = fopen('php://output', 'w');            

    

									

									

//set the column names

$cells[] = array('S.No.', 'Mobile Number','Twilio Number', 'Message', 'Date' );

     

					

					if($num_msg=='' && $year=='')

					{

					

					$result=$this->db->query("select * from tapp_msg_receive where user_id = '".$_SESSION['id']."' group by sender  order by date_time desc");

					}

					else if($num_msg=='')

					{

					

					$result=$this->db->query("select * from tapp_msg_receive where user_id = '".$_SESSION['id']."' and MONTH( date_time ) ='$month' AND YEAR( date_time ) ='$year' group by sender   order by date_time desc");

					}

					else

					{

					

					$result=$this->db->query("select * from tapp_msg_receive where user_id = '".$_SESSION['id']."' and (sender='".$num_msg."' OR body like '%".$num_msg."%') group by sender  order by date_time desc");

					}

					$row = $result->result_array();

								for ($i=0; $i <sizeof($row) ; $i++) { 

										                           $d = $i+1;

//pass all the form values 

$cells[] = array( $d, $row[$i]['sender'],$row[$i]['twilio_num'], $row[$i]['body'],  $row[$i]['date_time'] );



} 

foreach($cells as $cell)

{

	fputcsv($file,$cell);

}

fclose($file);  

	}



}

?>