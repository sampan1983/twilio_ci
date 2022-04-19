<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Recieve_msg extends CI_Controller 
{
	public function receivedmsg()
	{	$this->load->model('Received_messages_newModel');
		$result = $this->Received_messages_newModel->receivedmsg();
		echo $result;
	}
}
?>
