<?php
header('Content-type: text/xml');
defined('BASEPATH') OR exit('No direct script access allowed');

class Fax_recieve extends CI_Controller {

	public function get_fax()
	{ ?>
	<Response>
 	<Receive action="https://emarketing.ecetek.com/smsapp/Fax_recieve/set_fax"></Receive>
	</Response>
<?php }
	public function set_fax() {
		$id = $this->input->post('FaxSid');
		$from = $this->input->post('From');
		$to = $this->input->post('To');
		$fax_url = $this->input->post("MediaUrl");
		$new_to = substr($to, 1);
		$recieve = $this->db->query("INSERT INTO fax_receive (fax_id,fax_number,twilio_num,fax_url,created_at) VALUES ('".$id."','".$from."','".$new_to."','".$fax_url."',now())");
		if ($recieve) {
			// $this->set_status_header(200);
        	// $this->output->set_output('');
		}
		else{
			$this->set_status_header(201);
		}
	}
}
?>