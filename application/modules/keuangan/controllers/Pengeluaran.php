<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengeluaran extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('username')=="") {
			redirect('login');
		}
		$this->load->library('template');				
		$this->load->library('session');
        $this->load->library('form_validation');
        $this->load->helper(array('form','url','download'));
        $this->load->model('KUPencairanBiayaT');
	}

	public function index()
	{
		$data['username'] = $this->session->userdata('username');
		$data['id_user'] = $this->session->userdata('id_user');
		$data['nama_role'] = $this->session->userdata('nama_role');
		$data['judulHeader'] = 'Pengeluaran';
		$data['menu'] = 'Pengeluaran';

		$data['data']	= $this->KUPencairanBiayaT->tampilLaporanPengeluaran()->result_object();		

		$this->template->display('keuangan/pengeluaran/index',$data);
	}

	
	public function printKartu($id_pegawai = null){
		$data['username'] = $this->session->userdata('username');
		$data['id_user'] = $this->session->userdata('id_user');
		$data['nama_role'] = $this->session->userdata('nama_role');
		$data['id_pegawai'] = $id_pegawai;
		$data['detail'] = $this->KUPegawai->tampilKartuPegawai($id_pegawai)->row();
		$data['detail_rincian'] = $this->KUUraianPengajuanBiayaT->tampilUraian($id_pegawai)->result_object();
		$this->load->view('sdm/kartuPID/cetak_kartu', $data);
	}

}

/* End of file KartuPID.php */
/* Location: ./application/modules/admin/controllers/KartuPID.php */