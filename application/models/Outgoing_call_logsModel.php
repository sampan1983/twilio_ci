<?php

defined('BASEPATH') OR exit('No direct script access allowed');
class Outgoing_call_logsModel extends CI_Model {
	function get()
	{
	$sql = "select * from tapp_voice_broadcast_logs ";
	$get = $this->db->query($sql);
	if ($get->num_rows()>0) 
	{
	return	$data = $get->result_array();
	}
	else
	{
	return $data = 'No';
	}
	}

	function delete()
	{
		$id = $this->input->post('id');
		$sql = "delete from tapp_voice_broadcast_logs where id='$id'";
		$check_sql = $this->db->query($sql);
		if ($check_sql) 
		{
			return true;
		}
		else
		{
		return false;
		}

	}



	

}

?>