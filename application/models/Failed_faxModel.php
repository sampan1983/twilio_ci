<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Failed_faxModel extends CI_Model {

	function getfailed(){
		$sql = $this->db->query("select * from fax_sent_failed where user_id = '".$_SESSION['id']."' order by created_at desc");
		if ($sql->num_rows()>0) {
		return	$fail_data = $sql->result_array();
		}
		else{
			return $fail_data = 'No';
		}
	}

	function delete($id){
		$delete = $this->db->query("delete from fax_sent_failed where id='$id'");
		if ($delete) {
			$_SESSION['delete_fax_fail'] = '1';
			return true;
		}
		else{
			$_SESSION['delete_fax_fail'] = '0';			
			return false;
		}
	}

}
?>
