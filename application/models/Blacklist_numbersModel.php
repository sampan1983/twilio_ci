<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Blacklist_numbersModel extends CI_Model 
{
	function addnum()
	{
		$number = $this->input->post('number');
		$sql = "select * from tapp_blacklist where number = '$number' and user_id = '".$_SESSION['id']."'";
		$check = $this->db->query($sql);
		if ($check->num_rows()>0) 
		{
			$_SESSION['blacklist_already'] = 'This number is already exists';
			return 'already';
		}
		else
		{
			$insert = "insert into tapp_blacklist (number,datetime,user_id)values('$number',now(),'".$_SESSION['id']."')";
			$insert_data = $this->db->query($insert);
			if ($insert_data==true) 
			{
				$_SESSION['blacklist_added'] = 'Number has been added to blacklist';
				return 'inserted';
			}
			else
			{
				return false;
			}

		}
	}



	function getdata()
	{
	  $sql = "select * from tapp_blacklist where user_id = '".$_SESSION['id']."'";
	  $result = $this->db->query($sql);
	  if ($result->num_rows()>0) 
	 {
      $data = $result->result_array();
      return $data;
	 }
	  else
	 {
	  return $data = "No";
	  }
	}

	function delete_blacklist($i)
	{
		$sql = "delete from tapp_blacklist where id = '$i'";
		$check = $this->db->query($sql);
		if ($check==true) 
		{
			$_SESSION['delete_blacklist'] = 'Number has been deleted';
			return 'delete';
		}
		else
		{
			return false;
		}
	}

}

?>

