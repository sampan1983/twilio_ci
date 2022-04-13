<?php



defined('BASEPATH') OR exit('No direct script access allowed');

use Twilio\Rest\Client;





class Received_messages_newModel extends CI_Model {



		function getnewrecieve(){

			$sql = "select * from tapp_msg_receive";

			$result = $this->db->query($sql);

			if ($result->num_rows()>0) {

				$new_recieve = $result->result_array();

				return $new_recieve;

			}

			else{

				return $new_recieve = 'No';

			}

		}



		function delete($id){

			$delete = "delete from tapp_msg_receive where id = '$id'";

			$delete_result = $this->db->query($delete);

			if ($delete_result) {

				$_SESSION['receive_new_delete'] = 'Message has been deleted';

				return 'deleted';

			}

			else{

			return 'Failed';

			}

		}



		function search(){

			$month = $this->input->post('month');

			$year = $this->input->post('year');

			$sql = "SELECT * FROM tapp_msg_receive WHERE user_id = '".$_SESSION['id']."' AND MONTH( date_time ) = '$month' AND YEAR( date_time ) = '$year' ORDER BY date_time DESC";

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

			$sql = "select * from tapp_msg_receive where user_id = '".$_SESSION['id']."' and sender='$msg_num' order by date_time desc";

			$result = $this->db->query($sql);

			if ($result->num_rows()>0) {

				return	$data_recieve = $result->result_array(); 

			}

			else{

				$sql = "select * from tapp_msg_receive where user_id = '".$_SESSION['id']."' and body like '%$msg_num%'  order by date_time desc";

				$result = $this->db->query($sql);

				if ($result->num_rows()>0) {

					return	$data_recieve = $result->result_array(); 

				}

				else{

					return $data_recieve = 'No';

				}

			}

		}



		function chat($id){

			$sql = "select * from tapp_msg_receive where id = '$id'";

			$result = $this->db->query($sql);

			if ($result->num_rows()==1) {

				$numData = $result->result_array();

				$number = $numData[0]['sender'];

				$_SESSION['number'] = $number;

				return $number;

			}

			else{

				return $number = 'No';

			}

		}



		function chatnum($r){

			$sql  = "update tapp_msg_receive set read_status='Y' where sender='$r'";

			$result = $this->db->query($sql);

			if ($result) {

			return $r;

			}

			else{

			return "Can't open this msg";

			}

			}



		function receivedmsglog(){

			$sql = "select * from tapp_msg_receive where user_id = '".$_SESSION['id']."' and date(date_time) = date(now())";

			$result = $this->db->query($sql);

			return $result->num_rows();

			}



		function receivedmsg()

