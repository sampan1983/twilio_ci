<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Queued_mailsModel extends CI_Model {

	function getdata()
	{
		$sql = $this->db->query("select * from tapp_sent_email where user_id = '".$_SESSION['id']."'");
		if ($sql->num_rows()>0) {
			$data = $sql->result_array();
			return $data;
		}
		else{
			return $data = 'No';
		}
	}

	function getid($id){

			$sql1 = $this->db->query("select * from email_sent where id='$id'");
			if ($sql1->num_rows()>0) {
				$data = $sql1->result_array();
			return $email = $data[0]['email'];
			}
			else{
			return	$data = 'No';
			}
			

		}

			function delete($id)
	{
		$delete = $this->db->query("delete from tapp_sent_email where id='$id'");
		if ($delete==true) {
			$_SESSION['delete_mail'] = '1';
			return true;
		}
		else{
			$_SESSION['delete_mail'] = '0';
			return false;
		}
	}

	function sendpendingmail(){
		require '../sendgrid/vendor/autoload.php';
		$getmail = $this->db->query("select * from tapp_sent_email where date_time < now() order by date_time desc limit 70 "); 
		 $getmail->num_rows();
		if ($getmail->num_rows()>0) 
		{
		$data_mail = $getmail->result_array();
		for ($i=0; $i <sizeof($getmail->num_rows()) ; $i++) 
		{ 
		$pending_id = $data_mail[$i]['id'];
		$to_email = $data_mail[$i]['email'];
		$id_pending = $data_mail[$i]['message'];
		$subject = $data_mail[$i]['subject'];
		$user_id = $data_mail[$i]['user_id'];
		$getpending = $this->db->query("select * from email_sent where id='$id_pending'");
		$num_rows =	$getpending->num_rows();
		if ($getpending->num_rows()>0) {
		$pending = $getpending->result_array(); 
		for ($d=0; $d <sizeof($num_rows) ; $d++) { 
		echo	$message = $pending[$d]['email'];

				$email = new \SendGrid\Mail\Mail(); 
$email->setFrom("info@emarketing.ecetek.com", "PCNails eMarketing");
$email->setSubject($subject);
$email->addTo($to_email);
$email->addContent("text/html", $message);
// print_r($email);
 $apikey = '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';
 $sendgrid = new \SendGrid($apikey);

try{

	    $response = $sendgrid->send($email);
	     $status = $response->statusCode();
	       if($status=="200" || $status=="201" || $status=="202"){
	       				$str = str_replace(PHP_EOL, '', $message);
			$message= stripslashes($str);
					 $message= str_replace('rnrn','',$str);
					 $msg= str_replace('\r',' ',$message);
  				 $message = preg_replace('/\s+/', ' ', $msg);

  				 $add_mail = $this->db->query("insert into email_log(email,sent_email_id,created_at,user_id)values('".$message."','N/A',now(),'$user_id')");
  				 $get_max = $this->db->query("SELECT max(id) from email_log");
  				$data = $get_max->result_array();
  				
  				 	$sent_email_id = $data[0]['max(id)'];
  				 	 $sql1 = $this->db->query("INSERT INTO tapp_sent_email_log(service_type,email,twilio_num,message,date_time,user_id) VALUES (' ','".$to_email."',' ','".$sent_email_id."',now(),'$user_id')");
 "delete from tapp_sent_email where id='$pending_id'";
  				 	$delete_pending = $this->db->query("delete from tapp_sent_email where id='$pending_id'");
	   $_SESSION['flash_message'] = 'Mail has been sent to '.$to_email;
  				 



	       }
	}
	catch(Exception $e){
		echo $e;
		    echo 'Caught exception: '. $e->getMessage() ."\n";
    $_SESSION['failure_message'] = 'Mail has been not sent to '.$to_email;
	}
				
			}
			}
		}
	}
	}
	
	}

?>
