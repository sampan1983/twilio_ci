<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Outgoing_callsModel extends CI_Model {



	function getnum(){

		$sql = "select * from tapp_twilio_number where user_id = '".$_SESSION['id']."' and service_type='twilio'";

		$check = $this->db->query($sql);

		if ($check->num_rows()>0) {

			$data = $check->result_array();

			return $data;

		}

		else{

			return $data = 'No';

		}

	}

	function blacklist($elem){

		$sql = "select * from tapp_blacklist where number = '$elem' and user_id = '".$_SESSION['id']."'";

		$check = $this->db->query($sql);

		if ($check->num_rows()>0) {

			return 'Number is blacklisted';

		}

		else{

			return 'Ready';

		}

	}




}

?>