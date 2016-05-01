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
		$this->load->model('SDPengajuanBiayaT');
	}

	public function index()
	{
		$data['username'] = $this->session->userdata('username');
		$data['id_user'] = $this->session->userdata('id_user');
		$data['nama_role'] = $this->session->userdata('nama_role');
		$data['judulHeader'] = 'Informasi Pengajuan Biaya';
		$data['menu'] 	= 'pengajuanBiaya';
		$data['kategori'] = $this->db->select('*')
						->from('kategori_biaya')
						->get()->result_object();


		$nama_pegawai = !empty($this->input->post('nama_pegawai')) ? $this->input->post('nama_pegawai') : null;
		$kode_pengajuan = !empty($this->input->post('kode_pengajuan')) ? $this->input->post('kode_pengajuan') : null;
		$status_pengajuan = !empty($this->input->post('status_pengajuan')) ? $this->input->post('status_pengajuan') : null;
		$id_kategori_biaya = !empty($this->input->post('id_kategori_biaya')) ? $this->input->post('id_kategori_biaya') : null;
		$tanggal_awal = !empty($this->input->post('tanggal_awal')) ? $this->input->post('tanggal_awal') : null;
		if(!empty($tanggal_awal)){
			$tgl_awal = explode("/",$tanggal_awal);		
			$tgl_awal = $tgl_awal[2]."-".$tgl_awal[1]."-".$tgl_awal[0];
			$tanggal_awal = $tgl_awal;
		}

		$tanggal_akhir = !empty($this->input->post('tanggal_akhir')) ? $this->input->post('tanggal_akhir') : null;
		if(!empty($tgl_akhir)){
			$tgl_akhir = explode("/",$tanggal_akhir);		
			$tgl_akhir = $tgl_akhir[2]."-".$tgl_akhir[1]."-".$tgl_akhir[0];
			$tanggal_akhir = $tgl_akhir;
		}
	
		if($nama_pegawai != '' || $kode_pengajuan != '' || $id_kategori_biaya != '' || $status_pengajuan != '' || $tanggal_awal != '' || $tanggal_akhir != ''){
			$data['data'] =  $this->SDPengajuanBiayaT->tampilData($nama_pegawai,$kode_pengajuan,$id_kategori_biaya,$status_pengajuan,$tanggal_awal,$tanggal_akhir)->result_object();		
			$tr['tr'] = $this->load->view('sdm/pengajuanBiaya/pencarian',$data,true);
			echo json_encode($tr['tr']); 
			exit;
		}else{
			$data['data']	= $this->SDPengajuanBiayaT->tampilData()->result_object();			
		}	

		$this->template->display('sdm/pengajuanBiaya/index',$data);
	}

	function approveData()
    {
    	$status = '';

        $id_pengajuan_biaya = isset($_POST['id_pengajuan_biaya']) ? $_POST['id_pengajuan_biaya'] : null;
        $status_pengajuan = isset($_POST['status_pengajuan']) ? $_POST['status_pengajuan'] : "";
        $alasan_pengajuan = isset($_POST['alasan_pengajuan']) ? $_POST['alasan_pengajuan'] : "";

        $datapengajuan = $this->db->get_where('pengajuan_biaya',array('id_pengajuan_biaya'=>$id_pengajuan_biaya))->row();

        $object = array(
			'status_pengajuan'=>$status_pengajuan,
			'alasan_status'=>$alasan_pengajuan
		);

		$this->db->where('id_pengajuan_biaya', $id_pengajuan_biaya);
		$this->db->update('pengajuan_biaya', $object);
		if($this->db->affected_rows()){
			$status = true;
		 	$object = array(
				'id_pegawai'=>$datapengajuan->id_pengajuan_biaya,
				'tanggal'=>date('Y-m-d H:i:s'),
				'pesan'=>'Kode Pengajuan : '.$datapengajuan->kode_pengajuan.' di - '.$status_pengajuan.' oleh SDM ',
				'id_user'=>$this->session->userdata('id_user')
			);

			$this->Notifikasi->insert($object);
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