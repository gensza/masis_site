<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
	public function __construct()
	{
		// menjalankan method ketika class Auth dijalankan
		parent::__construct();
		$this->load->library('form_validation');
	}

	public function index()
	{
		// jika sudah login tidak bisa ke view login
		if ($this->session->userdata('email')) {
			redirect('Users');
		}
		// validasi inputan
		$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'required|trim');
		if ($this->form_validation->run() == false) {
			$data['title'] = 'Login';
			$this->load->view('templates/auth_header', $data);
			$this->load->view('auth/login');
			$this->load->view('templates/auth_footer');
		} else {
			// ketika lolos validasi
			$this->_login();
		}
	}

	private function _login()
	{
		// jika sudah login tidak bisa ke view login
		if ($this->session->userdata('email')) {
			redirect('User');
		}
		$email = $this->input->post('email');
		$password = $this->input->post('password');
		// cek email dari inputan
		$user = $this->db->get_where('user', ['email' => $email])->row_array();
		//jika user nya ada
		if ($user) {
			// jika usernya aktif
			if ($user['is_active'] == 1) {
				// cek password, jika benar akan masuk dan set session lalu di redirect
				if (password_verify($password, $user['password'])) {
					$data = [
						'email' => $user['email'],
						'role_id' => $user['role_id']
					];
					$this->session->set_userdata($data);
					// role_id 1 = admin
					if ($user['role_id'] == 1) {
						redirect('Users');
					} else {
						redirect('Users');
					}
				} else {
					$this->session->set_flashdata('message', '<div class="alert alert-danger" role="danger"> Wrong password!</div>');
					redirect('Auth');
				}
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="danger"> This email has not been activated!</div>');
				redirect('Auth');
			}
		} else {
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="danger">Email is not registered!</div>');
			redirect('Auth');
		}
	}

	public function registration()
	{
		$this->form_validation->set_rules('name', 'Name', 'required|trim');
		$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]', [
			'is_unique' => 'This email has already registered!'
		]);
		// trim = manghapus spasi lebih, valid_email = jika format email salah, is_unique = untuk cek ke DB apakah sudah ada atau belum
		$this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]|matches[password2]', [
			'matches' => 'Password dont match!',
			'min_length' => 'Password too short!'
		]);
		$this->form_validation->set_rules('password2', 'Password', 'required|trim|min_length[3]|matches[password1]');
		if ($this->form_validation->run() == false) {
			$data['title'] = 'Registration';
			$this->load->view('templates/auth_header', $data);
			$this->load->view('auth/registration');
			$this->load->view('templates/auth_footer');
		} else {
			// ketika lolos validasi
			$data = [
				'name' => htmlspecialchars($this->input->post('name', true)),
				'email' => htmlspecialchars($this->input->post('email', true)),
				'image' => 'default.jpg',
				'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
				'role_id' => 2,
				'is_active' => 1,
				'date_created' => time()
			];
			$this->db->insert('user', $data);
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Congratulation! your account has been created. Please Login</div>');
			redirect('Auth');
		}
	}

	public function logout()
	{
		$this->session->unset_userdata('email');
		$this->session->unset_userdata('role_id');
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">You have been logged out!</div>');
		redirect('Auth');
	}

	public function blocked()
	{
		$this->load->view('auth/blocked');
	}
}