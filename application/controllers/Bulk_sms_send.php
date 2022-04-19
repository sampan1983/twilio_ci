<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Bulk_sms_send extends CI_Controller {

	public function sentpendingmsg()
	{
		$this->load->model('Pending_numbersModel');
	$result = $this->Pending_numbersModel->sentpendingmsg();
	$re = print_r($result);
	}

}
?>
