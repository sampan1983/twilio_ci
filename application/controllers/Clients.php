<?php

defined('BASEPATH') OR exit('No direct script access allowed');
class Clients extends CI_Controller {

	function __construct(){
			parent::__construct();
			if (!isset($_SESSION['logged_in'])) {
				header('Location: '.base_url().'Login');
			}
			$this->load->model('ClientModel');
		}

		public function index()	{

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

			$this->load->model('ClientModel');

			$result['data'] = $this->ClientModel->get();

			$this->load->view('clients',$result);

	}

	

	public function add(){

		$this->load->model('ClientModel');

		$result = $this->ClientModel->add();

		echo json_encode($result);

	}

	public function edit(){

		$this->load->model('ClientModel');

		$result = $this->ClientModel->edit();

		echo json_encode($result);

	}

	public function delete(){

		$this->load->model('ClientModel');

		$result = $this->ClientModel->delete();

		echo json_encode($result);

	}
		public function delete_s(){

		$this->load->model('ClientModel');

		$result = $this->ClientModel->delete_s();
		redirect(base_url().'Contacts');
		}

		public function delete_all($param)
		{
		if($param=='sent'){
//			$this->db->truncate('tapp_sent_msg_log');
			$_SESSION['sent_msg_delete'] = 'Data Deleted Success Fully';
			redirect(base_url().'Sent_Messages');
		}
		if($param=='client'){
			$this->db->truncate('tapp_tbl_clients');
			redirect(base_url().'Contacts');
		}
		}

	public function import(){
	$counter = 0;
	$allowedExts = array("xlsx","txt","csv");
	$extension = explode(".", $_FILES["file"]["name"]);
	if ($extension!=".xlsx" || $extension!=".txt"&& ($_FILES["file"]["size"] < 90000000)&& in_array($extension, $allowedExts)){
	if ($_FILES["file"]["error"] > 0){
	$_SESSION['fail_message'] = '2';
	}
	else{
	$file=$_FILES["file"]["name"];
	$temp[0] = rand(0, 3000); //Set to random number
	if (file_exists("../xls/imageDirectory/" . $_FILES["file"]["name"])){
	$_SESSION['already'] = '4';
	$_FILES["file"]["name"] . " already exists. ";
	}
	else{
	$temp = explode(".",$_FILES["file"]["name"]);
	$newfilename = rand(1,89768) . '.' .end($temp);
	move_uploaded_file($_FILES["file"]["tmp_name"],"upload1/".$newfilename);
	}
	}
	}
	else{
	}
	$inputFileName ="upload1/".$newfilename;
	$extension1 = explode(".", $inputFileName);
	if ($extension1==".xlsx" || $extension!=".csv" || $extension1==".txt"){
	set_include_path(get_include_path() . PATH_SEPARATOR . 'Classes/');
	require 'Classes/PHPExcel/IOFactory.php';
	// This is the file path to be uploaded.
	try {
	 $objPHPExcel = PHPExcel_IOFactory::load($inputFileName);
	} catch(Exception $e) {
	 die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
	}
	$allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
	$arrayCount = count($allDataInSheet);  // Here get total count of row in that Excel sheet
	for($i=2;$i<=$arrayCount;$i++){
	$first_name = trim($allDataInSheet[$i]["A"]);
	$name=str_replace("(", "", $first_name);
	$name=str_replace(")", "", $name);
	$name=str_replace("'", "_", $name);
	$name=str_replace('"', '', $name);
	$first_name = $name;
	$email = trim($allDataInSheet[$i]["B"]);
	$mail=str_replace("(", "", $email);
	$mail=str_replace(")", "", $mail);
	$mail=str_replace("'", " ", $mail);
	$email=str_replace('"', '', $mail);
	$sm = trim($allDataInSheet[$i]["C"]);
	$sm1=str_replace("(", "", $sm);
	$sm2=str_replace(")", "", $sm1);
	$sm3=str_replace("-", "", $sm2);
	$sm4=str_replace(" ", "", $sm3);
	$sm5=str_replace(",", "", $sm4);
	$sm6=str_replace("+", "", $sm5);
	$sm7=str_replace(".", "", $sm6);
	$sm8=str_replace("/", "", $sm7);
	$sm9=str_replace(";", "", $sm8);
	$sm10=str_replace(":", "", $sm9);
	$sm11=str_replace("!", "", $sm10);
	$sm12=str_replace("@", "", $sm11);
	$sm13=str_replace("*", "", $sm12);
	$sm14=str_replace("$", "", $sm13);
	$sm15=str_replace("%", "", $sm14);
	$sm16=str_replace("^", "", $sm15);
	$sm17 = str_replace("&", "", $sm16);
	$sm19 = str_replace("<", "", $sm17);
	$sm20 = str_replace(">", "", $sm19);
	$sm21 = str_replace("<", "", $sm20);
	$sm22 = str_replace("?", "", $sm21);
	$sm23 = str_replace("_", "", $sm22);
	$sms_number = str_replace("#", "", $sm23);
	if(strlen($sms_number) == 10){
	$sms_number = '+1'.$sms_number;
	}
	$candidate_location = trim($allDataInSheet[$i]["D"]);
	$candidate_location = preg_replace('/[^a-zA-Z0-9_ -]/s',' ',$candidate_location);
	$job_title = '';

	$job_location = '';

	$date_lead = '';

	$interest_level = '';

	$source = '';

	$status = '';
	$check_num = "select * from tapp_tbl_clients where user_id = '".$_SESSION['id']."' and sender ='$sms_number'";
	$check_dup = $this->db->query($check_num);
	if($check_dup->num_rows()<1 && $sms_number != ''){ 
	$counter = $counter + 1;
	$sql=$this->db->query("insert into tapp_tbl_clients (sender,first_name,last_name,email,country,date_time,address,postal_code,job_title,job_location,lead_date,interest_level,source,status,user_id) values('".$sms_number."','".$first_name."','','".$email."','',now(),'".$candidate_location."','','".$job_title."','".$job_location."','".$date_lead."','".$interest_level."','".$source."','".$status."','".$_SESSION['id']."')");
	}
	else{
	$sql = false;
	}
	if($sql){
 	$_SESSION['flash_message'] = '0';
	}
	else{
	$_SESSION['already'] = '4';
	}
	}
	}
	else{
 	$_SESSION['fail_message'] = '2';
	}			
	redirect(base_url().'Contacts');
	}

	public function export(){

		$filename = date('Y-m-d')."-contacts.csv";

		//set headers to download file

header( 'Content-Type: text/csv' );

header( 'Content-Disposition: attachment;filename='.$filename);



		$file = fopen('php://output', 'w');







//set the column names

$cells[] = array('S.No.', 'Name','Email','Phone','Address','Date' );

     





					$result=$this->db->query("select * from tapp_tbl_clients where user_id = '".$_SESSION['id']."'");

					

				$row =$result->result_array();

									

									for ($i=0; $i <sizeof($row) ; $i++) 

								

									{ $d=$i+1;

//pass all the form values

$cells[] = array( $d, $row[$i]['first_name'],$row[$i]['email'],$row[$i]['sender'],$row[$i]['address'],$row[$i]['date_time']);

}







foreach($cells as $cell)

{	

	fputcsv($file,$cell);

}

fclose($file);

	}



}

?>

