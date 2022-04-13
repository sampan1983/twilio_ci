<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Received_messagesModel extends CI_Model {



	function getdata()

	{

		$sql = "select * from tapp_msg_receive where user_id = '".$_SESSION['id']."' group by sender order by date_time desc";

		$result = $this->db->query($sql);

		if ($result->num_rows()>0) {

			$data = $result->result_array();

			return $data;

		}

		else{

			return $data = 'No';

		}

	}

	function search(){

			$month = $this->input->post('month');

			$year = $this->input->post('year');



		$sql = "SELECT * FROM tapp_msg_receive WHERE user_id = '".$_SESSION['id']."' and MONTH( date_time ) = '$month' AND YEAR( date_time ) = '$year' ORDER BY date_time DESC";

		$result = $this->db->query($sql);

		if ($result->num_rows()>0) {

		return	$data_recieve = $result->result_array(); 

		}

		else{

			return $data_recieve = 'No';

		}

		}



		function searchnum(){

		$msg_num = $this->input->post('msg_num');
		$sql = "select * from tapp_msg_receive where user_id = '".$_SESSION['id']."' and (sender ='$msg_num' OR body like '%$msg_num%') order by date_time desc";
		$result = $this->db->query($sql);
		if ($result->num_rows()>0) 
		{
		return	$data_recieve = $result->result_array(); 
		}
		else
		{
			return $data_recieve = 'No';
		}
		}



}

?>

