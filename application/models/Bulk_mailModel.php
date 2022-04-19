<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Bulk_mailModel extends CI_Model {

	function send_bulk()
	{
		$msg_type = $this->input->post('msg_type');
		$subject = $this->input->post('subject');
		$sending_type = $this->input->post('sending_type');
		$service_type = 'twilio';

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
			}
			/////img data
// 			$img = $_FILES['file'];

// 			if ($_FILES['file']['size'][0]==0) {

// 			 	$img = "";

// 			 } 

// 			 else{

// 					if (isset($_FILES['file'])) {

						

							

						

// 		 	for ($i=0; $i <sizeof($_FILES['file']['name']) ; $i++) { 

// 		 		$_FILES['myimg']['name'] = $_FILES['file']['name'][$i];

// 		 		$_FILES['myimg']['size'] = $_FILES['file']['size'][$i];

// 		 		$_FILES['myimg']['type'] = $_FILES['file']['type'][$i];

// 		 		$_FILES['myimg']['tmp_name'] = $_FILES['file']['tmp_name'][$i];

// 		 		$_FILES['myimg']['error'] = $_FILES['file']['error'][$i];

		 		

// 		 		$config['allowed_types'] = 'jpg|jpeg|gif|png';

// 		 		$config['file_name'] = 'img'.rand(100,1000);

// 		 		$config['upload_path'] = './upload';





// 		 	$this->load->library('upload',$config);



// 				if (!$this->upload->do_upload('myimg')) {

// 			$img = null;

// 				}

// 				else{

// 			$file_data = $this->upload->data();

// 				$img = base_url()."upload/".$file_data['file_name'];

					

// 		 		}

// 		 	}



					

// 				}

// 			}

// ///////close img data





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
  				 $sent_email_id = rand(0,500);

 		$message = stripslashes($msg);
 		$msg1 = $message;
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
		$sql = "select * from  tapp_tbl_clients where user_id ='".$_SESSION['id']."'";
		$result = $this->db->query($sql);
		$row = $result->num_rows();
 		if ($clients_name[$i] != 'select_all_clients') 
 		{
 		if ($row>0) 
 		{
		$insert_email = $this->db->query("INSERT INTO email_sent (email,sent_email_id,created_at,user_id) VALUES ('".$msg."','".$sent_email_id."',now(),'".$_SESSION['id']."')");
		$get_max = $this->db->query("SELECT max(id) from email_sent where user_id = '".$_SESSION['id']."'");
 		$data = $get_max->result_array();
 		for ($d=0; $d <sizeof($data); $d++) 
 		{ 
 		 $sent_email_id = $data[$d]['max(id)'];
 		}
 		$check_tapp_sent_msg = "select * from tapp_sent_email where email = '$clients_name[$i]' and user_id='".$_SESSION['id']."'";
		$check_tapp_sent_msg_result = $this->db->query($check_tapp_sent_msg);
		$data = $check_tapp_sent_msg_result->result_array();
		if ($check_tapp_sent_msg_result->num_rows()<1) 
		{
    	$insert_tapp_sent_msg_client = "INSERT INTO tapp_sent_email(service_type,email,message,date_time,subject,user_id) VALUES ('$service_type','$clients_name[$i]','$sent_email_id','$scheduled_time','$subject','".$_SESSION['id']."')";
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
		 	$_SESSION['clients'] = 'Congrats!  '.$counter.' mail Queued successfully';
		 	return $counter;
		 }
		 } 

		 elseif ($msg_type=='group') 
		 {
 		  $group_name = $this->input->post('group_name');
 	 	  $tapp_groups = "select * from tapp_groups where group_name = '$group_name'";
 	      $tapp_groups_result = $this->db->query($tapp_groups);
 		  if ($tapp_groups_result->num_rows()>0) 
 		  {
 		   for ($i=0; $i < $tapp_groups_result->num_rows() ; $i++) 
 		   {
 		    $tapp_groups_data = $tapp_groups_result->result_array();
 		    $email  = $tapp_groups_data[$i]['email'];
			$first_name=  $tapp_groups_data[$i]['first_name'] ;
			$last_name=  $tapp_groups_data[$i]['last_name'] ;
			$email=  $tapp_groups_data[$i]['email'] ;
			$msg=str_replace("{{COL1}}", $first_name, $msg);
			$msg=str_replace("{{COL2}}", $last_name, $msg);
			$msg= mysqli_real_escape_string($con, stripslashes($msg));

 		$tapp_groups_data_insert = "INSERT INTO tapp_sent_email(service_type,email,message,date_time,subject,user_id) VALUES ('".$service_type."','".$email."','".$sent_email_id."','scheduled_time','$subject','".$_SESSION['id']."')";

 		$tapp_groups_data_insert_result = $this->db->query($tapp_groups_data_insert);

 		if ($tapp_groups_data_insert_result==true) {

 			$_SESSION['group'] = 'Group';

 			echo 'group';

 		}

 		else
 			{  		$_SESSION['group_fail'] = 'Sorry there was an error to import group number';
		 		return 'group_fail';
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



  $email = trim($allDataInSheet[$i]["A"]);

  $insert_email = $this->db->query("INSERT INTO email_sent (email,sent_email_id,created_at,user_id) VALUES ('".$msg."','".$sent_email_id."',now(),'".$_SESSION['id']."')");
 $get_max = $this->db->query("SELECT max(id) from email_sent");
 $data = $get_max->result_array();
 for ($d=0; $d <sizeof($data); $d++) { 
 		$sent_email_id = $data[$d]['max(id)'];
 }


try

{


echo	 "INSERT INTO tapp_sent_email(service_type,email,message,date_time,subject) VALUES ('".$service_type."','".$email."','".$sent_email_id."','".$scheduled_time."','".$subject."')";



 $sql1 = $this->db->query("INSERT INTO tapp_sent_email(service_type,email,message,date_time,subject,user_id) VALUES ('".$service_type."','".$email."','".$sent_email_id."','".$scheduled_time."','".$subject."','".$_SESSION['id']."')");



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

else{

	 return 'invalid upload type';

}
	}

}
?>