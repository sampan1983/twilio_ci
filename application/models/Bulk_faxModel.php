<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Bulk_faxModel extends CI_Model {

	function get_bulk_fax(){
	
	$msg_type = $this->input->post('msg_type');

		$sending_type = $this->input->post('sending_type');

		$service_type = $this->input->post('service_type');





		if ($sending_type=='scheduled') {

		$scheduled = $this->input->post('scheduled');

		$time = $this->input->post('time');

		$scheduled_time = $scheduled.' '.$time.':00';

		}

		else{	$stime = "select now()";

				$scheduled_time = $this->db->query($stime);

				if ($scheduled_time) {

					$scheduled = $scheduled_time->result_array();

					$scheduled_time = $scheduled[0]['now()'];

				}

			// $scheduled_time =	str_replace(" ' ","" , $scheduled_time);		

		}

		$twilio_number = $this->input->post('twilio_number');

		$message_type = $this->input->post('message_type');

	if($message_type== 'custom')

				{



				$message = $this->input->post('mymessage');

							}

				else{

							$message = $this->input->post('message');

							}



				$str = str_replace(PHP_EOL, '', $message);

			$message= stripslashes($str);

					 $message= str_replace('rnrn','',$str);

					 $msg= str_replace('\r',' ',$message);

  				 $msg = preg_replace('/\s+/', ' ', $msg);

  				 /* $message =  $_POST['message'] ; */
$faxtype = $_POST['faxtype'];
if(!empty($faxtype)) {
	$message = " ";
}
else{
	$faxtype = " ";
}

$cnt='';
$mediaUrl ='';


if(isset($_FILES["file1"]["name"]) && $_FILES["file1"]["name"] != '')
{
   $temp = explode(".", $_FILES["file1"]["name"]);
$newfilename = round(microtime(true)) . '.' . end($temp);
move_uploaded_file($_FILES["file1"]["tmp_name"], "fax_files/" . $newfilename);
 $mediaUrl = base_url().'fax_files/'.$newfilename;
}

if ($msg_type=='clients') {

	$counter = 0;

	$already = 0;

	$count = sizeof($this->input->post('clients_name'));

	if ($count==0) {

		return 'no contact';

	}

 	$clients_name = $this->input->post('clients_name');

 	for ($i=0; $i < $count ; $i++) 
 	{ 
	  $sql = "select * from  tapp_tbl_clients where user_id = '".$_SESSION['id']."'";
	  $result = $this->db->query($sql);
	  $row = $result->num_rows();
	if ($clients_name[$i] != 'select_all_clients') 
	{
 	 if ($row>0)
	 {
		$name_data = $result->result_array();
		$name = $name_data[$counter]['first_name'];
		$check_tapp_sent_msg = "select * from tapp_sent_msg where user_id = '".$_SESSION['id']."' and sms_number = '$clients_name[$i]'";
		$check_tapp_sent_msg_result = $this->db->query($check_tapp_sent_msg);
		if ($check_tapp_sent_msg_result->num_rows()<1)
		 {
			$insert_tapp_sent_msg_client = "INSERT INTO tapp_sent_msg(service_type,sms_number,message,twilio_num,fax_url,bulk_name,date_time,scheduled_time,fax_type,user_id) VALUES ('".$service_type."','".$clients_name[$i]."','".$msg."','".$twilio_number."','".$mediaUrl."','".$name."',now(),'".$scheduled_time."','".$faxtype."','".$_SESSION['id']."')";
		 	$result_insert_tapp_sent_msg_client = $this->db->query($insert_tapp_sent_msg_client);
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
	$_SESSION['clients_fail'] = 'Sorry There was an error to import contact';
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
 	$tapp_groups = "select * from tapp_groups where group_name = '$group_name' and user_id = '".$_SESSION['id']."'";
 	$tapp_groups_result = $this->db->query($tapp_groups);
 	if ($tapp_groups_result->num_rows()>0) 
 	{
	for ($i=0; $i < $tapp_groups_result->num_rows() ; $i++) { 
	$tapp_groups_data = $tapp_groups_result->result_array();
	$number  = $tapp_groups_data[$i]['number'];
	$tapp_groups_data_insert = "INSERT INTO tapp_sent_msg(service_type,sms_number,message,twilio_num,fax_url,bulk_name,date_time,scheduled_time,fax_type,user_id) VALUES ('".$service_type."','".$number."','".$msg."','".$twilio_number."','".$mediaUrl."','".$group_name."',now(),'".$scheduled_time."','".$faxtype."','".$_SESSION['id']."')";
	$tapp_groups_data_insert_result = $this->db->query($tapp_groups_data_insert);
	if ($tapp_groups_data_insert_result==true) 
	{
	$_SESSION['group'] = 'Group';
	return 'group';
	}
	else
	{
		$_SESSION['group_fail'] = 'Sorry there was an error to import group number';
		return 'group_fail';
	}
 	}
 	}
 	else
 	{  	
 		return 'group_fail';
 	}
 }
else if($msg_type=='file')
{
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
		$file;
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
try 
{
  $objPHPExcel = PHPExcel_IOFactory::load($inputFileName);
}
catch(Exception $e) 
{
 die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
  return $e;
}
$allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
$arrayCount = count($allDataInSheet);  // Here get total count of row in that Excel sheet
	for($i=1;$i<=$arrayCount;$i++)
	{
	  $sms_number = trim($allDataInSheet[$i]["A"]);
		try
		{
		 $sql1 = $this->db->query("INSERT INTO tapp_sent_msg(service_type,sms_number,message,twilio_num,fax_url,bulk_name,date_time,scheduled_time,fax_type,user_id) VALUES ('".$service_type."','".$sms_number."','".$msg."','".$twilio_number."','".$mediaUrl."','".$file."',now(),'".$scheduled_time."','".$faxtype."','".$_SESSION['id']."')");
		}
		catch(Exception $e)
		{
		 echo $e;
		}
	}
}
if(!$sql1)
{
	$_SESSION['fail'] = 'Sorry Number not imported';
	return 'fail';
}
else{
	$_SESSION['imported'] = 'imported';
	return 'imported';
	}
}
else
{
 return 'invalid upload type';
}
}
}

?>