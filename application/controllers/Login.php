<?php 
defined('BASEPATH') OR exit("Don't!");

class Login extends CI_Controller
{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->model('User');
	}

	public function index() {
		$data['title'] = 'Login';

		$this->form_validation->set_rules('email', '信箱', 'required|valid_email');
		$this->form_validation->set_rules('password', '密碼', 'required');

		if ($this->form_validation->run() === False) {
			$this->load->view('Header',$data);
			$this->load->view('Login');
			$this->load->view('Footer');
		}else {
			$this->_LoginCheck();
		}
	}

	private function _LoginCheck() {
		$email = $this->input->post('email');
		$password = $this->input->post('password');

		if(!$this->User->Authenticate($email, $password)) {
			$this->session->set_flashdata('Err', '信箱或密碼錯誤');
			redirect('Login', 'location');
			die();
		}

		redirect('Management', 'refresh');
	}
}
 ?>