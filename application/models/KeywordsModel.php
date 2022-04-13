<?php



defined('BASEPATH') OR exit('No direct script access allowed');

class KeywordsModel extends CI_Model 

{

	function get(){

	$sql = "select * from tapp_unsub_keywords where user_id = '".$_SESSION['id']."'";

	$get = $this->db->query($sql);

	if ($get->num_rows()>0) 

	{

  	 $data = $get->result_array();

	 return $data;

	}

	else

	{

	  return $data = 'No';

	}

	}



	function edit()

	{

	 $id = $this->input->post('id');

  	  $key = str_replace("'", "\'", $this->input->post('keyword'));

	  $msg = str_replace("'", "\'", $this->input->post('message'));



	 

	 $checkkey = "SELECT keyword FROM `tapp_unsub_keywords` WHERE id = '$id'";

	 $getkey = $this->db->query($checkkey);

	 if ($getkey->num_rows()>0) 

	{

  	 $getkeyword = $getkey->result_array();

	 $keyword = $getkeyword[0]['keyword'];

	}

	if ($keyword==$key) 

	{

 	 $update_msg = "update tapp_unsub_keywords set message = '$msg' where id = '$id'";

	 $get_msg = $this->db->query($update_msg);

	if ($get_msg) 

	{

		return true;

	}

	else

	{

		return false;

	}

	}



		else{



		echo $check = "select * from tapp_unsub_keywords where keyword = '$key'";
exit();


		$result = $this->db->query($check);







		if ($result->num_rows()>0) {



			return false;



		}



		else{



			$update = "update tapp_unsub_keywords set keyword = '$key' , message = '$msg' where id = '$id'";



			$check = $this->db->query($update);



			if ($check) {



				return true;



			}



			else{



				return false;



			}



		}



	}



	}



	function delete($id){



		$sql = "delete from tapp_unsub_keywords where id = '$id'";



		$check = $this->db->query($sql);



		if ($check) {



			return true;



		}



		else{



			return false;



		}



	}







	function add()

	{

		 $key = $this->db->escape($this->input->post('keyword'));

		 $msg = $this->db->escape($this->input->post('message'));


		$sql = "select * from tapp_unsub_keywords where keyword=$key and user_id = ".$_SESSION['id'];

		$check = $this->db->query($sql);


		if ($check->num_rows()>0) 

		{
		

			return false;

		}

		else

		{
			
   
		$insert = "insert into tapp_unsub_keywords (keyword,message,date_time,user_id,type)values($key,$msg,now(),'".$_SESSION['id']."','".$_SESSION['type']."')";

		$result = $this->db->query($insert);

		if ($result) 

		{

			return true;

		}

		else

		{

			return false;

		}

		}

	}



}



?>