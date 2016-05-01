<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PengajuanBiaya extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('template');
		if ($this->session->userdata('username')=="") {
			redirect('login');
		}		
		$this->load->library('form_validation');
		$this->load->helper('text');
	 	$this->load->helper(array('url','html','form','download'));
		$this->load->model('User');
		$this->load->model('Pegawai');
		$this->load->model('Notifikasi');
		$this->load->model('KategoriBiayaM');
		$this->load->model('PengajuanBiayaT');
	}

	public function index()
	{
		$data['username'] = $this->session->userdata('username');
		$data['id_user'] = $this->session->userdata('id_user');
		$data['nama_role'] = $this->session->userdata('nama_role');
		$data['judulHeader'] = 'Informasi Pengajuan Biaya';
		$data['menu'] 	= 'pengajuanBiaya';
		$data['data']	= $this->PengajuanBiayaT->tampilData()->result_object();	
		$this->template->display('sdm/pengajuanBiaya/index',$data);
	}

	function approveData()
    {
    	$status = '';

        $id_pengajuan_biaya = isset($_POST['id_pengajuan_biaya']) ? $_POST['id_pengajuan_biaya'] : null;
        $status_pengajuan = isset($_POST['status_pengajuan']) ? $_POST['status_pengajuan'] : "";
        $alasan_pengajuan = isset($_POST['alasan_pengajuan']) ? $_POST['alasan_pengajuan'] : "";

        
        $object = array(
			'status_pengajuan'=>$status_pengajuan,
			'alasan_status'=>$alasan_pengajuan
		);

		$this->db->where('id_pengajuan_biaya', $id_pengajuan_biaya);
		$this->db->update('pengajuan_biaya', $object);
		if($this->db->affected_rows()){
			$status = true;
			$pesan = 'Data Pengajuan Biaya berhasil di'.$status_pengajuan;
		}else{
			$status = false;
			$pesan = 'Data Pengajuan Biaya gagal di'.$status_pengajuan;
		}

		$data['status'] = $status;
		$data['pesan'] = $pesan;
		echo json_encode($data); 
		exit;
	}

}

/* End of file PengajuanBiaya.php */
/* Location: ./application/modules/sdm/controllers/PengajuanBiaya.php */