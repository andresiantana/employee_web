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

	public function index($id = NULL)
	{
		$data['username'] = $this->session->userdata('username');
		$data['id_user'] = $this->session->userdata('id_user');
		$data['nama_role'] = $this->session->userdata('nama_role');
		$data['judulHeader'] = 'Amortisasi';
		$data['menu'] = 'Amortisasi';

		$jml = $this->db->get('pegawai');

		//pengaturan pagination
		 $config['base_url'] = base_url().'keuangan/Amortisasi/index';
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
		if($nip != '' || $nama != ''){
			$data['data'] =  $this->KUPegawai->tampilDataPegawaiAmortisasi($config['per_page'],$id,$nip,$nama)->result_object();	
			$data['data_row']	= $this->KUPegawai->tampilDataPegawaiAmortisasi($nip,$nama)->row();
			if(count($data['data_row']) > 0){
				$data['amortisasi'] = round($data['data_row']->biaya / ((2*$data['data_row']->lama_bulan_studi)+12));		
			}else{
				$data['amortisasi'] = 0;
			}
			
			$tr['tr'] = $this->load->view('keuangan/amortisasi/pencarian',$data,true);
			echo json_encode($tr['tr']); 
			exit;
		}else{
			$data['data']	= $this->KUPegawai->tampilDataPegawaiAmortisasi($config['per_page'],$id)->result_object();
			$data['data_row']	= $this->KUPegawai->tampilDataPegawaiAmortisasi($config['per_page'],$id)->row();
			if(count($data['data_row']) > 0){
				// $data['amortisasi'] = round($data['data_row']->biaya / ((2*$data['data_row']->lama_bulan_studi)+12));
				$data['amortisasi'] = round($data['data_row']->biaya);
			}
		}	
		$this->template->display('keuangan/amortisasi/index',$data);
	}


	public function printAmortisasi($id_pegawai = null) {
		$data['username'] = $this->session->userdata('username');
		$data['id_user'] = $this->session->userdata('id_user');
		$data['nama_role'] = $this->session->userdata('nama_role');
		$data['id_pegawai'] = $id_pegawai;
		$data['detail'] = $this->KUPegawai->printAmortisasiPerPegawai($id_pegawai)->row();
		$this->load->view('keuangan/amortisasi/print', $data);
	}

}
