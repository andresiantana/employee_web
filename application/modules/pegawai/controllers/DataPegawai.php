<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DataPegawai extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('template');
		if ($this->session->userdata('username')=="") {
			redirect('login');
		}		
		$this->load->library('form_validation');
		$this->load->helper('text');
		$this->load->helper('form');
		$this->load->model('User');
		$this->load->model('Pegawai');
	}

	public function index($id = null)
	{
		$data['username'] = $this->session->userdata('username');
		$data['nama_role'] = $this->session->userdata('nama_role');
		$data['menu'] = 'dataPegawai';
		$data['judulHeader'] = 'Data Pegawai';
		$this->template->display('pegawai/dataPegawai/index', $data);
	}

	public function insert()
	{
	 	$config['upload_path']    = "./data/images/";
     	$config['allowed_types']  = 'gif|jpg|png|jpeg';
     	$config['max_size']       = '2000';
     	$config['max_width']      = '2000';
     	$config['max_height']     = '2000';
     	$config['file_name']      = 'gambar-'.trim(str_replace(" ","",date('dmYHis')));
     	$this->load->library('upload', $config);

		$nama_lengkap = $this->input->post('nama_lengkap');
		$nip = $this->input->post('nip');
		$nidn = $this->input->post('nidn');
		$tanggal_lahir = $this->input->post('tanggal_lahir');
		$email = $this->input->post('email');
		$no_telp = $this->input->post('no_telp');
		$foto = $this->input->post('foto');
		$fakultas = $this->input->post('fakultas');
		$prodi = $this->input->post('prodi');
		$nama_bank = $this->input->post('nama_bank');
		$nomor_rekening = $this->input->post('nomor_rekening');
		$atasnama_rekening = $this->input->post('atasnama_rekening');
		$sertifikasi = $this->input->post('sertifikasi');
		$surat_studi_lanjut = $this->input->post('surat_studi_lanjut');
		$surat_lulus_seleksi = $this->input->post('surat_lulus_seleksi');
		$surat_terima_beasiswa = $this->input->post('surat_terima_beasiswa');
		$biaya_spp = $this->input->post('biaya_spp');
		$id_user = $this->session->userdata('id_user');

	 	if (!$this->upload->do_upload("foto")) {
             echo "Error";
        }else{
           $data = array(
					'nama_lengkap' => $nama_lengkap,
					'nip' => $nip,
					'nidn' => $nidn,
					'tanggal_lahir' => $tanggal_lahir,
					'email' => $email,
					'no_telp' => $no_telp,
					'foto' => $config['file_name'],
					'fakultas' => $fakultas,
					'prodi' => $prodi,
					'nama_bank' => $nama_bank,
					'nomor_rekening' => $nomor_rekening,
					'atasnama_rekening' => $atasnama_rekening,
					'sertifikasi' => $sertifikasi,
					'surat_studi_lanjut' => $surat_studi_lanjut,
					'surat_lulus_seleksi' => $surat_lulus_seleksi,
					'surat_terima_beasiswa' => $surat_terima_beasiswa,
					'biaya_spp' => $biaya_spp,
					'id_user' => $id_user,
				);
			$insert = $this->Pegawai->insert($data);
			if ($insert) {
				$this->session->set_flashdata('success','Data berhasil disimpan!');
				redirect('pegawai/DataPegawai');
			} else {
				$this->session->set_flashdata('error','Data gagal disimpan!');
				redirect('pegawai/DataPegawai');   
			}
        }  
	}

}

/* End of file DataPegawai.php */
/* Location: ./application/modules/pegawai/controllers/DataPegawai.php */