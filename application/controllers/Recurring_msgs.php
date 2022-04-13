<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Recurring_msgs extends CI_Controller {



	function __construct(){

			parent::__construct();

			if (!isset($_SESSION['logged_in'])) {

				header('Location: '.base_url().'Login');

			}

			$this->load->model('Received_messages_newModel');

		}

    public function index(){
        $this->load->model('Add_group_numbersModel');
        $result['getgroup'] = $this->Add_group_numbersModel->getgroup();
        $this->load->model('ClientModel');
        $result['clientdata'] = $this->ClientModel->get();
        $this->load->model('User_listModel');
        $result['data_user'] = $this->User_listModel->get();
        $this->load->model('Recurring_msgModel');
        $this->load->model('Received_messages_newModel');
        $result['Received_messages_new'] = $this->Received_messages_newModel->receivedmsglog();
        $result['recurr_data'] = $this->Recurring_msgModel->get_data();
        $this->load->model('Bulk_smsModel');
        $result['tapp_template_msg'] = $this->Bulk_smsModel->tapp_template_msg();
        $this->load->view('recurring_msg',$result);
    }

    public function add_recurring_data(){
        $msg_type = $this->input->post('msg_type');
        if ($msg_type=='clients') {
			$send_number = '';
			$counter = 0;
			$already = 0;
			$count = sizeof($this->input->post('clients_name'));
			if ($count==0) {
				$this->session->set_userdata('recurr_add_fail', 'Failed!! Please Select Contact');
			}
		 	$clients_name = $this->input->post('clients_name');
			$c = 0;
			for ($i=0; $i < $count ; $i++) { 
				$sql = "select * from tapp_tbl_clients";
				$result = $this->db->query($sql);
				$row = $result->num_rows();
				if ($clients_name[$i] != 'select_all_clients') {
					if (!empty($clients_name[$i])) {
						if (strlen($clients_name[$i])<11) {
							$clients_name[$i] = '1'.$clients_name[$i];
						}
						if ($c==0) {
							$send_number .= $clients_name[$i];  
						}
						else{
							$send_number .= ','.$clients_name[$i];  
						}	
					}

					$c++;
				}
			}
		} 
	elseif ($msg_type=='group') {
 		$group_name = $this->input->post('group_name');
 		$tapp_groups_result = $this->db->query("select * from tapp_groups where fk_group_data = '$group_name'");
 		if ($tapp_groups_result->num_rows()>0) {
			$send_number = '';
 			for ($i=0; $i < $tapp_groups_result->num_rows() ; $i++) { 
 				$tapp_groups_data = $tapp_groups_result->result_array();
 				$number  = $tapp_groups_data[$i]['number'];
				if (!empty($number)) {
					if (strlen($number)<11) {
						$number = '1'.$number;
					}
					if ($i==0) {
						$send_number .= $number;
					}
					else{
						$send_number .= ','.$number;
					}	
				}
	 		}
		}
		else{  	
			$this->session->set_userdata('recurr_add_fail', 'Failed!! Sorry there is no group selected');
		}
 	}
	else if($msg_type=='file'){
		//////xlsx file upload
		$allowedExts = array("xlsx","txt","csv");
		$extension = explode(".", $_FILES["filex"]["name"]);
		if ($extension!=".xlsx" || $extension!=".txt" && ($_FILES["filex"]["size"] < 90000000) && in_array($extension, $allowedExts)){ 
			if ($_FILES["filex"]["error"] > 0){
				$_SESSION['file_size_error'] = 'There is an error in file';
				return "Return Code: " . $_FILES["filex"]["error"] . "<br />";
			}
			else{
				$file=$_FILES["filex"]["name"];
				if (file_exists("../xls/imageDirectory/" . $_FILES["filex"]["name"])){	
					$_SESSION['already_filex'] = $_FILES["filex"]["name"] . " already exists.";
					return $_FILES["filex"]["name"] . " already exists. ";
				}
				else{
					$temp = explode(".",$_FILES["filex"]["name"]);
					$newfilename = rand(1,89768) . '.' .end($temp);
					move_uploaded_file($_FILES["filex"]["tmp_name"],"upload1/".$newfilename);
					//echo "Stored in: " . "upload/" . $_FILES["file"]["name"];
					"upload1/".$newfilename;
					"upload1/".$newfilename;
				}
			}
		}
		else{
			return "Invalid file_format";
		}
		$inputFileName ="upload1/".$newfilename;
		$extension1 = explode(".", $inputFileName);
		if ($extension1==".xlsx" || $extension!=".csv" || $extension1==".txt"){
			set_include_path(get_include_path() . PATH_SEPARATOR . 'Classes/');
			include 'PHPExcel/IOFactory.php';
			// This is the file path to be uploaded.
			try {
				$objPHPExcel = PHPExcel_IOFactory::load($inputFileName);
			}
			catch(Exception $e) {
				die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
				return $e;
			}
			$allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
			$arrayCount = count($allDataInSheet);  // Here get total count of row in that Excel sheet
			$send_number = '';
			for($i=1;$i<=$arrayCount;$i++){
				$sms_number = trim($allDataInSheet[$i]["A"]);
				if (!empty($sms_number)) {
					if (strlen($sms_number)<11) {
						$sms_number = '1'.$sms_number;
					}
					if ($i==1) {
						$send_number .= $sms_number;
					}
					else{
						$send_number .= ','.$sms_number;
					}	
				}
			}
		}
	}
	else{
		$this->session->set_userdata('recurr_add_fail', 'Failed!! Please Choose Sender Type');
		// return 'invalid upload type';
	}
	$allowedExts = array("xlsx","txt","csv");
	$extension = explode(".", $_FILES["file"]["name"]);
	if ($extension!=".xlsx" || $extension!=".txt" && ($_FILES["file"]["size"] < 90000000) && in_array($extension, $allowedExts)){ 
		if ($_FILES["file"]["error"] > 0){
			$_SESSION['file_size_error'] = 'There is an error in file';
			return "Return Code: " . $_FILES["file"]["error"] . "<br />";
		}
		else{
			$file=$_FILES["file"]["name"];
			if (file_exists("../xls/imageDirectory/" . $_FILES["file"]["name"])){	
				$_SESSION['already_file'] = $_FILES["file"]["name"] . " already exists.";
				return $_FILES["file"]["name"] . " already exists. ";
			}
			else{
				$temp = explode(".",$_FILES["file"]["name"]);
				$newfilename = rand(1,89768) . '.' .end($temp);
				move_uploaded_file($_FILES["file"]["tmp_name"],"upload1/".$newfilename);
				//echo "Stored in: " . "upload/" . $_FILES["file"]["name"];
				"upload1/".$newfilename;
				"upload1/".$newfilename;
			}
		}
	}
	else{
		echo "Invalid file_format";
		$this->session->set_userdata('recurr_add_fail', 'Failed!! Invalid file format');
	}
	$inputFileName ="upload1/".$newfilename;
	$extension1 = explode(".", $inputFileName);
	if ($extension1==".xlsx" || $extension!=".csv" || $extension1==".txt"){
		set_include_path(get_include_path() . PATH_SEPARATOR . 'Classes/');
		if($msg_type!='file'){
		include 'PHPExcel/IOFactory.php';
		}
		// This is the file path to be uploaded.
		try {
			$objPHPExcel = PHPExcel_IOFactory::load($inputFileName);
		}
		catch(Exception $e) {
			die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
			return $e;
		}
		$allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
		$arrayCount = count($allDataInSheet);  // Here get total count of row in that Excel sheet
		$check_send_number = str_replace(",","",$send_number);
		if (!empty($check_send_number)) {
			for($i=2;$i<=$arrayCount;$i++){
				echo $date = $allDataInSheet[$i]["A"]; 
				$date_time = date('Y-m-d H:i:s',strtotime($date));
				$dayofweek = date('l', strtotime($date)); 
				if($dayofweek=='Saturday'){
					$status = 'stop';
				}
				else{
					$status = 'Active';
				}
				$keyword = trim($allDataInSheet[$i]["B"]);
				$dayofweek = date('l', strtotime($date));
				$monthfromdate = date('M', strtotime($date));
				$dayfromdate = date('d', strtotime($date));
				if($_POST['message_type']=='custom'){
					$msg = str_replace("{{KEYWORD}}",$keyword,$_POST['mymessage']);
				}
				else{
					$msg = str_replace("{{KEYWORD}}",$keyword,$_POST['message']);
				}
				$date_data = $monthfromdate." ".$dayfromdate;
				$msg = str_replace("{{DATE}}",$date_data,$msg);
                $msg = str_replace("{{DAY OF WEEK}}",$dayofweek,$msg);
				$now = date('Y-m-d H:i:s');
				if (!empty($msg) && !empty($date)) {
					$data = array(
						'sended_on' => $date_time,
						'date_time' => $now,
						'number' => $send_number,
						'message' => $msg,
						'status'  => $status
					);
					$recurr_add = $this->db->insert('recurring_msg',$data);
				}
			}
			if (!empty($recurr_add)) {
				$this->session->set_userdata('recurr_add', 'Data added successfully');
			}
			else{
				$this->session->set_userdata('recurr_add_fail', 'Failed!! Something Went Worng');
			}
		}
		else{
			$this->session->set_userdata('recurr_add_fail', 'Failed!! Numbers Can\'t be Empty');
		}
	}
	else{
		$this->session->set_userdata('recurr_add_fail', 'Invalid file format');
	}
        redirect(base_url().'Reccuring');
    }

    public function recurring_msgs(){
        $this->load->model('Recurring_msgModel');
        $result = $this->Recurring_msgModel->send_recurring();

    }
    
	public function delete()
	{
		if ($_POST['id']) {
			$this->db->delete('recurring_msg',array('id'=>$_POST['id']));
		}
		redirect(base_url().'Reccuring');
	}

	public function edit()
	{
		$data = array(
					'message' => $_POST['msg'],
					'sended_on' => $_POST['date'],
					'number' => $_POST['numbers']
				);
		$update = $this->db->update('recurring_msg',$data,array('id'=>$_POST['id']));
		if ($update) {
			echo 'update';
		}
		else{
			echo 'error';
		}
	}

	public function stop_recurr()
	{
	$id = $this->input->post('id');
	$status = $this->input->post('status');
	$update = $this->db->update('recurring_msg',array('status' => $status),array('id'=>$id));
		if($update){
			echo 'update';
		}
		else{
			echo 'error';
		}
	}
}
?>