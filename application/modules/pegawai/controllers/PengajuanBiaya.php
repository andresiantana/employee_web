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
		$this->load->model('PGPegawai');
		$this->load->model('Notifikasi');
		$this->load->model('KategoriBiayaM');
		$this->load->model('PGPengajuanBiayaT');
	}

	public function index($id = null)
	{
		$data['username'] 		= $this->session->userdata('username');
		$data['id_user'] 		= $this->session->userdata('id_user');
		$data['nama_role'] 		= $this->session->userdata('nama_role');
		$data['judulHeader'] 	= 'Pengajuan Biaya';
		$data['menu'] 			= 'pengajuanBiaya';
		$data['kategori'] 		= $this->db->select('*')
									->from('kategori_biaya')
									->get()->result_object();
		$data['kode_pengajuan'] = $this->PGPengajuanBiayaT->noPengajuanBiaya();
		if(!empty($id)){
			$data['datapengajuan'] = $this->db->get_where('pengajuan_biaya',array('id_pengajuan_biaya'=>$id))->row();
			$data['kode_pengajuan'] = $data['datapengajuan']->kode_pengajuan;
		}
		$this->template->display('pegawai/pengajuanBiaya/index',$data);
	}

	public function insert()
	{
		$tgl = '';
		$tanggal = '';
		$id_pengajuan_biaya = $this->input->post('id_pengajuan_biaya');
		$id_kategori_biaya = $this->input->post('id_kategori_biaya');
		$kode_pengajuan = $this->input->post('kode_pengajuan');
		$semester = $this->input->post('semester');
		$jumlah_nominal = $this->input->post('jumlah_nominal');
		$id_pegawai = $this->Pegawai->tampilUserPegawai($this->session->userdata('id_user'))->row();
		$id_pegawai = $id_pegawai->id_pegawai;
		$nama_lokasi = $this->input->post('nama_lokasi');
		$jurusan_fakultas = $this->input->post('jurusan_fakultas');
		$prodi = $this->input->post('prodi');
		$jenjang = $this->input->post('jenjang');

		$tanggal = $this->input->post('tanggal');
		$tgl = explode("/",$tanggal);		
		$tanggal = $tgl[2]."-".$tgl[1]."-".$tgl[0];
		$tanggal = $tanggal;

		$data = array(
			'id_pengajuan_biaya' =>'',
			'tanggal' => $tanggal,
			'kode_pengajuan'=>$kode_pengajuan,
			'id_kategori_biaya' => $id_kategori_biaya,
			'semester' => $semester,
			'jumlah_nominal' => $jumlah_nominal,
			'id_pegawai' => $id_pegawai,
			'nama_lokasi' => $nama_lokasi,
			'jurusan_fakultas' => $jurusan_fakultas,
			'prodi' => $prodi,
			'jenjang' => $jenjang
		);

		if(!empty($id_pengajuan_biaya)){
			$this->db->where('id_pengajuan_biaya', $id_pengajuan_biaya);
			$this->db->update('pengajuan_biaya', $data);
			$insert = $this->db->affected_rows();

	        $object = array(
				'tanggal' => $tanggal,
				'kode_pengajuan'=>$kode_pengajuan,
				'id_kategori_biaya' => $id_kategori_biaya,
				'semester' => $semester,
				'jumlah_nominal' => $jumlah_nominal,
				'id_pegawai' => $id_pegawai,
				'nama_lokasi' => $nama_lokasi,
				'jurusan_fakultas' => $jurusan_fakultas,
				'prodi' => $prodi,
				'jenjang' => $jenjang
			);
		}else{			
			$insert = $this->PengajuanBiayaT->insert($data);
			$datapengajuan = $this->db->get_where('pengajuan_biaya',array(),array('limit'=>1,'order'=>'id_pengajuan_biaya DESC'))->row();
			$notif = array(
				'id_notifikasi'=>'',
				'id_pegawai'=>$id_pegawai,
				'tanggal'=>date('Y-m-d H:i:s'),
				'pesan'=>'Kode Pengajuan : '.$datapengajuan->kode_pengajuan.' <br> Pengajuan Dana Baru',
				'id_user'=>$this->session->userdata('id_user')
			);

			$this->Notifikasi->insert($notif);
		}	

		if ($insert) {
			echo "<script>alert('Pengajuan Biaya berhasil disimpan!');
                    window.location.href='".base_url('pegawai/PengajuanBiaya')."';
                </script>";
		} else {
			echo "<script>alert('Pengajuan Biaya gagal disimpan!');
                    window.location.href='".base_url('pegawai/PengajuanBiaya')."';
                </script>";  
		}
       
	}

	public function informasi()
	{
		$data['username'] = $this->session->userdata('username');
		$data['id_user'] = $this->session->userdata('id_user');
		$data['nama_role'] = $this->session->userdata('nama_role');
		$data['judulHeader'] = 'Informasi Pengajuan Biaya';
		$data['menu'] 	= 'daftarPegawai';
		$data['kategori'] = $this->db->select('*')
						->from('kategori_biaya')
						->get()->result_object();


		$semester = !empty($this->input->post('semester')) ? $this->input->post('semester') : null;
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
	
		if($semester != '' || $id_kategori_biaya != '' || $tanggal_awal != '' || $tanggal_akhir != ''){
			$data['data'] =  $this->PGPengajuanBiayaT->tampilDataPengajuan($semester,$id_kategori_biaya,$tanggal_awal,$tanggal_akhir)->result_object();		
			$tr['tr'] = $this->load->view('pegawai/pengajuanBiaya/pencarian',$data,true);
			echo json_encode($tr['tr']); 
			exit;
		}else{
			$data['data']	= $this->PGPengajuanBiayaT->tampilDataPengajuan()->result_object();			
		}			
		$this->template->display('pegawai/pengajuanBiaya/informasi',$data);
	}

}

/* End of file PengajuanBiaya.php */
/* Location: ./application/modules/pegawai/controllers/PengajuanBiaya.php */