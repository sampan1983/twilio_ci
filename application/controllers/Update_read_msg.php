<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Update_read_msg extends CI_Controller {
	public function index()
	{
		$sql = "Update tapp_msg_receive set read_status = 'Y' where user_id = '".$_SESSION['id']."'";
		$result = $this->db->query($sql);
		redirect('Received_messages');
	}

}

?>

