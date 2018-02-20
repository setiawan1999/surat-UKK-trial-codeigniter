<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Error404 extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$data['heading'] = '404 NOT FOUND';
		$data['message'] = 'destination you requested not found';
		$this->load->view('errors/html/error_404', $data);
	}

}

/* End of file error404.php */
/* Location: ./application/controllers/error404.php */