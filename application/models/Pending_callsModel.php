<?php

defined('BASEPATH') OR exit('No direct script access allowed');

use Twilio\Rest\Client;

class Pending_callsModel extends CI_Model {
	function get()
	{
		$sql = "select * from tapp_voice_broadcast where user_id = '".$_SESSION['id']."' order by date_time desc";
		$check = $this->db->query($sql);
		if ($check->num_rows()>0) {
			$data = $check->result_array();
			return $data;
		}
		else{
			return $data = 'No';
		}
	}

	function delete(){

		$id = $this->input->post('id');

		$delete = "delete from tapp_voice_broadcast where id = '$id'";

		$result = $this->db->query($delete);

		if ($result) {

			return true;

		}

		else{

			return false;

		}

	}



	function startpendingcall()
	{		
		$get_num = $this->db->get_where("tapp_voice_broadcast",array("readyToCall"=>'ready'));
		if ($get_num->num_rows()>0) 
		{
		$get_sid =	$get_num->result_array();	
		foreach ($get_num->result() as $get_sid) 
		{ 
			$from = $get_sid->twilio_number;  ///twilio number
			echo $to = $get_sid->user_number;   ///reciever 
			$url = $get_sid->voice_file;
			$user_id1 = $get_sid->user_id;
			$get_service_type = $this->db->get_where("tapp_twilio_number",array("number" => $from, "user_id" => $user_id1));
			if ($get_service_type->num_rows()>0) {
			$get_service = $get_service_type->result_array(); 
			$service_type = $get_service[0]['service_type']; ///service type
			$get_twilio = $this->db->query("select * from tapp_twilio_account where user_id = '".$user_id1."' and service_type = '$service_type'");
			if ($get_twilio->num_rows()>0) {
			$get_acc = $get_twilio->result_array();
			$sid = $get_acc[0]['twilio_sid'];   /////twilio sid
			$token = $get_acc[0]['twilio_token'];  ////twilio token
			}
			$AccountSid = $sid;
			$AuthToken = $token;
			$Client = new Client($AccountSid,$AuthToken);
			try
			{
			$get_num = $this->db->query("select * from tapp_voice_broadcast order by date_time limit 150");
			if ($get_num->num_rows()>0) 
			{
				$get_sid =	$get_num->result_array();			
				for ($i=0; $i <sizeof($get_sid) ; $i++) 
				{
				$user_id = $get_sid[$i]['user_id']; 				
				$id = $get_sid[$i]['id'];
				$from = $get_sid[$i]['twilio_number'];  ///twilio number
				$to = $get_sid[$i]['user_number'];   ///reciever 
				$url = $get_sid[$i]['voice_file'];
				$Client->account->calls->create( $to,
												 $from,
												 array(
													"record"=>True,
												    'url' => base_url()."/gather/".$url,
												 "method" => "GET",
												 "statusCallback" => base_url()."record",
												 "statusCallbackMethod" => "POST"
												  )
												);

			$sql1 = $this->db->query("INSERT INTO tapp_voice_broadcast_logs(twilio_number,user_number,voice_file,is_called,date_time,user_id) VALUES ('".$from."','".$to."','".$url."','no',now(),'".$user_id."')");
			if ($sql1) 
			{
			return	$delete = $this->db->query("delete from tapp_voice_broadcast where id='".$id."'");
			}
			}
			}
			}
			catch(Exception $e)
			{
				echo "delete from tapp_voice_broadcast where id='".$id."'";
			echo $e;
			return	$delete = $this->db->query("delete from tapp_voice_broadcast where id='".$id."'");
			// $file = fopen('call_bulk', 'w');
			// fwrite($file, $e);
			// fclose($file);
			}

		}
	}
		return true;
		}
		else{
			return false;
		}

	}

}

?>