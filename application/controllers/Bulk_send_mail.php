	<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Bulk_send_mail extends CI_Controller {

	public function send_bulk()
	{
					$this->load->model('Queued_mailsModel');
		$result = $this->Queued_mailsModel->sendpendingmail();
		print_r($result);

	}
}
?>