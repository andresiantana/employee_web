<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DataPegawai extends CI_Controller {

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
		$this->load->model('Pegawai');
		//Do your magic here
	}

	public function index()
	{
		$data['username'] = $this->session->userdata('username');
		$data['judul'] = 'Employee Web';
		$data['menu'] = 'beranda';
		$this->template->display('pegawai/dataPegawai/index', $data);
	}

}

/* End of file DataPegawai.php */
/* Location: ./application/modules/pegawai/controllers/DataPegawai.php */