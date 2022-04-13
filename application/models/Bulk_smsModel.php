<?php

defined('BASEPATH') OR exit('No direct script access allowed');
use Twilio\Rest\Client;


class Bulk_smsModel extends CI_Model {



	function get_bulk_msg()
	{

		
		$msg_type = $this->input->post('msg_type');
		$sending_type = $this->input->post('sending_type');	
		$service_type = $this->input->post('service_type');
		$tmp_img = $this->input->post('tmp_img');
		if ($sending_type=='scheduled') {
			$scheduled = $this->input->post('scheduled');
			$time = $this->input->post('time');
			$scheduled_time = $scheduled.' '.$time.':00';
		}
		else{
			$stime = "select now()";
			$scheduled_time = $this->db->query($stime);
			if ($scheduled_time) {
				$scheduled = $scheduled_time->result_array();
				$scheduled_time = $scheduled[0]['now()'];
			}			// $scheduled_time =	str_replace(" ' ","" , $scheduled_time);
		}
		$twilio_number = $this->input->post('twilio_number');
		$check_twilio_number = "select * from tapp_twilio_number where user_id = '".$_SESSION['id']."' and number = '$twilio_number'";
		$twilio_numbe = $this->db->query($check_twilio_number);
		$twilio_data = $twilio_numbe->result_array();
		$sid = $twilio_data[0]['twilio_sid'];
		$twilio_token = $twilio_data[0]['twilio_token'];
		$service_type = $twilio_data[0]['service_type'];
		$img = $_FILES['file'];
		if ($_FILES['file']['size'][0]==0) 
		{
			 	$img = "";
		} 
		else
		{
			if (isset($_FILES['file'])) 
			{
		 	  for ($i=0; $i <sizeof($_FILES['file']['name']) ; $i++) 
		 	  { 
		 		$_FILES['myimg']['name'] = $_FILES['file']['name'][$i];
		 		$_FILES['myimg']['size'] = $_FILES['file']['size'][$i];
		 		$_FILES['myimg']['type'] = $_FILES['file']['type'][$i];
		 		$_FILES['myimg']['tmp_name'] = $_FILES['file']['tmp_name'][$i];
		 		$_FILES['myimg']['error'] = $_FILES['file']['error'][$i];
		 		$config['allowed_types'] = 'jpg|jpeg|gif|png';
		 		$config['file_name'] = 'img'.rand(100,1000);
		 		$config['upload_path'] = './upload';
			 	$this->load->library('upload',$config);
				if (!$this->upload->do_upload('myimg')) 
				{
				$img = null;
				}
				else
				{
				$file_data = $this->upload->data();
				$img = base_url()."upload/".$file_data['file_name'];
		 		}
		 	  }
			}
		 }
		if (!empty($tmp_img)) 
		{
			$img = $tmp_img;
		}
		$message_type = $this->input->post('message_type');
		if($message_type== 'custom')
		{
		  $message = $this->input->post('mymessage');
		}
		else
		{
		 $message = $this->input->post('message');
		}


		$str = str_replace(PHP_EOL, '', $message);
		$message= stripslashes($str);
		$message= str_replace('rnrn','',$str);
		$message= str_replace('\r',' ',$message);
		$message = preg_replace('/\s+/', ' ', $message);
		$message = mysqli_real_escape_string($this->db->conn_id, $message);
		if ($msg_type=='clients') 
		{
		 $counter = 0;
		 $already = 0;
		 $count = sizeof($this->input->post('clients_name'));
		if ($count==0) 
		{
			return 'no contact';
		}
 	$clients_name = $this->input->post('clients_name');
 	for ($i=0; $i < $count ; $i++) 
 	{ 
   	 $sql = "select * from tapp_tbl_clients where user_id = '".$_SESSION['id']."'";
	 $result = $this->db->query($sql);
	 $row = $result->num_rows();
	if ($clients_name[$i] != 'select_all_clients') 
	{
		if (strlen($clients_name[$i])<11) {
			$clients_name[$i] = '1'.$clients_name[$i];
		}
	if ($row>0) 
	{
 	 $name_data = $result->result_array();
	 $name = $name_data[$counter]['first_name'];
	 $check_tapp_sent_msg = "select * from tapp_sent_msg where user_id = '".$_SESSION['id']."' and sms_number = '$clients_name[$i]'";
	 $check_tapp_sent_msg_result = $this->db->query($check_tapp_sent_msg);
	 if ($check_tapp_sent_msg_result->num_rows()<1) {
		 // echo $sending_type;
		if($sending_type=='scheduled'){
			$insert_msg_log = "INSERT INTO tapp_sent_msg(service_type, sms_number, message, twilio_num, images, bulk_name,date_time,scheduled_time,user_id) VALUES ('twilio','$clients_name[$i]','$message','$twilio_number','$img','$name',now(),'$scheduled_time','".$_SESSION['id']."')";			
		}
		else{

			$insert_msg_log = "INSERT INTO tapp_sent_msg(service_type, sms_number, message, twilio_num, images, bulk_name,date_time,scheduled_time,user_id) VALUES ('twilio','$clients_name[$i]','$message','$twilio_number','$img','$name',now(),'$scheduled_time','".$_SESSION['id']."')";

// 			$client = new Client($sid, $twilio_token);
// 			if (!empty($img)) {	
// 				$response = $client->messages->create(
// 					$clients_name[$i],
// 					array(
// 						// 'from' => $twilio_number,
// 						'messagingServiceSid'=>'MG3dff6495eab501b5b240d861380c884d',
// 						'body' => $message,
// 						'mediaUrl' => $img,
						
// 					)
// 				);
// 			}
// 			else{
// 				$response = $client->messages->create(
// 					$clients_name[$i],
// 					array(
// 						// 'from' => $twilio_number,
// 						'messagingServiceSid'=>'MG3dff6495eab501b5b240d861380c884d',
// 						'body' => $message,					
// 					)
// 				);
// 			}
// 			print_r($response->status);	
// 			$unique_id = $response->status;
// 			// if($response->status=='queued'){
// 			// 	$insert_msg_log = "INSERT INTO queued_msg(number,twilio_num,msg,img,status,date_time,user_id) VALUES ('$clients_name[$i]','$twilio_number','$message','$img', '$unique_id', now(),'".$_SESSION['id']."')";
// 			// }	
// 			// else{
// 				$insert_msg_log = "INSERT INTO tapp_sent_msg_log(sms_number,twilio_num,message,images,bulk_name,date_time,user_id) VALUES ('$clients_name[$i]','$twilio_number','$message','$img', '$unique_id', now(),'".$_SESSION['id']."')";		
// 			// }
// 			////add img
// 			///end img
// 			// $insert_msg_log = "INSERT INTO tapp_sent_msg_log(sms_number,twilio_num,message,images,bulk_name,date_time,user_id) VALUES ('$clients_name[$i]','$twilio_number','$message','$img', '$unique_id', now(),'".$_SESSION['id']."')";
// 		//	$tapp_msg_log = $this->db->query($insert_msg_log);
// 			if ($insert_msg_log==true) 
// 			{
// 				$insert_table_data = "insert into table_data (sender,body,date_time,sending_status,user_id)values('$clients_name[$i]','$message', now(),'S','".$_SESSION['id']."')";
// 				$table_data = $this->db->query($insert_table_data);
// 				if ($table_data == true) {
// 				$_SESSION['single_send'] = 'Message has been send successfully';
// //			return 'message sent';
// 				}
// 				// else{
// 				// 	return false;
// 				// }
// 				}
// 				else{
// 					return false;
// 				}
				
		}
// echo $insert_msg_log;
 	$result_insert_tapp_sent_msg_client = $this->db->query($insert_msg_log);
 	if ($result_insert_tapp_sent_msg_client==true) 
 	{
	$counter =  $counter + 1;
 	}
	}
	}
	}
 	}
	if ($counter==0) 
	{
	$_SESSION['clients_fail'] = 'Number Already in Queued !';
 	return 'null';
	} 
	else
	{
 	$_SESSION['clients'] = 'Congrats!  '.$counter.' numbers Queued successfully';
 	return $counter;
	}
	} 
	elseif ($msg_type=='group') 
	{
 	$group_name = $this->input->post('group_name');
 	$tapp_groups = "select * from tapp_groups where fk_group_data = '$group_name'";
 	$tapp_groups_result = $this->db->query($tapp_groups);
 	if ($tapp_groups_result->num_rows()>0) {
 		for ($i=0; $i < $tapp_groups_result->num_rows() ; $i++) { 
 		$tapp_groups_data = $tapp_groups_result->result_array();
 		$number  = $tapp_groups_data[$i]['number'];
 			if (strlen($number)<11) {
			$number = '1'.$number;
		}

		 if($sending_type=='scheduled'){
			$insert_msg_log = "INSERT INTO tapp_sent_msg(service_type,sms_number,message,twilio_num,images,bulk_name,date_time,scheduled_time,user_id) VALUES ('twilio','$number','$message','$twilio_number','$img','$group_name',now(),'$scheduled_time','".$_SESSION['id']."')";			
		}
		else{
			$insert_msg_log = "INSERT INTO tapp_sent_msg(service_type,sms_number,message,twilio_num,images,bulk_name,date_time,scheduled_time,user_id) VALUES ('twilio','$number','$message','$twilio_number','$img','$group_name',now(),'$scheduled_time','".$_SESSION['id']."')";
			// $client = new Client($sid, $twilio_token);
			// if (!empty($img)) {	
			// 	$response = $client->messages->create(
			// 		$number,
			// 		array(
			// 			// 'from' => $twilio_number,
			// 			'messagingServiceSid'=>'MG3dff6495eab501b5b240d861380c884d',
			// 			'body' => $message,
			// 			'mediaUrl' => $img,
						
			// 		)
			// 	);
			// }
			// else{
			// 	$response = $client->messages->create(
			// 		$number,
			// 		array(
			// 			// 'from' => $twilio_number,
			// 			'messagingServiceSid'=>'MG3dff6495eab501b5b240d861380c884d',
			// 			'body' => $message,					
			// 		)
			// 	);
			// }
			// print_r($response);
			// print_r($response->status);	
			// $unique_id = $response->status;

			// // if($response->status=='queued'){
			// // 	$insert_msg_log = "INSERT INTO queued_msg(number,twilio_num,msg,img,status,date_time,user_id) VALUES ('$clients_name[$i]','$twilio_number','$message','$img', '$unique_id', now(),'".$_SESSION['id']."')";
			// // }	
			// // else{
			// 	$insert_msg_log = "INSERT INTO tapp_sent_msg_log(service_type,sms_number,message,twilio_num,images,bulk_name,date_time,user_id) VALUES ('twilio','$number','$message','$twilio_number','$img','$group_name',now(),'".$_SESSION['id']."')";		
			// // }
			// ////add img
			// ///end img
			// // $insert_msg_log = "INSERT INTO tapp_sent_msg_log(sms_number,twilio_num,message,images,bulk_name,date_time,user_id) VALUES ('$clients_name[$i]','$twilio_number','$message','$img', '$unique_id', now(),'".$_SESSION['id']."')";
			// //	$tapp_msg_log = $this->db->query($insert_msg_log);
			// if ($insert_msg_log==true) 
			// {
			// 	$insert_table_data = "insert into table_data (sender,body,date_time,sending_status,user_id)values('$number','$message', now(),'S','".$_SESSION['id']."')";
			// 	$table_data = $this->db->query($insert_table_data);
			// 	if ($table_data == true) {
			// 	$_SESSION['single_send'] = 'Message has been send successfully';
			// 	//			return 'message sent';
			// 	}
			// 	// else{
			// 	// 	return false;
			// 	// }
			// 	}
			// 	else{
			// 		return false;
			// 	}
				
		}
// echo $insert_msg_log;

		
		 $tapp_groups_data_insert_result = $this->db->query($insert_msg_log);
 		if ($tapp_groups_data_insert_result==true) {
 			$_SESSION['group'] = 'Group';
 			// return 'group';
 		}
 		else{  		$_SESSION['group_fail'] = 'Sorry there was an error to import group number';
 			// return 'group_fail';
 		}
	 	}
 	}
 	else{  	
 		// $_SESSION['group_fail'] = 'Sorry there is no group selected';
 		return 'group_fail';
 	}
 }
else if($msg_type=='file'){

	//////xlsx file upload



	$allowedExts = array("xlsx","txt","csv");





 $extension = explode(".", $_FILES["filex"]["name"]);

if ($extension!=".xlsx" || $extension!=".txt" && ($_FILES["filex"]["size"] < 90000000) && in_array($extension, $allowedExts))

{ 

if ($_FILES["filex"]["error"] > 0)





{

$_SESSION['file_size_error'] = 'There is an error in file';
return "Return Code: " . $_FILES["filex"]["error"] . "<br />";
}

else

{
$file=$_FILES["filex"]["name"];
// $file = $temp[0].".".$temp[1];
// $temp[0] = rand(0, 3000); //Set to random number
// $file;
if (file_exists("../xls/imageDirectory/" . $_FILES["filex"]["name"]))
{	
$_SESSION['already_filex'] = $_FILES["filex"]["name"] . " already exists.";
return $_FILES["filex"]["name"] . " already exists. ";
}
else
{
$temp = explode(".",$_FILES["filex"]["name"]);
$newfilename = rand(1,89768) . '.' .end($temp);
move_uploaded_file($_FILES["filex"]["tmp_name"],"upload1/".$newfilename);
//echo "Stored in: " . "upload/" . $_FILES["file"]["name"];
"upload1/".$newfilename;
"upload1/".$newfilename;
}
}
}
else
{
return "Invalid file_format";
}
$inputFileName ="upload1/".$newfilename;
 $extension1 = explode(".", $inputFileName);
if ($extension1==".xlsx" || $extension!=".csv" || $extension1==".txt")
{
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
for($i=1;$i<=$arrayCount;$i++){
  $sms_number = trim($allDataInSheet[$i]["A"]);
  if (strlen($sms_number)<11) {
  	$sms_number = '1'.$sms_number;
  }
	try
	{
		if($sending_type=='scheduled'){
			$insert_msg_log = "INSERT INTO tapp_sent_msg(service_type,sms_number,message,twilio_num,images,bulk_name,date_time,scheduled_time,user_id) VALUES ('twilio','$sms_number','$message','$twilio_number','$message','$file',now(),'$scheduled_time','".$_SESSION['id']."')";			
		}
		else{

			$insert_msg_log = "INSERT INTO tapp_sent_msg(service_type,sms_number,message,twilio_num,images,bulk_name,date_time,scheduled_time,user_id) VALUES ('twilio','$sms_number','$message','$twilio_number','$message','$file',now(),'$scheduled_time','".$_SESSION['id']."')";	

			// $client = new Client($sid, $twilio_token);
			// if (!empty($img)) {	
			// 	$response = $client->messages->create(
			// 		$sms_number,
			// 		array(
			// 			// 'from' => $twilio_number,
			// 			'messagingServiceSid'=>'MG3dff6495eab501b5b240d861380c884d',
			// 			'body' => $msg,
			// 			'mediaUrl' => $img					
			// 		)
			// 	);
			// }
			// else{
			// 	$response = $client->messages->create(
			// 		$sms_number,
			// 		array(
			// 			// 'from' => $twilio_number,
			// 			'messagingServiceSid'=>'MG3dff6495eab501b5b240d861380c884d',
			// 			'body' => $msg,					
			// 		)
			// 	);
			// }
			// print_r($response);
			// print_r($response->status);	
			// $unique_id = $response->status;
			// 	$insert_msg_log = "INSERT INTO tapp_sent_msg_log(service_type,sms_number,message,twilio_num,images,bulk_name,date_time,user_id) VALUES ('twilio','$sms_number','$msg','$twilio_number','$img','$file',now(),'".$_SESSION['id']."')";		
			// if ($insert_msg_log==true) 
			// {
			// 	$insert_table_data = "insert into table_data (sender,body,date_time,sending_status,user_id)values('$sms_number','$message', now(),'S','".$_SESSION['id']."')";
			// 	$table_data = $this->db->query($insert_table_data);
			// 	if ($table_data == true) {
			// 	$_SESSION['single_send'] = 'Message has been send successfully';
			// 	//			return 'message sent';
			// 	}
			// 	// else{
			// 	// 	return false;
			// 	// }
			// 	}
			// 	else{
			// 		return false;
			// 	}
				
		}
// echo $insert_msg_log;

		
		//  $tapp_groups_data_insert_result = $this->db->query($insert_msg_log);

		 // "INSERT INTO tapp_sent_msg(service_type,sms_number,message,twilio_num,images,date_time) VALUES ('".twilio."','".$sms_number."','".$msg."','".$twilio_number."','".$img."',now())";
	$sql1 = $this->db->query($insert_msg_log);
	}
	catch(Exception $e)
	{
	 echo $e;
	}
  }
}
	if(!$sql1){
				$_SESSION['fail'] = 'Sorry Number not imported';
				return 'fail';
			}
	else{
			$_SESSION['imported'] = 'imported';
			return 'imported';
		}
}
else{
	 return 'invalid upload type';
}
	}



	function tapp_template_msg(){

		$sql = "select * from tapp_template_msg where user_id = '".$_SESSION['id']."'";

		$result = $this->db->query($sql);

		if ($result->num_rows()>0) {

			$tapp_template_msg = $result->result_array();

			return $tapp_template_msg;

		}

		else{

			$tapp_template_msg = "";

			return $tapp_template_msg;

		}

	}



		function getdatamsg($id){
 		
		$sql = "select * from tapp_template_msg where id = '$id'";

		$result = $this->db->query($sql);

		if ($result->num_rows()>0) {

		return	$template_data = $result->result_array();

		}

		else{

			$template_data = 'No';

		}

	}

}

?>