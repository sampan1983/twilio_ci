<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Add_twilio_accountModel extends CI_Model 
{
	function get()
	{
		if ($_SESSION['type']=='super admin') 
		{
			$sql = "select * from tapp_twilio_account";
			$check = $this->db->query($sql);
			if ($check->num_rows()>0) 
			{
			  return	$data = $check->result_array();
			}
			else
			{
			return $data = 'No';
			}			
		}
		else
		{
		$sql = "select * from tapp_twilio_account where user_id = '".$_SESSION['id']."'";
			$check = $this->db->query($sql);
			if ($check->num_rows()>0) 
			{
			  return	$data = $check->result_array();
			}
			else
			{
			return $data = 'No';
			}	
		}

	}



	function edit(){

		$id = $this->input->post('id');
		$service_type = $this->input->post('service_type');
		$sid = $this->input->post('sid');
		$token = $this->input->post('token');
		$copilet_msg_service_id = $this->input->post('copilet_msg_service_id');

				$app = $this->input->post('app_sid');

		$update = "update tapp_twilio_account set service_type='$service_type',twilio_sid='$sid',twilio_token='$token', app_sid = '".$app."' , copilet_msg_service_id = '".$copilet_msg_service_id."' where id='$id'";
		$result = $this->db->query($update);
		if ($result) 
		{
		  $user_id = $this->db->query("SELECT * FROM tapp_twilio_account where twilio_sid = '".$sid."' and twilio_token = '".$token."'");
		  if ($user_id->num_rows()>0) 
		  {
		  	$acc_data = $user_id->result_array();
		  	$user_id = $acc_data[0]['user_id'];
		  	$update_twilio_num = $this->db->query("UPDATE tapp_twilio_number SET twilio_sid = '".$sid."' , twilio_token = '".$token."' where user_id = '".$user_id."' ");
		  	if ($update_twilio_num) {
		  		return true;
		  	}
		  }
		}

		else{

			return false;

		}

	}



	function delete()
	{

		$id = $this->input->post('id');

		$delete = "delete from tapp_twilio_account where id = '$id'";

		$result = $this->db->query($delete);

		if ($result) {

			return true;

		}

		else{

			return false;

		}

	}
	function add()
	{
	$service_type = $this->input->post('service_type');
	$sid = $this->input->post('sid');
	$token = $this->input->post('token');
	$app = $this->input->post('app_sid');
	$copilet_msg_service_id = $this->input->post('copilet_msg_service_id');
	if ($_SESSION['type']=='super admin') 
	{
	$user_id = $this->input->post('user_id');	
	}
	else
	{
	$user_id = $_SESSION['id'];
	}
	$data  = array('service_type' => $service_type,
					'twilio_sid' => $sid,
					'twilio_token' => $token,
					'user_id' => $user_id,
					'app_sid' => $app,
					'copilet_msg_service_id'=>$copilet_msg_service_id
				  );	
	$this->db->insert('tapp_twilio_account', $data);
	}







}

?>

