<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Sent_messagesModel extends CI_Model {



function getsentmsg()

{

		$sql = "select * from tapp_sent_msg_log  ORDER BY date_time desc limit 1000 ";

		$result = $this->db->query($sql);

		if ($result->num_rows()>0) {

			$getsentmsg = $result->result_array();

			return $getsentmsg;

		}

		else{

			return $getsentmsg = 'No';

		}

}

	function deletedata(){

		$id = $this->input->post('id');
		$delete = "delete from tapp_sent_msg_log where id = '$id'";
		$result = $this->db->query($delete);

		if ($result==true) {

			$_SESSION['sent_msg_delete'] = 'Message deleted successfully';

			return true;

		}

		else{

			$_SESSION['sent_msg_delete_fail'] = 'Sorry Message was not deleted';

			return false;

		}



	}



	function search(){

		$msg_num = $this->input->post('msg_num');
		$sql = "select * from tapp_sent_msg_log where user_id = '".$_SESSION['id']."' and sms_number = '$msg_num' order by date_time desc";
		$result = $this->db->query($sql);
		if ($result->num_rows()>0) 
		{
			$data = $result->result_array();
			return $data;
		}
		else
		{
		$sql = "select * from tapp_sent_msg_log where user_id = '".$_SESSION['id']."' and message like'%$msg_num%' order by date_time desc";
		$result = $this->db->query($sql);
		if ($result->num_rows()>0) 
		{
			$data = $result->result_array();
			return $data;
		}
		else
		{
			return $data = 'No';
		}
		}
	}
	function delete_s(){
		$id = $this->input->post('select');
		if (empty($id)) {
			$_SESSION['client_del_not'] = 'Please select contact';
		}
		else{
		$select = explode(',', $id);
		for ($i=0; $i <sizeof($select) ; $i++) { 
		$delete = "delete from tapp_sent_msg_log where id = '".$select[$i]."'";
		$result = $this->db->query($delete);
		if ($result) {
		$_SESSION['client_del'] = 'Contacts deleted';
		}	
		}
		}
		}


}





?>