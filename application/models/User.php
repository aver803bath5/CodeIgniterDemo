<?php 
defined('BASEPATH') OR exit("DON'T");

class User extends CI_Model
{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->database();
	}

	public function Authenticate($email, $password) {
		$this->db->escape($email);
		$this->db->select('*')->from('user');
		$this->db->where('email', $email);
		$query = $this->db->get();

		$user = $query->row();

		if (empty($user->password)) {
			$this->session->set_flashdata('Err', '信箱或密碼錯誤');
			return false;
		}

		if ($password != $user->password || empty($user->password)) {
			$this->session->set_flashdata('Err', '信箱或密碼錯誤');
			return false;
		}

		$this->session->set_userdata('userID', $user->id);
		$this->session->set_userdata('email', $email);
		$this->session->set_userdata('password', $password);

		return true;
	}

	public function AddUser($email, $password) {
		$this->db->escape($email);
		$userData = array(
			'email' => $email,
			'password' => $password
		);

		if(!$this->db->insert('user', $userData)) {
			$this->session->set_flashdata('Err', $this->db->error());
			return false;
		}

		return true;
	}

	public function GetAllUserInfo($userID = NULL) {
		$this->db->select('*')->from('user');
		
		if ($userID != NULL) {
			$this->db->where('id', $userID);
			$query = $this->db->get();
			$result = $query->row();
			return $result;
		}

		$query = $this->db->get();
		$result = $query->result();

		return $result;
	}

	public function UpdateUser($userID, $email, $password) {
		$userData = array(
			'id' => $userID,
			'email' => $email,
			'password' => $password
		);
		
		if(!$this->db->replace('user', $userData)) {
			$this->session->set_flashdata('Err', $this->db->error());
			return false;
		}

		return true;
	}

	public function RemoveUser($userID) {
		$this->db->where('id', $userID);
		
		if(!$this->db->delete('user')) {
			$this->session->set_flashdata('Err', $this->db->error());
			return false;
		}

		return true;
	}
}
?>