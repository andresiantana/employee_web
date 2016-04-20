<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class KartuPID extends CI_Controller {

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
        $this->load->model('Pegawai');
	}

	public function index()
	{
		$data['username'] = $this->session->userdata('username');
		$data['nama_role'] = $this->session->userdata('nama_role');
		$data['judulHeader'] = 'Daftar Pegawai';
		$data['menu'] = 'KartuPID';
		$nidn = !empty($this->input->post('nidn')) ? $this->input->post('nidn') : null;
		$nip = !empty($this->input->post('nip')) ? $this->input->post('nip') : null;
		$nama = !empty($this->input->post('nama')) ? $this->input->post('nama') : null;
		if($nidn != '' || $nip != '' || $nama != ''){
			$data['data'] =  $this->Pegawai->tampilDataPegawaiApprove($nidn,$nip,$nama)->result_object();		
			$tr['tr'] = $this->load->view('sdm/kartuPID/pencarian',$data,true);
			echo json_encode($tr['tr']); 
			exit;
		}else{
			$data['data']	= $this->Pegawai->tampilDataPegawaiApprove()->result_object();		
		}	
		$this->template->display('sdm/kartuPID/index',$data);
	}

	function file_download()
    {
        $nama_file = $_GET['file_name'];
        $data = file_get_contents(base_url()."data/file/pegawai/".$nama_file);

        force_download($nama_file, $data);
	}

	public function printKartu($id_pegawai = null){
		$data['username'] = $this->session->userdata('username');
		$data['nama_role'] = $this->session->userdata('nama_role');
		$data['id_pegawai'] = $id_pegawai;
		$data['detail'] = $this->Pegawai->tampilKartuPegawai($id_pegawai)->row();
		$this->load->view('sdm/kartuPID/cetak_kartu', $data);
	}

}

/* End of file DaftarPegawai.php */
/* Location: ./application/modules/admin/controllers/DaftarPegawai.php */