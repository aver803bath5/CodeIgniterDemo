<?php 
defined('BASEPATH') OR exit("DON'T");

class Management extends CI_Controller
{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->library('table');
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->helper('url');

        $this->load->model('User');

        $email = $this->session->email;
        $password = $this->session->password;

        if(!$this->User->Authenticate($email, $password)) {
                $this->session->set_flashdata('Err', '信箱或密碼錯誤');
                redirect('Login', 'location', 302);
                die();
        }

	}

	public function index() {
		$data['title'] = 'Management';
		$data['users'] = $this->User->GetAllUserInfo();
		$this->load->view('Header', $data);
		$this->load->view('Management', $data);
		$this->load->view('Footer');
	}

	public function AddUser() {
		$this->form_validation->set_rules('email', '信箱', 'required|valid_email|is_unique[user.email]');
		$this->form_validation->set_rules('password', '密碼', 'required');
		$this->form_validation->set_rules('passwordCheck', '密碼確認', 'required|matches[password]');

		$data['title'] = 'Add User';
		if ($this->form_validation->run() === false) {
			$this->load->view('Header', $data);
			$this->load->view('AddUser', $data);
			$this->load->view('Footer');
		}else {
			$this->_AddUser();
		}
	}

	public function UpdateUser($userID) {
		if (!is_numeric($userID)) {
			echo '不要玩ID';
			die();
		}

		$this->form_validation->set_rules('email', '信箱', 'required');

		$data['title'] = 'Update User';
		$data['user'] = $this->User->GetAllUserInfo($userID);
		if ($this->form_validation->run() === false) {
			$this->load->view('Header', $data);
			$this->load->view('UpdateUser', $data);
			$this->load->view('Footer');
		}else {
			$this->_UpdateUser($userID);
		}
	}

	public function DeleteUser($userID) {
		if (!is_numeric($userID)) {
			echo '不要玩ID';
			die();
		}

		if (!$this->User->RemoveUser($userID)) {
			$this->session->set_flashdata('Err', '刪除失敗');
			redirect('Management', 'location', 302);
		}

		redirect('Management', 'refresh');
	}

	private function _AddUser() {
		$email = $this->input->post('email');
		$password = $this->input->post('password');

		if(!$this->User->addUser($email, $password)) {
			$this->session->set_flashdata('Err', '新增使用者發生錯誤');
			redirect('Management/AddUser', 'location', 302);
			die();
		}

		$this->session->set_flashdata('success', "新增使用者成功");

		redirect('Management', 'refresh');
	}

	private function _UpdateUser($userID) {
		if (!is_numeric($userID)) {
			echo '不要玩ID';
			die();
		}

		$email = $this->input->post('email');
		$password = $this->input->post('password');

		if (!empty($email) || !empty($password)) {
			if(!$this->User->UpdateUser($userID, $email, $password)) {
				$this->session->set_flashdata('success', "更新成功");
				redirect('Management', 'refresh');
			}
		}

		$this->session->set_flashdata('success', "沒有變動");
		redirect('Management', 'refresh');

	}
}
?>