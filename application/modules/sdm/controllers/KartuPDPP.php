<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class KartuPDPP extends CI_Controller {

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
        $this->load->model('SDPegawai');
        $this->load->model('SDUraianPengajuanBiayaT');
        $this->load->model('SDPengajuanBiayaT');
	}

	public function index()
	{
		$data['username'] = $this->session->userdata('username');
		$data['id_user'] = $this->session->userdata('id_user');
		$data['nama_role'] = $this->session->userdata('nama_role');
		$data['judulHeader'] = 'Kartu PDPP (Pegawai Dalam Proses Pendidikan)';
		$data['menu'] = 'KartuPDPP';
		$nidn = $this->input->post('nidn');
		$nip = $this->input->post('nip');
		$nama = $this->input->post('nama');
		if($nidn != '' || $nip != '' || $nama != ''){
			$data['data'] =  $this->SDPegawai->tampilDataPegawaiApprovePDPP($nidn,$nip,$nama)->result_object();		
			$tr['tr'] = $this->load->view('sdm/KartuPDPP/pencarian',$data,true);
			echo json_encode($tr['tr']); 
			exit;
		}else{
			$data['data']	= $this->SDPegawai->tampilDataPegawaiApprovePDPP()->result_object();		
		}	
		$this->template->display('sdm/KartuPDPP/index',$data);
	}

	function file_download()
    {
        $nama_file = $_GET['file_name'];
        $data = file_get_contents(base_url()."data/file/pegawai/".$nama_file);

        force_download($nama_file, $data);
	}

	public function printKartu($id_pegawai = null, $id_pengajuan_biaya = null){
		$id_pegawai = $_GET['id_pegawai'];
		$id_pengajuan_biaya = $_GET['id_pengajuan_biaya'];
		$data['username'] = $this->session->userdata('username');
		$data['id_user'] = $this->session->userdata('id_user');
		$data['nama_role'] = $this->session->userdata('nama_role');
		$data['id_pegawai'] = $id_pegawai;
		$data['detail'] = $this->SDPegawai->tampilKartuPegawai($id_pegawai)->row();
		$data['detail_pengajuan'] = $this->SDPengajuanBiayaT->tampilDetailPengajuanPDPP($id_pegawai,$id_pengajuan_biaya)->result_object();
		$data['detail_rincian'] = $this->SDUraianPengajuanBiayaT->tampilUraianPDPP($id_pegawai,$id_pengajuan_biaya)->result_object();
		$this->load->view('sdm/KartuPDPP/cetak_kartu', $data);
	}

}

/* End of file KartuPDPP.php */
/* Location: ./application/modules/admin/controllers/KartuPDPP.php */