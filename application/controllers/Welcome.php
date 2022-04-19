<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->view('welcome_message');
	}
}
$2y$10$pWNKak1uB58Cd0owDl4WgurvvaQppEOu8.TPg2Omv1OTnk6HimH9q

e10adc3949ba59abbe56e057f20f883e



// $check_msg = "go2020";
// if ($check_msg=='go2020') {
// 	echo "IN OF COND";


// $msg_ask = 'Would you like more info ?';

// 	$AccountSid = $sid;
// 	$AuthToken = $token;

// 	$client = new Services_Twilio($AccountSid, $AuthToken);

// 	try{
// 		echo "IN OF TRY";
// 		$sms = $client->account->message->sendMessage($to,$from,$msg_ask);

// 		$send_ask_msg = mysqli_query($con,"insert into tapp_sent_msg_log(sms_number,twilio_num,message,date_time,'bulk_name')values('".$from."','".$to."','".$msg_ask."',now(),'".$unique_id."')");
// 	}
// 	catch(Exception $e){
// 		echo "IN OF Exception";
// 		echo $e->getMessage();
// 		$failed_msg_ask = mysql_query($con,"insert into tapp_sent_msg_failed(sms_number,twilio_num,message,bulk_name,date_time)values('".$from."','".$to."','".$msg_ask."','".$unique_id."',now())");
// 	}
// }
	
// 	$msg_ans = strtolower('no');
// 	if ($msg_ans=="yes") {

// 	$msg = 'Congratulations! To enter the contest please provide your first and last name. By entering you agree to these terms and conditions (link to https://pocketplanner.io/terms) Send "STOP" to stop receiving messages';
// 	$AccountSid = $sid;
// 	$AuthToken = $token;
// 	$client = new Services_Twilio($AccountSid, $AuthToken);
// 	try {
// 		$sms = $client->account->messages->sendMessage($to,$from,$msg);
// 		$send_msg = mysqli_query($con,"insert into tapp_sent_msg_log (sms_number,twilio_num,message,date_time,bulk_name)values('".$from."','".$to."','".$msg."',now(),'".$unique_id."')");
// 	}
// 	catch (Exception $s) {
// 		echo $s->getMessage();
// 	$sql1 = mysqli_query($con,"INSERT INTO tapp_sent_msg_failed(sms_number,twilio_num,message,bulk_name,date_time) VALUES ('".$from."','".$to."','".$msg."','".$unique_id."',now())");
// 	}

// }

