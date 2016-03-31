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
		$this->load->library('form_validation');
		$this->load->helper('text');
		$this->load->helper('form');		
		$this->load->model('User');
	}
	
	public function index()
	{
		$data['username'] = $this->session->userdata('username');
		$data['nama_role'] = $this->session->userdata('nama_role');
		$data['menu'] = 'beranda';
		$data['judulHeader'] = 'Dashboard';
		$this->template->display('pegawai/dashboard', $data);
	}

	public function logout() {
		$this->session->unset_userdata('username');
		$this->session->unset_userdata('nama_role');
		session_destroy();
		redirect('pegawai/Login');
	}

}

/* End of file Dashboard.php */
/* Location: ./application/controllers/admin/Dashboard.php */