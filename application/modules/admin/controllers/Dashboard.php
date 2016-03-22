<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('template');
		if ($this->session->userdata('username')=="") {
			redirect('login');
		}
		$this->load->helper('text');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->model('User');
		//Do your magic here
	}
	public function index()
	{
		$data['username'] = $this->session->userdata('username');
		$data['judul'] = 'Employee Web';
		$data['menu'] = 'beranda';
		$this->template->display('admin/dashboard', $data);
	}

	public function logout() {
		$this->session->unset_userdata('username');
		session_destroy();
		redirect('admin/login');
	}

}

/* End of file Dashboard.php */
/* Location: ./application/controllers/admin/Dashboard.php */