<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Fax_inboxModel extends CI_Model {
	function get_data(){
		$get = $this->db->query('SELECT * FROM fax_receive where user_id = "'.$_SESSION['id'].'" ORDER BY created_at DESC');
		if ($get->num_rows()>0) {
	return	$get_inbox = $get->result_array();
		}
		else{
			return $get_inbox = 'No';
		}
	}
	function delete($id){
		$delete = $this->db->query("delete from tapp_sent_msg where id='$id'");
		if ($delete) {
			$_SESSION['inbox'] = '1';
			return true;
		}
		else{
			$_SESSION['inbox'] = '0';
			return false;
		}
	}

	function get_fax(){
		$id = $_REQUEST['FaxSid'];
		$from = trim($_REQUEST['From']);
		$to = trim($_REQUEST['To']);
		$fax_url = $_REQUEST['MediaUrl'];
		$new_to = substr($to, 1);
		$get = $this->db->query("SELECT * from tapp_twilio_number where number = '".$new_to."'");
		$da = $get->result_array();
		$user_id = $da[0]['user_id'];
		$recieve = $this->db->query("INSERT INTO fax_receive (fax_id,fax_number,twilio_num,fax_url,created_at,user_id) VALUES ('".$id."','".$from."','".$new_to."','".$fax_url."',now(),'".$user_id."')");
		if ($recieve) {
			echo "Success";
		}
		else{
			echo "failed";
		}
	}
}
?>