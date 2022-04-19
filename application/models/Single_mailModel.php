<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Single_mailModel extends CI_Model {

	function send()
	{	require '../sendgrid/vendor/autoload.php';
		$to_email = $this->input->post('email');
		$message_type = $this->input->post('message_type');
		$user_id = $this->input->post('user_id');
		if($message_type== 'custom')
				{
				$message = $this->input->post('message');
				}
				else
				{
				$message = $this->input->post('message1');
				}
				$subject = $_POST['subject'];
				$email = new \SendGrid\Mail\Mail(); 
				$email->setFrom("info@emarketing.ecetek.com", "PCNails eMarketing");
				$email->setSubject($subject);
				$email->addTo($to_email);
				$email->addContent("text/html", $message);
				// print_r($email);
				$apikey = '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';
				$sendgrid = new \SendGrid($apikey);
try
{
    $response = $sendgrid->send($email);
    $status = $response->statusCode();
	if($status=="200" || $status=="201" || $status=="202")
	{
		$str = str_replace(PHP_EOL, '', $message);
		$message= stripslashes($str);
		$message= str_replace('rnrn','',$str);
		$msg= str_replace('\r',' ',$message);
  		$message = preg_replace('/\s+/', ' ', $msg);
		$add_mail = $this->db->query("insert into email_log(email,sent_email_id,created_at,user_id)values('".$message."','N/A',now(),'".$user_id."')");
  		$get_max = $this->db->query("SELECT max(id) from email_log");
  		$data = $get_max->result_array();
  		$sent_email_id = $data[0]['max(id)'];
  		$sql1 = $this->db->query("INSERT INTO tapp_sent_email_log(service_type,email,twilio_num,message,date_time,user_id) VALUES (' ','".$to_email."',' ','".$sent_email_id."',now(),'".$user_id."')");
	   $_SESSION['flash_message'] = 'Mail has been sent to '.$to_email;
    }
	}
	catch(Exception $e)
	{
		    echo 'Caught exception: '. $e->getMessage() ."\n";
    $_SESSION['failure_message'] = 'Mail has been not sent to '.$to_email;
	}
}

}
?>

