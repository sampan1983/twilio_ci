<?php

defined('BASEPATH') OR exit('No direct script access allowed');
class Sent_mailModel extends CI_Model 
{
	function getsentmail()
	{
		$sql = "select * from tapp_sent_email_log where user_id = '".$_SESSION['id']."' order by date_time desc ";

		$result = $this->db->query($sql);

		if ($result->num_rows()>0) {

			$getsentmail = $result->result_array();

			return $getsentmail;

		}

		else{

			return $getsentmail = 'No';

		}

}

	function get_email($id)
	{
		$sql = $this->db->query("select * from email_log where id='$id'");
		if ($sql->num_rows()>0) {
			$data = $sql->result_array();
		return	$email_msg  = $data[0]['email'];	
		}

	}

	function delete($id)
	{
		$delete = $this->db->query("delete from tapp_sent_email_log where id='$id'");
		if ($delete) {
			$_SESSION['delete_mail'] = '1';
			return true;
		}
		else{
			$_SESSION['delete_mail'] = '0';
			return false;
		}
	}

}
?>