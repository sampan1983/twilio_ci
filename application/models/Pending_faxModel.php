<?php

defined('BASEPATH') OR exit('No direct script access allowed');
use Twilio\Rest\Client;


class Pending_faxModel extends CI_Model {
	function get_pending_data(){
		$get = $this->db->query("select * from tapp_sent_msg where user_id = '".$_SESSION['id']."' and fax_type is NOT NULL");
		if ($get->num_rows()>0) 
		{
		return	$get_pending = $get->result_array();
		}
		else
		{
			return $get_pending = 'No';
		}
	}
	function delete($id){
		$delete = $this->db->query("delete from tapp_sent_msg where id='$id'");
		if ($delete) {
			$_SESSION['pending'] = '1';
			return true;
		}
		else{
			$_SESSION['pending'] = '0';
			return false;
		}
	}

	function send_bulk()
	{
		error_reporting(E_ALL);
		ini_set("display_errors", 1);
		$mediaUrl = '';
		$date_time = date('Y-m-d h:i:s');
		$check_service = $this->db->query("select * from tapp_sent_msg where scheduled_time < now() and fax_type = 'fax' order by date_time desc limit 140");
		$check_service_type = $check_service->result_array();
		for ($i=0; $i <sizeof($check_service_type) ; $i++) { 
		$service_type = $check_service_type[$i]['service_type'];
		$user_id1 = $check_service_type[$i]['user_id'];
		if ($service_type=='twilio') {
			$get_twilio_data = $this->db->query("select * from tapp_twilio_account where user_id = '".$user_id1."' and service_type='twilio'");
			$row = $get_twilio_data->result_array();
			for ($d=0; $d <sizeof($row) ; $d++) { 
				$sid = $row[$d]['twilio_sid'];
				$token = $row[$d]['twilio_token'];
				$service_type = $row[$d]['service_type'];
			}
			$AccountSid = $sid;
			$AuthToken = $token;

			$query = $this->db->query("select * from  tapp_sent_msg where scheduled_time < now() and fax_type = 'fax' order by date_time desc limit 140");
			$row = $query->result_array();
				for ($c=0; $c <sizeof($row) ; $c++) { 
				$check_blacklist = $this->db->query("select * from tapp_blacklist where user_id = '".$row[$c]['user_id']."' and number like '%".$row[$c]['sms_number']."%'");
				if ($check_blacklist->num_rows<1) {
				$id = $row[$c]['id'] ;
		$number = $row[$c]['sms_number'] ;
		$num = "+".$number;
		$twilio_number = $row[$c]['twilio_num'];
		$tnum = "+".$twilio_number;
		$url = $row[$c]['fax_url'];
		$user_id = $row[$c]['user_id'];

		try{

			$twilio = new Client($AccountSid,$AuthToken);
			$fax = $twilio->fax->v1->faxes
                ->create($num,
                           $url,
                            array("from" => $tnum)
                       );
                print_r($fax);
         $fax_id = $fax->sid;
			 $success = $this->db->query("INSERT INTO fax_sent_log (fax_id,fax_number,twilio_num,fax_url,created_at,user_id) VALUES ('".$fax_id."','".$num."
        ','".$twilio_number."','".$url."',now(),'".$user_id."')");
			 if ($success) {
			 	echo "DB insertion success";
			 }
			  else{
        	 echo "DB insertion fail";
        }

        $delete = $this->db->query("delete from tapp_sent_msg  where id='".$id."'");
        if($delete){ 
					echo "Data deletion success";
				}
				else {
					echo "Data not inserted";
				}
		}
		catch(Exception $e){
			echo $e;
			$fax_id = '';
			$failed = $this->db->query("INSERT INTO fax_sent_failed (fax_id,fax_number,twilio_num,fax_url,created_at,user_id) VALUES ('".$fax_id."','".$num."','".$twilio_number."','".$url."',now(),'".$user_id."')");
			if ($failed) {

				        $delete = $this->db->query("delete from tapp_sent_msg  where id='".$id."'");
        if($delete){ 
					echo "Data deletion success";
				}
				else {
					echo "Data not inserted";
				}
				
			}
			else{
				echo "No DB";
			}
		}
				}
				else{
					echo "Blacklist";
				}
				}
		
		}
	}
		
	}
}
?>