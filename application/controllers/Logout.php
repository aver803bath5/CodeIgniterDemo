<?php 
defined('BASEPATH') OR exit("DON'T");

class Logout extends CI_Controller
{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->helper('url');
	}

	public function index() {
		$this->session->unset_userdata('userID');
		$this->session->unset_userdata('email');
		$this->session->unset_userdata('password');
		redirect('Login', 'refresh');
	}
}
?>