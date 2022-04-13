<?php



defined('BASEPATH') OR exit('No direct script access allowed');



use Twilio\Rest\Client;



class ChatModel extends CI_Model {







		function getChat(){



			$number = $_SESSION['number'];



			$sql = "SELECT body,sending_status,sender,date_time FROM table_data where sender='$number'  ORDER BY date_time DESC";



			$result = $this->db->query($sql);



			if ($result->num_rows()>0) {



				$chatdata = $result->result_array();



				return $chatdata;



			}



			else{



				return $chatdata = 'No';



			}







		}







		function gettwilio(){



			$number = $_SESSION['number'];



			$sql = "SELECT sender,twilio_num from tapp_msg_receive where sender='$number' order by date_time desc limit 1";



			$result = $this->db->query($sql);



			if ($result->num_rows()>0) {



				$data = $result->result_array();



				return $data;



			}



		}







		function sendmsg(){



			$twilio_num = $this->input->post('twilio_num');



			$number = $this->input->post('number1');



			$msg = str_replace("'", "\'", $this->input->post('msg'));



			$sql = "select * from tapp_twilio_number where number= '$twilio_num'";



			$result = $this->db->query($sql);



			if ($result->num_rows()>0) {



				$data = $result->result_array();



				$service_type = $data[0]['service_type'];	



				$sql1 = "select * from tapp_twilio_account where service_type= '$service_type'";



				$result1 = $this->db->query($sql1);



				if ($result1->num_rows()>0) {



				$data1 = $result1->result_array();



				$sid = $data[0]['twilio_sid'];



				$token = $data[0]['twilio_token'];



				$service_type = $data[0]['service_type'];



				if ($service_type=='twilio') {

			

					$status = 'S';



					$insert = "insert into table_data(sender,body,date_time,sending_status) values('$number','$msg',now(),'$status')";



					$get = $this->db->query($insert);



					if ($get) {

						$client = new Client($sid, $token);

						$response = $client->messages->create(

									$number,

									array(

										'from' => $twilio_num,

										'body' => $msg,										

									)

								);



						return 'send';



					}



				}



				else{







					$fail = "INSERT INTO tapp_sent_msg_failed(sms_number,twilio_num,message,date_time) VALUES ('$number','$twilio_num','$msg',now())";



					$faildata = $this->db->query($fail);



					if ($faildata) {



											$_SESSION['fail_chat'] = "Sorry! SMS couldn't sent to ".$number;



											return 'not in table data';



					}







				}







							}



							else{



				$fail = "INSERT INTO tapp_sent_msg_failed(sms_number,twilio_num,message,date_time) VALUES ('$number','$twilio_num','$msg',now())";



					$faildata = $this->db->query($fail);



					if ($faildata) {	



										$_SESSION['fail_chat'] = "Sorry! SMS couldn't sent to ".$number;



											return 'Not in twilio account';



					}



							}			



			}



			else{



				$fail = "INSERT INTO tapp_sent_msg_failed(sms_number,twilio_num,message,date_time) VALUES ('$number','$twilio_num','$msg',now())";



					$faildata = $this->db->query($fail);



					if ($faildata) {



							$_SESSION['fail_chat'] = "Sorry! SMS couldn't sent to ".$number;



											return 'not in twilio number ';



					}







			}



		}











		function delete(){



			$number = $_POST['number1'];



			$delete = "delete from table_data where sender='$number'";



			$data_tabledelete = $this->db->query($delete);



			if ($data_tabledelete) {



			$delete_msg = "delete from tapp_msg_receive where sender='$number'";



			$data_tapp_msg_receive = $this->db->query($delete_msg);



			if ($data_tapp_msg_receive) {



			return true;



			}



			else{



				return false;



			}



			}



			else{



				return false;



			}



		}







}



?>