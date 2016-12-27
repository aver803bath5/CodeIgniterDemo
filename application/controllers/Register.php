<?php 
defined('BASEPATH') OR exit("DON'T");

class Register extends CI_Controller
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
		$this->form_validation->set_rules('email', '信箱', 'required|valid_email|is_unique[user.email]');
		$this->form_validation->set_rules('password', '密碼', 'required');
		$this->form_validation->set_rules('passwordCheck', '密碼確認', 'required|matches[password]');

		$data['title'] = 'Register';
		if ($this->form_validation->run() === false) {
			$this->load->view('Header', $data);
			$this->load->view('Register', $data);
			$this->load->view('Footer');
		}else {
			$this->_Register();
		}
	}

	private function _Register() {
		$email = $this->input->post('email');
		$password = $this->input->post('password');

		if(!$this->User->addUser($email, $password)) {
			$this->session->set_flashdata('Err', '註冊發生錯誤');
			redirect('Register', 'location');
			die();
		}

		$this->session->set_flashdata('success', "註冊成功");

		redirect('Login', 'refresh');
	}
}
?>