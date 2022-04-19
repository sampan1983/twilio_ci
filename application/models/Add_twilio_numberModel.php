<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Add_twilio_numberModel extends CI_Model {

	function gettwilionum()
	{
		if ($_SESSION['type']=='super admin')
		{
		$sql = "select * from tapp_twilio_number";
		$result = $this->db->query($sql);
		if ($result->num_rows()>0) {
			$twilio_numbers = $result->result_array();
			return $twilio_numbers;
		}
		else
		{
			return "No";
		}			
		}
		else
		{
		$sql = "select * from tapp_twilio_number where user_id = '".$_SESSION['id']."' ";
		$result = $this->db->query($sql);
		if ($result->num_rows()>0)
		 {
			$twilio_numbers = $result->result_array();
			return $twilio_numbers;
		}
		else{
			return "No";
		}
		}
	}

	function addnum()
	{
		$sid = $this->input->post('user_id');
		$num = $this->input->post('num');
		$is_default = $this->input->post('is_default');
		$fsmsnum = $this->input->post('smsforward');
		$fcallnum = $this->input->post('callforward');
		if (!empty($fsmsnum)) 
		{
		  if (strlen($fsmsnum)<11) {
			$fsmsnum = '1'.$fsmsnum;
			}
		  else if(strlen($fsmsnum)>11){
			$fsmsnum = substr($fsmsnum, 1);
			}
		}
		if (!empty($fcallnum)) 
		{
		 if (strlen($fcallnum)<11) {
			$fcallnum = '1'.$fcallnum;
		  }
		 else if(strlen($fcallnum)>11){
			$fcallnum = substr($fcallnum, 1);
		  }	
		}
		if (strlen($num)<11) {
			$num = '1'.$num;
		}
		else if(strlen($num)>11){
			$num = substr($num, 1);
		}
		if ($is_default=='yes') {
		$sql = "update tapp_twilio_number set is_default='no' where user_id = '".$sid."'";
		$result = $this->db->query($sql);
		}
		$get_service_type = "select * from tapp_twilio_account where user_id='".$sid."'";
		$result_get_service_type = $this->db->query($get_service_type);
		if ($result_get_service_type->num_rows()>0) {
			$tapp_twilio_account = $result_get_service_type->result_array();
			$twilio_sid = $tapp_twilio_account[0]['twilio_sid']; 
			$token = $tapp_twilio_account[0]['twilio_token'];
			$service_type = $tapp_twilio_account[0]['service_type'];
			$copilet_msg_service_id = $tapp_twilio_account[0]['copilet_msg_service_id'];
		$check_num = "select * from tapp_twilio_number where number = '$num' ";
		$result_check_num = $this->db->query($check_num);
		if ($result_check_num->num_rows()>0) {
		return 'already';
		}
		else{
		$email=	$_SESSION['user']; 

		$insert_tapp_twilio_number = "insert into tapp_twilio_number (service_type,number,twilio_sid,twilio_token,email,is_default,date_time,msg_forward,call_forward,user_id,copilet_msg_service_id) values('$service_type','$num','$twilio_sid','$token','$email','$is_default',now(),'$fsmsnum','$fcallnum','$sid','$copilet_msg_service_id')";
		$result_insert_tapp_twilio_number = $this->db->query($insert_tapp_twilio_number);
		if ($result_insert_tapp_twilio_number) {
		$_SESSION['num_added'] = 'Number has been added successfully';
		return 'inserted';
		}
		}
	}
	else{
	return false;
	}
	}

	function delete(){
		$id = $this->input->post('id');
		$sql = "delete from tapp_twilio_number where id = '$id'";
		$result = $this->db->query($sql);
		if ($result) {
		$_SESSION['num_deleted'] = 'Number has been deleted successfully';
		return 'deleted';
		}
		else{
			return false;
		}
	}



	function gettype(){
		if ($_SESSION['type']=='super admin') 
		{
		$sql = "select * from tapp_twilio_account ";
		$result = $this->db->query($sql);
		if ($result->num_rows()>0) 
		{
			$twilio_acc_data = $result->result_array();
			return $twilio_acc_data;
		}
		else
		{
		 return $twilio_acc_data = 'No';
		}
		}
		else
		{
		$sql = "select * from tapp_twilio_account where user_id = '".$_SESSION['id']."'";
		$result = $this->db->query($sql);
		if ($result->num_rows()>0) 
		{
			$twilio_acc_data = $result->result_array();
			return $twilio_acc_data;
		}
		else
		{
		 return $twilio_acc_data = 'No';
		}	
		}
		
	}

	function edit(){
		$id = $this->input->post('id');
		$sid = $this->input->post('sid');
		$num = $this->input->post('num');
	   	$is_default = $this->input->post('isvalue');
        $fsmsnum = $this->input->post('fsmsnum');
        $fcallnum = $this->input->post('fcallnum');
       if (!empty($fsmsnum)) 
		{
		  if (strlen($fsmsnum)<11) {
			$fsmsnum = '1'.$fsmsnum;
			}
		  else if(strlen($fsmsnum)>11){
			$fsmsnum = substr($fsmsnum, 1);
			}
		}
		if (!empty($fcallnum)) 
		{
		 if (strlen($fcallnum)<11) {
			$fcallnum = '1'.$fcallnum;
		  }
		 else if(strlen($fcallnum)>11){
			$fcallnum = substr($fcallnum, 1);
		  }	
		}
		if (strlen($num)<11) {
			$num = '1'.$num;
		}
		else if(strlen($num)>11){
			$num = substr($num, 1);
		}
		$check_default = "select  tapp_twilio_number.is_default from tapp_twilio_number where id = '$id'";
		$result_check_default = $this->db->query($check_default);
		if ($result_check_default) {
		$default_is = $result_check_default->result_array();
		$is = $default_is[0]['is_default'];
		if ($is == 'no') {
		if ($is_default=='yes') {
		$sql = "update tapp_twilio_number set is_default='no' where client_name = '".$_SESSION['id']."'";
		$result = $this->db->query($sql);
		}
		}
		}
		$get_service_type = "select * from tapp_twilio_account where user_id='$sid'";
		$result_get_service_type = $this->db->query($get_service_type);
		if ($result_get_service_type->num_rows()>0) {
			$tapp_twilio_account = $result_get_service_type->result_array();
			$twilio_sid = $tapp_twilio_account[0]['twilio_sid'];
			$token = $tapp_twilio_account[0]['twilio_token'];

			$service_type = $tapp_twilio_account[0]['service_type'];

$check_num = "select * from tapp_twilio_number where number = '$num' and msg_forward='$fsmsnum' and call_forward='$fcallnum' and service_type = '$service_type' and twilio_sid = '$twilio_sid' and twilio_token = '$token' and is_default = '$is_default' ";



		$result_check_num = $this->db->query($check_num);



		if ($result_check_num->num_rows()>1) {



			return 'already';



		}



		else{







		$edit = "update tapp_twilio_number set service_type = '$service_type',number='$num',twilio_sid='$twilio_sid',twilio_token='$token',is_default='$is_default',msg_forward='$fsmsnum',call_forward='$fcallnum',date_time=now() where id='$id'";



		$result = $this->db->query($edit);



		if ($result) {



			$_SESSION['number_edit'] = 'Twilio number updated successfully';



			return true;



		}



		else{



			return false;



		}







	}















}



else{



	return false;



}



}

function editforward()

{

	  $id = 	$this->input->post('id');

  $call = 	$this->input->post('call');

  $msg = 	$this->input->post('msg');

  		$edit = "update tapp_twilio_number set call_forward = '$call', msg_forward ='$msg' where id='$id'";



		$result = $this->db->query($edit);



		if ($result) {



			$_SESSION['number_edit'] = 'forward number updated successfully';



			return true;



		}



		else{



			return false;



		}



}



}



?>