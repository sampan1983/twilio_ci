<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class User_listModel extends CI_Model {



	function get()
	{
		if ($_SESSION['type']=='super admin')
		{
		$sql = "select * from tapp_user_login ";
		$result = $this->db->query($sql);
		if ($result->num_rows()>0) {
		return $data = $result->result_array();
		}
		else{
			$data = 'No';
		}
		}
		else
		{
		$sql = "select * from tapp_user_login where id = '".$_SESSION['id']."' ";
		$result = $this->db->query($sql);
		if ($result->num_rows()>0) {
		return $data = $result->result_array();
		}
		else{
			$data = 'No';
		}
		}
		
	}

	function getuser()
	{
		$getuser = $this->db->query("SELECT * FROM tapp_user_login");
		if ($getuser->num_rows()>0) 
		{
		$user_data = $getuser->result_array();
		for ($i=0; $i <sizeof($user_data) ; $i++) { 
		$username = $this->db->query("SELECT * FROM tapp_twilio_account where user_id = '".$user_data[$i]['id']."'");
		if ($username->num_rows()<1)
		 {
		  	$data1[] = ($user_data[$i]);
		  }	
		}
		}
		return ($data1);
	}

	function getuser2()
	{
		if ($_SESSION['type'] == 'super admin') {
		$getuser = $this->db->query("SELECT * FROM tapp_user_login");	
		}
		else{
		$getuser = $this->db->query("SELECT * FROM tapp_user_login where id = '".$_SESSION['id']."'");
		}
		if ($getuser->num_rows()>0) 
		{
		$user_data = $getuser->result_array();
		for ($i=0; $i <sizeof($user_data) ; $i++) 
		{ 
	  	$data1[] = ($user_data[$i]);
		}
		}
		return ($data1);
	}

	function edit(){
		$id = $this->input->post('id');
		$user = $this->input->post('user_name');
		$email = $this->input->post('email');
		$old_email = $this->input->post('email_old');
		$password = $this->input->post('password');
		if ($password != '**************************' ) {
			$password = password_hash($password, PASSWORD_DEFAULT);			
		}
		$date_time_now = $this->db->query("SELECT now()");
		$date = $date_time_now->result_array();
		$date_time = $date[0]['now()'];
		if (($_FILES['profileimage']['name'])) {
				for ($i=0; $i <sizeof($_FILES['profileimage']['name']) ; $i++) { 
		 		$_FILES['myimg']['name'] = $_FILES['profileimage']['name'][$i];
		 		$_FILES['myimg']['size'] = $_FILES['profileimage']['size'][$i];
		 		$_FILES['myimg']['type'] = $_FILES['profileimage']['type'][$i];
		 		$_FILES['myimg']['tmp_name'] = $_FILES['profileimage']['tmp_name'][$i];
		 		$_FILES['myimg']['error'] = $_FILES['profileimage']['error'][$i];
				$config['allowed_types'] = 'jpg|jpeg|gif|png';
		 		$config['file_name'] = 'img'.rand(100,1000);
		 		$config['upload_path'] = './img/avatars/';
		 	$this->load->library('upload',$config);
			if (!$this->upload->do_upload('myimg')) {
			$img = "null";
				}
			else{
			 $file_data = $this->upload->data();
			 $img = $file_data['file_name'];
		 		}
		 	}
			}
		if ($email==$old_email) {
			if ($img=="null") {
				if ($password != '**************************' ) {
					$edituser = "update tapp_user_login set user_name = '$user', password = '$password', date_time = '$date_time' where id = '$id'"; 
					}
				else
				{
				$edituser = "update tapp_user_login set user_name = '$user', date_time = '$date_time' where id = '$id'"; 
				}
				$resultedituser = $this->db->query($edituser);
				if ($resultedituser) {
				$_SESSION['user_updated'] = 'User updated successfully';
				return 'updated';
				}
				else{
				return false;
				}
			}
			else
			{
		if ($password != '**************************') {
			$edituser = "update tapp_user_login set user_name = '$user', password = '$password', profile_image = '$img', date_time = '$date_time' where id = '$id'"; 
		}
		else{
			$edituser = "update tapp_user_login set user_name = '$user', profile_image = '$img', date_time = '$date_time' where id = '$id'"; 
			}
			$resultedituser = $this->db->query($edituser);

			if ($resultedituser) {

				$_SESSION['user_updated'] = 'User updated successfully';

				return 'updated';

			}

			else{

				return false;

			}

		}



}

else{
	$check = "select * from tapp_user_login where email = '$email'";
	$resultcheck = $this->db->query($check);
	if ($resultcheck->num_rows()>0) {
		return 'already';
		}
	else{
		if ($img=="null") {
		  if ($password != '**************************') {
  		  $edituser = "update tapp_user_login set user_name = '$user', password = '$password', email = '$email', date_time = '$date_time' where id = '$id'";
  		  }			
		  else {
				$edituser = "update tapp_user_login set user_name = '$user', email = '$email', date_time = '$date_time' where id = '$id'"; 
			}
			$resultedituser = $this->db->query($edituser);
			if ($resultedituser) {
				$_SESSION['user_updated'] = 'User updated successfully';
				return 'updated';
			}
			else{
				return false;
			}

			}
			else
			{
			if ($password != '**************************') {
			$edituser = "update tapp_user_login set user_name = '$user', email = '$email', password = '$password', profile_image = '$img', date_time = '$date_time' where id = '$id'";	
			}
			else
			{
		  $edituser = "update tapp_user_login set user_name = '$user', email = '$email', profile_image = '$img', date_time = '$date_time' where id = '$id'";
			}
			$resultedituser = $this->db->query($edituser);
			if ($resultedituser) {
				return 'updated';
			}
			else{
				return false;
			}
		}
	}
}
}	

		function delete(){

			$id = $this->input->post('id');

			$delete = "delete from tapp_user_login where id = '$id'";

			$check = $this->db->query($delete);

			if ($check) {

				return true;

			}

			else{

				return false;

			}

		}

		function add()
		{
			$name =$this->input->post('username');
			$email = $this->input->post('email');
			$password = $this->input->post('password');
			if (!empty($password))
			 {
			   $password = password_hash($password, PASSWORD_DEFAULT);
			  }
			if (($_FILES['profileimage']['name']))
			{
			  for ($i=0; $i <sizeof($_FILES['profileimage']['name']) ; $i++) 
			  { 
		 		$_FILES['myimg']['name'] = $_FILES['profileimage']['name'][$i];
		 		$_FILES['myimg']['size'] = $_FILES['profileimage']['size'][$i];
		 		$_FILES['myimg']['type'] = $_FILES['profileimage']['type'][$i];
		 		$_FILES['myimg']['tmp_name'] = $_FILES['profileimage']['tmp_name'][$i];
		 		$_FILES['myimg']['error'] = $_FILES['profileimage']['error'][$i];
		 		$config['allowed_types'] = 'jpg|jpeg|gif|png';
		 		$config['file_name'] = 'img'.rand(100,1000);
		 		$config['upload_path'] = './img/avatars/';
			 	$this->load->library('upload',$config);
				if (!$this->upload->do_upload('myimg'))
				 {
				 	$img = '';
				}
				else
				{
				 $file_data = $this->upload->data();
				 $img = $file_data['file_name'];
		 		}
		 	  }
			}
			$check_email = $this->db->get_where('tapp_user_login',array('email' => $email ));
			if ($check_email->num_rows()<1) {
			
			if (empty($img))
			{
			$sql = $this->db->query("INSERT INTO tapp_user_login (user_name,email,password)values('".$name."','".$email."','".$password."')");
			}
			else
			{
			$sql = $this->db->query("INSERT INTO tapp_user_login (user_name,email,password,profile_image)values('".$name."','".$email."','".$password."','".$img."')");	
			}
			if ($sql) {
			return true;
			}
			else
			{
				return false;
			}
		}
		else{
			return false;
		}
		}
}

?>

