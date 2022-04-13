<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Sbf extends CI_Controller {

public function send_bulk(){

				$this->load->model('Pending_faxModel');
			$result = $this->Pending_faxModel->send_bulk();
			print_r($result);
		}
}
?>
