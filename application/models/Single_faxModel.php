<?php

defined('BASEPATH') OR exit('No direct script access allowed');
use Twilio\Rest\Client;


class Single_faxModel extends CI_Model {
	function get_single_fax()
	{
		// require_once '../twilio_fax/vendor/autoload.php';
		$number = $this->input->post('number');
		$twilio_number = $this->input->post('twilio_number');
		$pdf = $_FILES['file'];
		$target_file = "fax_files/";
		$twilio = $this->db->query("select * from tapp_twilio_number where number = '$twilio_number' and user_id = '".$_SESSION['id']."'");
		$twilio_data = $twilio->result_array();
		$check_blacklist = $this->db->query("select * from tapp_blacklist WHERE number = '$number' and user_id = '".$_SESSION['id']."'");
		if ($check_blacklist->num_rows()>0) {
			$_SESSSION['black_list'] = 'This number is blacklisted';
			return false;
		}
		else
		{ 
			for ($i=0; $i <sizeof($twilio->num_rows()) ; $i++)
			{ 
			   $sid=$twilio_data[$i]['twilio_sid'];
			   $token=$twilio_data[$i]['twilio_token'];
			   $service_type=$twilio_data[$i]['service_type'];	
			   $file = fopen('for.txt', 'w');
			   fwrite($file, $sid.' '.$token.' '.$service_type);
			   fclose($file);			
			}
			$num = "+".$number;
			$twilio_number="+".$twilio_number;
			$tnum = $twilio_number;
			$fax_file = $_FILES["file"]["name"];
			$str_shuffle = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
			$extension = pathinfo($fax_file, PATHINFO_EXTENSION);
			$str = str_shuffle($str_shuffle);
			error_reporting(0);
			$newname = substr($str, 45).".".$extension;
			$new_name = rename($newname, $fax_file);
			$target_file = $target_file.$newname;
			move_uploaded_file($_FILES["file"]["tmp_name"], $target_file);
			$url = base_url().$target_file;
			$file = fopen('for.txt', 'w');
			   fwrite($file, "INSERT INTO fax_sent_log (fax_id,fax_number,twilio_num,fax_url,created_at,user_id) VALUES ('".$fax_id."','".$num."','".$tnum."','".$url."',now(),'".$_SESSION['id']."')");
			   fclose($file);
	

	try{

		$twilio = new Client($sid, $token);
		$fax = $twilio->fax->v1->faxes->create($num,$url,array('from' => $twilio_number, ));
		$fax_id = $fax->sid;
		// print_r($fax);


		$success = $this->db->query("INSERT INTO fax_sent_log (fax_id,fax_number,twilio_num,fax_url,created_at,user_id) VALUES ('".$fax_id."','".$num."','".$tnum."','".$url."',now(),'".$_SESSION['id']."')");
        if ($success) {
        	$_SESSION['fax_send'] = 'Fax has been sent';
        }
        else{
        	echo 'DB insertion fail';
        }
	} 
	catch(Exception $e){
		echo $e;
	$file= fopen("test.txt","w");
        fwrite($file,$e);

        fclose($file);
	$failed = $this->db->query("INSERT INTO fax_sent_failed (fax_number,twilio_num,fax_url,created_at,user_id) VALUES ('".$num."','".$tnum."','".$url."',now(),'".$_SESSION['id']."')");
		if ($failed) {
			$_SESSION['failure_message'] = "Sorry! SMS couldn't sent";
		}
		else{
			echo 'DB insertion fail';
		}
	}


		}

	}
}
?>