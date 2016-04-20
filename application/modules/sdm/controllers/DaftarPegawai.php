<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DaftarPegawai extends CI_Controller {

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
		$data['menu'] = 'daftarPegawai';
		$data['data']	= $this->Pegawai->tampilDataPegawai()->result_object();		
		$this->template->display('sdm/daftarPegawai/index',$data);
	}

	function file_download()
    {
        $nama_file = $_GET['file_name'];
        $data = file_get_contents(base_url()."data/file/pegawai/".$nama_file);

        force_download($nama_file, $data);
	}

	function approveData()
    {
    	$status = '';

        $id_pegawai = isset($_GET['id_pegawai']) ? $_GET['id_pegawai'] : null;
        $object = array(
			'status_approve_sdm'=>'Approved'
		);

		$this->db->where('id_pegawai', $id_pegawai);
		$this->db->update('pegawai', $object);
		if($this->db->affected_rows()){
			$status = true;
		}else{
			$status = false;
		}

		$data['status'] = $status;
		echo json_encode($data); 
		exit;
	}
}

/* End of file DaftarPegawai.php */
/* Location: ./application/modules/admin/controllers/DaftarPegawai.php */