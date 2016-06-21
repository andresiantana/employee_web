<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PosisiPendanaanBeasiswa extends CI_Controller {

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
        $this->load->model('KUUraianPencairanBiayaT');
        $this->load->model('KUUraianPengajuanBiayaT');
	}

	public function index($id = NULL)
	{
		$data['username'] = $this->session->userdata('username');
		$data['id_user'] = $this->session->userdata('id_user');
		$data['nama_role'] = $this->session->userdata('nama_role');
		$data['judulHeader'] = 'Posisi Pendanaan Beasiswa';
		$data['menu'] = 'posisiPendanaanBeasiswa';

		$jml = $this->db->get('pencairan_biaya');

		//pengaturan pagination
		 $config['base_url'] = base_url().'keuangan/Pengeluaran/index';
		 $config['total_rows'] = $jml->num_rows();
		 $config['per_page'] = '10';
		 $config['first_page'] = 'Awal';
		 $config['last_page'] = 'Akhir';
		 $config['next_page'] = '&laquo;';
		 $config['prev_page'] = '&raquo;';

		//inisialisasi config
		 $this->pagination->initialize($config);

		//buat pagination
		 $data['halaman'] = $this->pagination->create_links();

		$nip = $this->input->post('nip');		
		$nama = $this->input->post('nama');		
		$kode_pengeluaran = $this->input->post('kode_pengeluaran');
		$tanggal_awal = $this->input->post('tanggal_awal');
		$tanggal_akhir = $this->input->post('tanggal_akhir');
	
		if($nip != '' || $nama != '' || $kode_pengeluaran != '' ||  $tanggal_awal != '' || $tanggal_akhir != ''){
			$data['data']	= $this->KUPencairanBiayaT->tampilLaporanPendanaanBeasiswa($config['per_page'],$id,$nip,$nama,$kode_pengeluaran,$tanggal_awal,$tanggal_akhir)->result_object();
			$tr['tr'] = $this->load->view('keuangan/pengeluaran/pencarian',$data,true);
			echo json_encode($tr['tr']); 
			exit;
		}else{
			$data['data']	= $this->KUPencairanBiayaT->tampilLaporanPendanaanBeasiswa($config['per_page'],$id)->result_object();
		}	

		$this->template->display('keuangan/posisiPendanaanBeasiswa/index',$data);
	}

	public function detail($id_pencairan_biaya = null,$id_pegawai=null) {
		$data['username'] = $this->session->userdata('username');
		$data['id_user'] = $this->session->userdata('id_user');
		$data['nama_role'] = $this->session->userdata('nama_role');		
		$id_pencairan_biaya = $_POST['id_pencairan_biaya'];
		$id_pegawai = $_POST['id_pegawai'];
		$data['id_pencairan_biaya'] = $id_pencairan_biaya;
		$data['id_pegawai'] = $id_pegawai;
		$data['datapegawai'] = $this->db->get_where('pegawai',array('id_pegawai'=>$id_pegawai))->row();
		$data['detail'] = $this->KUUraianPengajuanBiayaT->detailPengajuan($id_pencairan_biaya)->result_object();
		$tr['tr'] = $this->load->view('keuangan/posisiPendanaanBeasiswa/detail',$data,true);
		echo json_encode($tr['tr']); 
		exit;
	}

	public function printDetailPengeluaran($id_pengeluaran_biaya = null, $id_pegawai = null) {
		$data['username'] = $this->session->userdata('username');
		$data['id_user'] = $this->session->userdata('id_user');
		$data['nama_role'] = $this->session->userdata('nama_role');
		$data['id_pengeluaran_biaya'] = $id_pengeluaran_biaya;
		$data['detail'] = $this->KUUraianPengajuanBiayaT->detailPengajuan($id_pengeluaran_biaya)->result_object();
		$data['datapegawai'] = $this->db->get_where('pegawai',array('id_pegawai'=>$id_pegawai))->row();
		$this->load->view('keuangan/posisiPendanaanBeasiswa/print', $data);
	}
}

/* End of file PosisiPendanaanBeasiswa.php */
/* Location: ./application/modules/keuangan/controllers/PosisiPendanaanBeasiswa.php */