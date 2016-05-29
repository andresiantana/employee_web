<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Amortisasi extends CI_Controller {

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
        $this->load->model('KUPegawai');
	}

	public function index()
	{
		$data['username'] = $this->session->userdata('username');
		$data['id_user'] = $this->session->userdata('id_user');
		$data['nama_role'] = $this->session->userdata('nama_role');
		$data['judulHeader'] = 'Amortisasi';
		$data['menu'] = 'Amortisasi';
		$nip = $this->input->post('nip');
		$nama = $this->input->post('nama');
		if($nip != '' || $nama != ''){
			$data['data'] =  $this->KUPegawai->tampilDataPegawaiLulus($nip,$nama)->result_object();		
			$tr['tr'] = $this->load->view('keuangan/amortisasi/pencarian',$data,true);
			echo json_encode($tr['tr']); 
			exit;
		}else{
			$data['data']	= $this->KUPegawai->tampilDataPegawaiLulus()->result_object();		
		}	
		$this->template->display('keuangan/amortisasi/index',$data);
	}


	// public function printKartu($id_pegawai = null){
	// 	$data['username'] = $this->session->userdata('username');
	// 	$data['id_user'] = $this->session->userdata('id_user');
	// 	$data['nama_role'] = $this->session->userdata('nama_role');
	// 	$data['id_pegawai'] = $id_pegawai;
	// 	$data['detail'] = $this->KUPegawai->tampilKartuPegawai($id_pegawai)->row();
	// 	$data['detail_rincian'] = $this->KUUraianPengajuanBiayaT->tampilUraian($id_pegawai)->result_object();
	// 	$this->load->view('sdm/kartuPID/cetak_kartu', $data);
	// }

}
