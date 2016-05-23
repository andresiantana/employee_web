<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jurnal extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('template');
		if ($this->session->userdata('username')=="") {
			redirect('login');
		}
		$this->load->library('template');
		$this->load->helper(array('form','url'));		
		$this->load->library('session');
        $this->load->library('form_validation');
        $this->load->model('JurnalT');
        $this->load->model('CoaM');
    }

	public function index(){
		$data['judulHeader'] = 'Laporan Jurnal';
		$data['menu'] = 'jurnal';
		$data['username'] = $this->session->userdata('username');
		$data['id_user'] = $this->session->userdata('id_user');
		$data['nama_role'] = $this->session->userdata('nama_role');
		$this->template->display('keuangan/jurnal/index',$data);
	}

	public function laporanJurnal(){
		$data['judulHeader'] = 'Laporan Jurnal';
		$data['menu'] = 'jurnal';
		$data['username'] = $this->session->userdata('username');
		$data['id_user'] = $this->session->userdata('id_user');
		$data['nama_role'] = $this->session->userdata('nama_role');
		$bulan = $this->input->post('bulan');
		$tahun = $this->input->post('tahun');
		$data['data']	= $this->JurnalT->tampilJurnal($bulan,$tahun)->result_object();
		$data['bulan'] = $bulan;
		$data['tahun'] = $tahun;
		$this->template->display('keuangan/jurnal/tabel_jurnal', $data);
	}
}

/* End of file Laporan.php */
/* Location: ./application/controllers/Laporan.php */