<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class ClientModel extends CI_Model { 

	function get(){
		$sql = "select * from tapp_tbl_clients where user_id = '".$_SESSION['id']."' order by date_time desc";
		$result = $this->db->query($sql);
		if ($result->num_rows()>0)
		{
		  $data = $result->result_array();
		  return $data;
		}
		else
		{
		  $data = 'No';
		  return $data;
		}
	}



	function add(){

		$name = $this->input->post('first_name');
		$name=str_replace("(", "", $name);
		$name=str_replace(")", "", $name);
		$name=str_replace("'", "_", $name);
		$name=str_replace('"', '', $name);

		$email = $this->input->post('email');
		$mail=str_replace("(", "", $email);
		$mail=str_replace(")", "", $mail);
		$mail=str_replace("'", " ", $mail);
		$email=str_replace('"', '', $mail);

		$mobile = $this->input->post('mobile');
		$sm1=str_replace("(", "", $mobile);
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
		$sm17 = str_replace("&", "", $sm16);
		$sm19 = str_replace("<", "", $sm17);
		$sm20 = str_replace(">", "", $sm19);
		$sm21 = str_replace("<", "", $sm20);
		$sm22 = str_replace("?", "", $sm21);
		$sm23 = str_replace("_", "", $sm22);
		$mobile = str_replace("#", "", $sm23);

	if(strlen($mobile) == 10)
	{
	$mobile = '1'.$mobile;		
	}
	$address = $this->input->post('address');
	$add=str_replace("(", "<", $address);
	$add=str_replace(")", ">", $add);
	$add=str_replace("'", "_", $add);
	$address=str_replace('"', '^', $add);
	$check = "select * from tapp_tbl_clients where user_id = '".$_SESSION['id']."' and email= '$email' ";
	$conn = $this->db->query($check);
	if ($conn->num_rows()>0) 
	{
			$check = "select * from tapp_tbl_clients where user_id = '".$_SESSION['id']."' and sender = '$mobile'";
	$conn = $this->db->query($check);
	if ($conn->num_rows()>0) 
	{
	return 'already';
		}
	else{
	$insert = "insert into tapp_tbl_clients(sender,first_name,last_name,email,country,date_time,address,postal_code,job_title,job_location,lead_date,interest_level,source,status,user_id,user_type) values('$mobile','$name','','$email','',now(),'$address','','','','','','','','".$_SESSION['id']."','".$_SESSION['type']."')";
	$result = $this->db->query($insert);
	if ($result==true) {
	$_SESSION['add_client'] = 'Contact added successfully';
	return 'added';
	}
	}
		}
	else{
	$insert = "insert into tapp_tbl_clients(sender,first_name,last_name,email,country,date_time,address,postal_code,job_title,job_location,lead_date,interest_level,source,status,user_id,user_type) values('$mobile','$name','','$email','',now(),'$address','','','','','','','','".$_SESSION['id']."','".$_SESSION['type']."')";
	$result = $this->db->query($insert);
	if ($result==true) {
	$_SESSION['add_client'] = 'Contact added successfully';
	return 'added';
	}
	}
	}

	function edit(){

		$id = $this->input->post('id');

		$name = $this->input->post('first_name');
		$name=str_replace("(", "", $name);
		$name=str_replace(")", "", $name);
		$name=str_replace("'", "_", $name);
		$name=str_replace('"', '', $name);
	
		$email = $this->input->post('email');
		$mail=str_replace("(", "", $email);
		$mail=str_replace(")", "", $mail);
		$mail=str_replace("'", " ", $mail);
		$email=str_replace('"', '', $mail);

		$mobile = $this->input->post('mobile');
		$sm1=str_replace("(", "", $mobile);
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
		$sm17 = str_replace("&", "", $sm16);
		$sm19 = str_replace("<", "", $sm17);
		$sm20 = str_replace(">", "", $sm19);
		$sm21 = str_replace("<", "", $sm20);
		$sm22 = str_replace("?", "", $sm21);
		$sm23 = str_replace("_", "", $sm22);
		$mobile = str_replace("#", "", $sm23);

		if(strlen($mobile) == 10)
		{
		$mobile = '1'.$mobile;
		}
		$address = $this->input->post('address');
		$add=str_replace("(", "<", $address);
		$add=str_replace(")", ">", $add);
		$add=str_replace("'", "_", $add);
		$address=str_replace('"', '^', $add);

		$sql = "select * from tapp_tbl_clients where email = '$email' and address = '$address' and first_name = '$name' and sender = '$mobile'";
		$check = $this->db->query($sql);
		if ($check->num_rows()>0) {
		return 'already';
		}
		else{
		$update = "update tapp_tbl_clients set email = '$email' , address = '$address' , sender = '$mobile' , first_name = '$name' , date_time=now() where id = '$id'";
		$result = $this->db->query($update);
		if ($result==true) {
		$_SESSION['edit_client'] = 'Contact updated successfully';
		return 'edited';
		}
		}
		}

	function delete(){
		$id = $this->input->post('id');
		$delete = "delete from tapp_tbl_clients where id = '$id'";
		$result = $this->db->query($delete);
		if ($result==true) {
			$_SESSION['client_del'] = 'Contact delete successfully';
			return true;
		}
	}

	function delete_s(){
		$id = $this->input->post('select');
		echo $id;
		if (empty($id)) {
			$_SESSION['client_del_not'] = 'Please select contact';
		}
		else{
			$select = explode(',', $id);
			for ($i=0; $i <sizeof($select) ; $i++) { 
				$delete = "delete from tapp_tbl_clients where id = '$select[$i]'";
				$result = $this->db->query($delete);
				if ($result==true) {
					$_SESSION['client_del'] = 'Contacts deleted';
				}	
			}
		}
		}

	function getnum($id){
		$sql = "select * from tapp_tbl_clients where id = '$id'";
		$check = $this->db->query($sql);
		if ($check->num_rows()==1) {
			$data = $check->result_array();
			return $data;
		}
		else{
			return false;
		}
		}
	}

?>