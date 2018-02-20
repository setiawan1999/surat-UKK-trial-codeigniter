<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('login_model','login');
	}

	public function index()
	{
		if ($this->session->userdata('logged_in')) {
			redirect('surat');
		} else {
			$this->load->view('login_view');
		}
	}

	public function do_login()
	{
		if ($this->login->do_login() == TRUE) {
			$this->session->set_flashdata('notifs', 'Login Success');
			redirect('surat');
		} else {
			$this->session->set_flashdata('notifg', 'Invalid Username or Password');
			redirect('login');
		}
	}

	function logout()
	{
		$this->session->sess_destroy();
		redirect('login');
	}
}

/* End of file login.php */
/* Location: ./application/controllers/login.php */