<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Login extends CI_Controller {
	function __construct(){
			parent::__construct();
			if (isset($_SESSION['logged_in'])) {
				header('Location: '.base_url().'Dashboard');
			}
		}

	 public function index(){
		$this->load->view('login');
	}
	public function loginfun(){
		$this->load->model('LoginModel');
		$result = $this->LoginModel->loginfun();
		echo json_encode($result);
	}
	function logout(){
		session_destroy();
		header('Location: '.base_url().'Login');
	}

}

?>