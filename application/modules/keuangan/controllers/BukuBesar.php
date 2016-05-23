<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BukuBesar extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('template');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->model('JurnalT');
		$this->load->model('CoaM');
	}

	public function index(){
		$data['judulHeader'] = 'Laporan Buku Besar';
		$data['menu'] = 'bukuBesar';
		$data['username'] = $this->session->userdata('username');
		$data['id_user'] = $this->session->userdata('id_user');
		$data['nama_role'] = $this->session->userdata('nama_role');
		$data['coa'] = $this->CoaM->dd_coa();

		$this->template->display('keuangan/bukubesar/index',$data);
	}

	public function LaporanBukuBesar(){
		$data['judulHeader'] = 'Laporan Buku Besar';
		$data['menu'] = 'bukuBesar';
		$data['username'] = $this->session->userdata('username');
		$data['id_user'] = $this->session->userdata('id_user');
		$data['nama_role'] = $this->session->userdata('nama_role');
		$bulan = $this->input->post('bulan');
		$tahun = $this->input->post('tahun');	
		$kode_akun = $this->input->post('kode_akun');	
		$data['bulan'] = $bulan;
		$data['tahun'] = $tahun;
		$data['kode_akun'] = $kode_akun;
		$data['data']	= $this->JurnalT->tampilBukuBesar($bulan,$tahun,$kode_akun)->result_object();
		$data['akun'] = $this->db->get_where('coa',array('no_akun'=>$kode_akun))->row();
		$data['saldo_debit']	= $this->JurnalT->saldoDebit($bulan,$tahun,$kode_akun)->row();
		$data['saldo_kredit']	= $this->JurnalT->saldoKredit($bulan,$tahun,$kode_akun)->row();
		$data['saldo_awal'] = $this->JurnalT->saldoAwal($bulan,$tahun)->row();
		$this->template->display('keuangan/bukubesar/tabel_buku_besar', $data);
	}
}

/* End of file LaporanBukuBesar.php */
/* Location: ./application/controllers/laporan/LaporanBukuBesar.php */
