<?php

defined('BASEPATH') OR exit('No direct script access allowed');



	class Sent_faxModel extends CI_Model {
		function getdata(){
		$get_data = $this->db->query('select * from fax_sent_log where user_id = "'.$_SESSION['id'].'"');
		if ($get_data->num_rows()>0) {
			return	$data_get = $get_data->result_array();
			}
			else{
				return $data_get = 'No';
			}	
		}

		function delete($id){

			$delete = $this->db->query("delete from fax_sent_log where id = '$id'");
			if ($delete) {
				$_SESSION['delete_fax_sent_log'] = '1';
				return true;
			}
			else{
				$_SESSION['delete_fax_sent_log'] = '0';
				return false;
			}
		}


}
?>
