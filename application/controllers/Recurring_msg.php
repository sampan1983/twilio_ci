<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use Twilio\Rest\Client;


class Recurring_msg extends CI_Controller {
    
	public function recurring_data_send(){
        $this->load->model('Recurring_msgModel');
        $result = $this->Recurring_msgModel->send_recurring();
        print_r($result);
    }

}
?>
