<?php
defined('BASEPATH') OR exit('No direct script access allowed');
	class Ivr_setting extends CI_Controller {

        function __construct(){
			parent::__construct();
			if (!isset($_SESSION['logged_in'])) {
				header('Location: '.base_url().'Login');
			}
            $this->load->model('User_listModel');
            $this->load->model('Received_messages_newModel');
		}

        public function index()
        {
    		$result['data_user'] = $this->User_listModel->get();
            $query = $this->db->query("select * from ivr_data");
            if($query->num_rows()>0){
                $data = $query->result_array();
                $result['ivr_data'] = $data;
            }
            else{
                $result['ivr_data'] = 'No';
            }
            $result['Received_messages_new'] = $this->Received_messages_newModel->receivedmsglog();
            $this->load->view('ivr_setting',$result);
        }

        public function add_ivr(){
            $type = $this->input->post('temp_type');
            if($type=='voice'){
                if (isset($_FILES['message_file'])) {
                    print_r($_FILES);
                }
                $config['upload_path']          = './upload/';
                $config['allowed_types']        = 'mp3';
                $config['file_name'] = 'ivr'.rand(100,1000);

                $this->load->library('upload', $config);

                if ( ! $this->upload->do_upload('message_file'))
                {
                        $error = array('error' => $this->upload->display_errors());
                }
                else
                {
                        $data = $this->upload->data();
                        print_r($data);
                        $res = base_url()."upload/".$data['file_name'];
                }
            }
            else {
                $res = $_POST['message'];
             }
             if ($res) {
                $check = $this->db->get_where('ivr_data',array('user_input'=> $_POST['title']));
                if ($check->num_rows()<1) {
                    $query = $this->db->insert("ivr_data",array('user_input' => $_POST['title'], 'response' =>$res));
                    if ($query) {
                        echo "insert";
                    }
                    else{
                        return false;
                    }
                }
                else{
                    echo 'already';
                }
             }
            redirect(base_url().'ivr_setting');
        }

        public function add_ivr_new(){
            $type = $this->input->post('temp_type');
            $res = $_POST['forward'];
             if ($res) {
                $check = $this->db->get_where('ivr_data',array('user_input'=> $_POST['title']));
                if ($check->num_rows()<1) {
                    $query = $this->db->insert("ivr_data",array('user_input' => $_POST['title'], 'response' =>$res));
                    if ($query) {
                        echo "insert";
                    }
                    else{
                        return false;
                    }
                }
                else{
                    echo 'already';
                }
             }
            redirect(base_url().'ivr_setting');
        }

        public function ivr_delete()
        {
            $delete = $this->db->query("DELETE FROM ivr_data WHERE id = '".$_POST['id']."'");
            if ($delete) {
                return "delete";
            }
            else{
                return false;
            }
        }

        public function ivr_edit()
        {   
            $check = $this->db->select('*')->from('ivr_data')->where('user_input', $_POST['title'])->where_not_in('id',$_POST['id'])->get();
            if ($check->num_rows()<1) {
                $type = $this->input->post('temp_type');
                if($type=='voice'){
                    if (isset($_FILES['message_file'])) {
                        print_r($_FILES);
                    }
                    $config['upload_path']          = './upload/';
                    $config['allowed_types']        = 'mp3';
                    $config['file_name'] = 'ivr_edit'.rand(100,1000);
    
                    $this->load->library('upload', $config);
    
                    if ( ! $this->upload->do_upload('message_file'))
                    {
                            $error = array('error' => $this->upload->display_errors());
                    }
                    else
                    {
                            $data = $this->upload->data();
                            print_r($data);
                            $res = base_url()."upload/".$data['file_name'];
                    }
                }
                else {
                    $res = $_POST['message'];
                 }
                 if ($res) {
                $query = $this->db->query("UPDATE ivr_data SET user_input = '".$_POST['title']."' , response = '".$res."' WHERE id = '".$_POST['id']."'");
                if ($query) {
                    echo json_encode("update");
                }
                else{
                    return false;
                }
            }
            else{
                echo json_encode("already");
            }
            }

        }


    }