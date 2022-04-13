<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Failed_numbersModel extends CI_Model {



	function  getdata(){

		$sql = "select * from tapp_sent_msg_failed where user_id = '".$_SESSION['id']."' order by date_time desc";

		$result = $this->db->query($sql);

		if ($result->num_rows()>0) {

		return	$failed_data = $result->result_array();

		}

		else{

			return 'No';

		}

	}

	function delete($id){

		$delete = "delete from tapp_sent_msg_failed where id = '$id'";

		$check = $this->db->query($delete);

		if ($check==true) {

			$_SESSION['delete'] = 'Message deleted successfully';

			return 'deleted';

		}

		else{

			$_SESSION['delete_fail'] = 'Message not deleted';

			return false;

		}

	}

	function failedmsglog()
	{
		$sql = "SELECT * FROM tapp_sent_msg_failed where user_id = '".$_SESSION['id']."' and date(date_time)=date(now())";
		$result = $this->db->query($sql);
		return $result->num_rows();
	}
}

?>