		{

		$from = $_POST['From'];

		$body = $_POST['Body'];

		$to = substr($_POST['To'], 1);
		// $from = '1111111111';

		// $body = 'test_next';
		

		// $to = '19038586739';

		$media = $_POST['mediaUrl'];

		$from =	str_replace('+' ,"", $from);

		$date_time = $this->db->query("select now()");

		$get_data = $this->db->query("SELECT * FROM tapp_twilio_number where number = '".$to."'");

		if ($get_data->num_rows()>0) {

			$data = $get_data->result_array();

			$user_id = $data[0]['user_id'];

		}

		if(strtolower($body)=='stop'){

			$in = $this->db->query("insert into tapp_blacklist (number,keyword,datetime,user_id)values('$from','$body',now(),'".$user_id."')");

		}

		$insert = $this->db->query("insert into tapp_msg_receive (sender,body,date_time,twilio_num,user_id)values('$from','$body',now(),'$to','".$user_id."')");

		if ($insert) {

			$sqlrec5 = $this->db->query("insert into table_data (sender,body,date_time,sending_status,user_id) values('".$from."','".$body."',now(),'R','".$user_id."')");

			$insert_data = 'true';	

			$check_auto = $this->db->query("select * from tapp_unsub_keywords where user_id = '".$user_id."' and keyword='$body'");
			

			if ($check_auto->num_rows()>0) {

				$msg = $check_auto->result_array();

				$body1 = $msg[0]['message'];
				$str = str_replace(PHP_EOL, '', $body1);
		$body1= stripslashes($str);
		$body1= str_replace('rnrn','',$str);
		$body1= str_replace('\r',' ',$body1);
	
		$body1 = str_replace("'", "\'", $body1);

				$get_sid = $this->db->query("select * from tapp_twilio_number where user_id = '".$user_id."' and number = '$to'");

				if ($get_sid->num_rows()>0) {
					

					// $res=$this->db->query("select * from tapp_create_groups where name='$body'");

					// if($res->num_rows()>0){

					// 	$result=$res->result_array();

					// 	$group_id=$result[0]['id'];

					// 	$check_group_data = $this->db->get_where('tapp_groups',array('fk_group_data'=>$group_id,'group_name'=>$body,'number'=>$from));

						

					// 	if ($check_group_data->num_rows()==0) {

					// 		$this->db->query("insert into tapp_groups(group_name,number,fk_group_data,date_time) values('$body','$from','$group_id',now())");     

					// 	}

					// }

					// 	else{

					// 	$add_group_name = $this->db->query("insert into tapp_create_groups(name,user_id) values('$body','$user_id')");

					// 	$last_id=$this->db->insert_id();

					// 	$add_group = $this->db->query("insert into tapp_groups(group_name,number,fk_group_data,date_time) values('$body','$from','$last_id',now())");

					// }
                     
					$twilio_data = $get_sid->result_array();

					$sid = $twilio_data[0]['twilio_sid'];

					$twilio_token = $twilio_data[0]['twilio_token'];

					$service_type = $twilio_data[0]['service_type'];

					$scheduled_time = date('d-m-Y H:i:s', strtotime("+2 min"));	
					$minutes_to_add = 2;

$time = new DateTime(date('d-m-Y H:i:s'));
$time->add(new DateInterval('PT' . $minutes_to_add . 'M'));

$scheduled_time = $time->format('Y-m-d H:i:s');

$now = date('Y-m-d H:i:s');

					$num = '+'.$to;

					// $client = new Client($sid, $twilio_token);

					// $response = $client->messages->create(

					// $from,

					// array(

					// 'from' => $to,

					// 'body' => $body1,

					// 			)

					// 			);
                 
					$insert_msg_log = "INSERT INTO tapp_sent_msg(service_type, sms_number, message, twilio_num,date_time,scheduled_time,user_id) VALUES ('twilio','$from','$body1','$num','$now','$scheduled_time','".$user_id."')";

					$result_insert_tapp_sent_msg_client = $this->db->query($insert_msg_log);

					// $insert = $this->db->query("insert into tapp_msg_receive (sender,body,date_time,twilio_num,user_id)values('$from','$body1',now(),'$to','".$user_id."')");

					// if ($insert) {

					// 	$sqlrec5 = $this->db->query("insert into table_data (sender,body,date_time,sending_status,user_id) values('".$from."','".$body."',now(),'R','".$user_id."')");

					// 	$insert_data = 'true';

					// }

				}

			}

		}

		else{

			$insert_data = 'fail';

		}


		// $get_num = $this->db->query("select * from tapp_twilio_number where user_id = '".$user_id."' and number='$to'");

		// $data = $get_num->result_array();

		//  $f_num = "+".$data[0]['msg_forward'];

		// $sid = $data[0]['twilio_sid'];

		// $twilio_token = $data[0]['twilio_token'];

		//  $num = $to;
		// if (!empty($f_num)) {

		// $client = new Client($sid, $twilio_token);

		// $response = $client->messages->create(

  //   		$f_num,

		// 	array(

  //       	'from' => $num,

  //       	'body' => $body,

  //       ));

		// }

		}

		

	function delete_s(){

	$id = $this->input->post('select');

	if (empty($id)) {

		$_SESSION['client_del_not'] = 'please select contact';

	}

	else{

	$select = explode(',', $id);

	for ($i=0; $i <sizeof($select) ; $i++) { 

	$delete = "delete from tapp_msg_receive where id = '$select[$i]'";

	$result = $this->db->query($delete);

	if ($result==true) {

	$_SESSION['client_del'] = 'Messages deleted successfully';

	}

	}

	}

	}

}



?>



