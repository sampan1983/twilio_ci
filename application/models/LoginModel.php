<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class LoginModel extends CI_Model {



	function loginfun()
	{
		

	$email = $this->input->post('username');
	$password = $this->input->post('password');
	$sql = "select * from tapp_user_login where email = '$email'";
	$check = $this->db->query($sql);
	
	if ($check->num_rows()==1) 
	{

	 	$data = $check->result_array();
  		$dpassword = $data[0]['password'];
		if (password_verify($password, $dpassword)) 
		{
  		
	 	 	$_SESSION['logged_in'] = true;
	 	 	$_SESSION['welcm'] = '1';
	 	 	$_SESSION['name'] = $data[0]['user_name'];
	 	 	$_SESSION['user'] = $data[0]['email'];
	 	 	$_SESSION['type'] = $data[0]['type'];
	 	 	$_SESSION['id'] = $data[0]['id'];
	 	 	return true;
		}
	 	else
	 	{
 	 		return 'wrong';
	 	}
	}
	 else
	 {
	 	return 'wrong';
	 } 
	}

}
?>

