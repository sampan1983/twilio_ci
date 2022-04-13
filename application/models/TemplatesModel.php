<?php

defined('BASEPATH') OR exit('No direct script access allowed');
class TemplatesModel extends CI_Model {
	function getdata(){
		$sql = "select * from tapp_template_msg where user_id = '".$_SESSION['id']."'";
		$result = $this->db->query($sql);
		if ($result->num_rows()>0) {
		return	$template_data = $result->result_array();
		}
		else{
			$template_data = 'No';
		}
	}



	function addtemplates(){
		$db = get_instance()->db->conn_id;
		$title = $this->input->post('title');
		$temp_type = $this->input->post('temp_type');
    	$title = mysqli_real_escape_string($db, $title);
		$message = $this->input->post('message');
		$message = mysqli_real_escape_string($db, $message);
		if ($temp_type=='MMS') {
			$img = $_FILES['file'];
			if (isset($_FILES['file'])) {
						 	for ($i=0; $i <sizeof($_FILES['file']['name']) ; $i++) { 
		 		$_FILES['myimg']['name'] = $_FILES['file']['name'][$i];
		 		$_FILES['myimg']['size'] = $_FILES['file']['size'][$i];
		 		$_FILES['myimg']['type'] = $_FILES['file']['type'][$i];
		 		$_FILES['myimg']['tmp_name'] = $_FILES['file']['tmp_name'][$i];
		 		$_FILES['myimg']['error'] = $_FILES['file']['error'][$i];
		 		
		 		$config['allowed_types'] = 'jpg|jpeg|gif|png';
		 		$config['file_name'] = 'temp'.rand(100,1000);
		 		$config['upload_path'] = './upload';

		 	$this->load->library('upload',$config);
			if (!$this->upload->do_upload('myimg')) {
				$img= null;
			}
			else{
				$file_data = $this->upload->data();
				$img = base_url().'upload/'.$file_data['file_name'];
			}
			}
		}
		}
		else{
			$img = null;
		}


		$tapp_template_msg = "select * from tapp_template_msg where title = '$title' and user_id = '".$_SESSION['id']."'";

		$result_tapp_template_msg = $this->db->query($tapp_template_msg);

		if ($result_tapp_template_msg->num_rows()>0) {
			return 'already';
			$_SESSION['template_add_fail'] = 'This tamplate name is already exists';
		}

		else{

			$insert_tapp_template_msg = "insert into tapp_template_msg(title,temp_type,message,date_time,media,user_id)values('$title','$temp_type','$message',now(),'$img','".$_SESSION['id']."')";

			$result_insert_tapp_template_msg = $this->db->query($insert_tapp_template_msg);

			if ($result_insert_tapp_template_msg) {

				$_SESSION['template_add'] = 'Template message have been saved successfully';

				return true;

			}

			else{

				$_SESSION['template_add_fail'] = 'Sorry there was an error';

				return false;

			}

 		}

	}

	function edittemplate(){
		$title = $this->input->post('title');
		$temp_type = $this->input->post('temp_type');
		$id = $this->input->post('id');
		$user_id = $_SESSION['id'];
		if ($temp_type=='MMS') {
			$img = $_FILES['file'];
			if (isset($_FILES['file'])) {
						 	for ($i=0; $i <sizeof($_FILES['file']['name']) ; $i++) { 
		 		$_FILES['myimg']['name'] = $_FILES['file']['name'][$i];
		 		$_FILES['myimg']['size'] = $_FILES['file']['size'][$i];
		 		$_FILES['myimg']['type'] = $_FILES['file']['type'][$i];
		 		$_FILES['myimg']['tmp_name'] = $_FILES['file']['tmp_name'][$i];
		 		$_FILES['myimg']['error'] = $_FILES['file']['error'][$i];
		 		
		 		$config['allowed_types'] = 'jpg|jpeg|gif|png';
		 		$config['file_name'] = 'temp'.rand(100,1000);
		 		$config['upload_path'] = './upload';

		 	$this->load->library('upload',$config);
			if (!$this->upload->do_upload('myimg')) {
				$img= null;
			}
			else{
				$file_data = $this->upload->data();
				$img = base_url().'upload/'.$file_data['file_name'];
			}
			}
		}
		}
		else{
			$img = null;
		}
		$check_temp = $this->db->get_where('tapp_template_msg', array('user_id' => $user_id));
		$fetch = $check_temp->result_array();
		$old_temp = $fetch[0]['title'];
		if ($old_temp==$title) {
		$message = $this->input->post('message');
		$str = str_replace(PHP_EOL, '', $message);
		$message= stripslashes($str);
		$message= str_replace('rnrn','',$str);
		$msg= str_replace('\r',' ',$message);
		$msg = preg_replace('/\s+/', ' ', $msg);
		// "insert into tapp_template_msg(title,temp_type,message,media)values('$title','$temp_type','$msg','$img')";
		$data_insert['title'] = $title;
		$data_insert['temp_type'] = $temp_type;
		$data_insert['message'] = $msg;
		$data_insert['media'] = $img;
		$data_insert['user_id'] = $user_id;
		// $insert_edit_tapp_template_msg = $this->db->insert('tapp_template_msg',$data_insert);
		$this->db->set($data_insert);
		$this->db->where('id', $id);
		$result_insert_edit_tapp_template_msg = $this->db->update('tapp_template_msg');
		}
		else
		{
			$check_temp = $this->db->get_where('tapp_template_msg', array('user_id' => $user_id,'title' => $title));
			if ($check_temp->num_rows()>0) 
			{
				return 'already';
				$_SESSION['template_add_fail'] = 'This tamplate name is already exists';			
			}
			else
			{
		$message = $this->input->post('message');
		$str = str_replace(PHP_EOL, '', $message);
		$message= stripslashes($str);
		$message= str_replace('rnrn','',$str);
		$msg= str_replace('\r',' ',$message);
		$msg = preg_replace('/\s+/', ' ', $msg);
		// "insert into tapp_template_msg(title,temp_type,message,media)values('$title','$temp_type','$msg','$img')";
		$data_insert['title'] = $title;
		$data_insert['temp_type'] = $temp_type;
		$data_insert['message'] = $msg;
		$data_insert['media'] = $img;
		$data_insert['user_id'] = $user_id;
		// $insert_edit_tapp_template_msg = $this->db->insert('tapp_template_msg',$data_insert);
		$this->db->set($data_insert);
		$this->db->where('id', $id);
		$result_insert_edit_tapp_template_msg = $this->db->update('tapp_template_msg');

			}
		}

		if ($result_insert_edit_tapp_template_msg) {
		$_SESSION['edit_template'] = 'Template message has been updated successfully';
		return true;
		}
		}

	function deletetemplate($id){
		$deletetemplate = "delete from tapp_template_msg where id = '$id'";
		$result_deletetemplate = $this->db->query($deletetemplate);
		if ($result_deletetemplate) {
			$_SESSION['delete_template'] ='Template message has been deleted successfully';
			return true;
		}

	}





}

?>