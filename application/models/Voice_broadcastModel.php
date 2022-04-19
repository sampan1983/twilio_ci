<?php
error_reporting(0);
defined('BASEPATH') OR exit('No direct script access allowed');
class Voice_broadcastModel extends CI_Model {
	function getnum()
	{
	$sql = "select * from tapp_twilio_number where user_id = '".$_SESSION['id']."'";
	$result = $this->db->query($sql);
	if ($result->num_rows()>0) 
	{
      return	$data = $result->result_array();
	}
	else
	{
  	  return	$data = 'No';
	}
	}

	function get_voice_broadcast()
	{
	$call_type = $this->input->post('call_type');
	$twilio_number = $_POST['twilio_number'];
	$agent_number = $_POST['agent_number'];
	////voice file 
	if(isset($_FILES["file1"]["name"]) )
	{
  	 $temp = explode(".", $_FILES["file1"]["name"]);
  	 $target_dir =  base_url();
 	 if(end($temp) == 'mp3' || end($temp) == '.mp3')
 	 {
	  $new_filename = round(microtime(true)) . '.' . end($temp);
	  move_uploaded_file($_FILES["file1"]["tmp_name"], "voice_upload/" . $new_filename);
	  $mediaUrl = $new_filename;
 	 }
  	 else
  	 {
	  return   $_SESSION['failure_message_invalid'] = 'Invalid File Format For Audio File';
	  // header('Location: '.base_url().'Voice_broadcast');
	  die();
 	  } 
	}
	else{
     		return	$_SESSION['xlsx_error'] = 'Please add audio file';
	    	// echo 'No contact file found';
	    	// redirect('Voice_broadcast');
		}		
		 ////end
	 if ($call_type=='clients') 
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
		$sql = "select * from  tapp_tbl_clients";
		$result = $this->db->query($sql);
		$row = $result->num_rows();
 		if ($clients_name[$i] != 'select_all_clients') 
 		{
		 if ($row>0) 
		 {
		  $name_data = $result->result_array();
          $name = $name_data[$counter]['first_name'];
    	  $check_tapp_sent_msg = "select * from tapp_voice_broadcast where user_number = '$clients_name[$i]'";
		  $check_tapp_sent_msg_result = $this->db->query($check_tapp_sent_msg);
		  if ($check_tapp_sent_msg_result->num_rows()<1) 
		  {
		  	// echo "INSERT INTO tapp_voice_broadcast(twilio_number,user_number,voice_file,agent_number,date_time,user_id) VALUES ('$twilio_number','$clients_name[$i]','$mediaUrl','0000000',now(),'".$_SESSION['id']."')";
		 	$insert_tapp_voice_broadcast_client = "INSERT INTO tapp_voice_broadcast(twilio_number,user_number,voice_file,agent_number,date_time,user_id) VALUES ('$twilio_number','$clients_name[$i]','$mediaUrl','0000000',now(),'".$_SESSION['id']."')";
		 	$result_insert_tapp_voice_broadcast_client = $this->db->query($insert_tapp_voice_broadcast_client);
		 	if ($result_insert_tapp_voice_broadcast_client==true) 
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
 elseif ($call_type=='group') 
 {

 	$group_name = $this->input->post('group_name');

 	$tapp_groups = "select * from tapp_groups where group_name = '$group_name'";

 	$tapp_groups_result = $this->db->query($tapp_groups);

 	if ($tapp_groups_result->num_rows()>0) {

 		for ($i=0; $i < $tapp_groups_result->num_rows() ; $i++) { 

 		$tapp_groups_data = $tapp_groups_result->result_array();

 		$number  = $tapp_groups_data[$i]['number'];
		$tapp_groups_data_insert = "INSERT INTO tapp_voice_broadcast(twilio_number,user_number,voice_file,agent_number,date_time,user_id) VALUES ('$twilio_number','$number','$mediaUrl','0000000',now(),'".$_SESSION['id']."')";

 		$tapp_groups_data_insert_result = $this->db->query($tapp_groups_data_insert);

 		if ($tapp_groups_data_insert_result==true) {

 			$_SESSION['flash_message'] = 'Congrats! numbers imported successfully.';

 			// return 'group';

 		}

 		else{  		$_SESSION['failure_message'] = 'Sorry! there was an error to import numbers.';

 			// return 'group_fail';



 		}



 	}

 	}

 	else{  	

 		// $_SESSION['group_fail'] = 'Sorry there is no group selected';

 		return 'group_fail';



 	}

 	

 	

 }

else if($call_type=='file'){

		if ($_FILES['file']['name']=='') {

	$_SESSION['xlsx_error'] = 'Please add number file';

	echo 'No contact file found';

	 header('Location: '.base_url().'Voice_broadcast');

}

		$allowedExts = array("xlsx","txt","csv");

		$extension = explode(".", $_FILES["file"]["name"]);

	if ($extension!=".xlsx" || $extension!=".txt" && ($_FILES["file"]["size"] < 90000000) && in_array($extension, $allowedExts))

{

if ($_FILES["file"]["error"] > 0)

		{

			$_SESSION['xlsx_error'] = 'There is an error in your file';

	echo "Return Code: " . $_FILES["file"]["error"] . "<br />";



}

else

{

	// $file=$_FILES["file"]["name"];

// $file = $temp[0].".".$temp[1];

// $temp[0] = rand(0, 3000); //Set to random number

// $file;

if (file_exists("../xls/imageDirectory/" . $_FILES["file"]["name"]))

{		

	$_SESSION['file_exists'] = 'Sorry this name of file is already exists';

		echo $_FILES["file"]["name"] . " already exists. ";





}

else

{

$temp = explode(".",$_FILES["file"]["name"]);

$newfilename = rand(1,89768) . '.' .end($temp);

move_uploaded_file($_FILES["file"]["tmp_name"],"upload1/".$newfilename);

//echo "Stored in: " . "upload/" . $_FILES["file"]["name"];

// "upload1/".$newfilename;

 // "upload1/".$newfilename;

								}

										}	

															}

		else

	{

		$_SESSION['invalid_xlsx'] = 'Invalid file';

		echo "Invalid file";

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





					} catch(Exception $e) {

						// $_SESSION['error_loading'] = $e->getMessage();



 die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());





}

$allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);



$arrayCount = count($allDataInSheet);  // Here get total count of row in that Excel sheet

for($i=1;$i<=$arrayCount;$i++){





$sm = trim($allDataInSheet[$i]["A"]);





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





$sm17=str_replace("&", "", $sm16);





$sm19=str_replace("<", "", $sm17);





$sm20=str_replace(">", "", $sm19);





$sm21=str_replace("<", "", $sm20);





$sm22=str_replace("?", "", $sm21);





$sm23=str_replace("_", "", $sm22);





$sms_number=str_replace("#", "", $sm23);





//$sms_number='+1'.$sms_number;





//echo $sms_number;



$sms_number=$sms_number;

try

{



$sql1 = $this->db->query("INSERT INTO tapp_voice_broadcast(twilio_number,user_number,voice_file,agent_number,date_time,user_id) VALUES ('".$twilio_number."','".$sms_number."','".$mediaUrl."','0000000',now(),'".$_SESSION['id']."')");



}

catch(Exception $e)

{

echo $e;

}



}





}













if(!$sql1)

		{

			$_SESSION['failure_message'] = 'Sorry! there was an error to import numbers.';

		}

		else{

			$_SESSION['flash_message'] = 'Congrats! numbers imported successfully.';

		}

		

 header('Location: '.base_url().'Bulk_Voice_Broadcast');

ob_flush();

			 }
		}
}

?>

