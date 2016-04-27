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
	 	$this->load->helper(array('url','html','form','download'));
		$this->load->model('User');
		$this->load->model('PGPegawai');
		$this->load->model('Notifikasi');

		$this->gallery_path = realpath(APPPATH . '../data/images/pegawai/');
       	$this->gallery_path_url = base_url() . 'data/images/pegawai/';

       	$this->file_path = realpath(APPPATH . '../data/file/pegawai/');
       	$this->file_path_url = base_url() . 'data/file/pegawai/';
	}

	public function index()
	{
		$data['username'] = $this->session->userdata('username');
		$data['nama_role'] = $this->session->userdata('nama_role');
		$data['judulHeader'] = 'Daftar Pegawai';
		$data['menu'] 	= 'daftarPegawai';
		$data['data']	= $this->PGPegawai->tampilDataPegawai()->result_object();	
		$data['aa']	= file_get_contents(base_url()."data/");
		$this->template->display('pegawai/dataPegawai/index',$data);
	}

	public function lengkapiData($id = null)
	{
		$data['username'] = $this->session->userdata('username');
		$data['nama_role'] = $this->session->userdata('nama_role');
		$data['menu'] = 'dataPegawai';
		$data['judulHeader'] = 'Data Pegawai';
		$data['datapegawai'] = $this->db->get_where('pegawai',array('id_user'=>$this->session->userdata('id_user')))->row();
		$this->template->display('pegawai/dataPegawai/lengkapi_data', $data);
	}
	
	public function insert()
	{
		$status_upload = false;
		$tgl = '';
		$tanggal = '';
		$nama_lengkap = $this->input->post('nama_lengkap');
		$nip = $this->input->post('nip');
		$nidn = $this->input->post('nidn');

		$tanggal_lahir = $this->input->post('tanggal_lahir');
		$tgl = explode("/",$tanggal_lahir);		
		$tanggal = $tgl[2]."-".$tgl[1]."-".$tgl[0];
		$tanggal_lahir = $tanggal;

		$email = $this->input->post('email');
		$no_telp = $this->input->post('no_telp');
		$profesi = $this->input->post('profesi');
		$fakultas = $this->input->post('fakultas');
		$prodi = $this->input->post('prodi');
		$nama_bank = $this->input->post('nama_bank');
		$nomor_rekening = $this->input->post('nomor_rekening');
		$atasnama_rekening = $this->input->post('atasnama_rekening');
		$sertifikasi = $this->input->post('sertifikasi');
		$foto = $this->input->post('foto');
		$surat_studi_lanjut = $this->input->post('surat_studi_lanjut');
		$surat_lulus_seleksi = $this->input->post('surat_lulus_seleksi');
		$surat_terima_beasiswa = $this->input->post('surat_terima_beasiswa');
		$biaya_spp = $this->input->post('biaya_spp');
		$id_user = $this->session->userdata('id_user');
		$id_pegawai = ($this->input->post('id_pegawai')) ? $this->input->post('id_pegawai') : null;

		// daftar file yang sudah di upload
		$file_foto = $this->input->post('file_foto');
		$file_lulus_seleksi = $this->input->post('file_lulus_seleksi');
		$file_studi_lanjut = $this->input->post('file_studi_lanjut');
		$file_terima_beasiswa = $this->input->post('file_terima_beasiswa');


		$config['upload_path']    = $this->gallery_path;
     	$config['allowed_types']  = 'gif|jpg|png|jpeg|pdf|doc|txt|xml|zip|rar';
     	$config['max_size']       = '2000';
     	$config['max_width']      = '2000';
     	$config['max_height']     = '2000';
     	$config['file_name']      = 'gambar-'.trim(str_replace(" ","",date('dmYHis')));
     	$this->load->library('upload', $config);
 	 	$this->upload->initialize($config);
 		if (!$this->upload->do_upload("foto")){
				echo "<script>alert('Foto gagal diupload!');
                window.location.href='".base_url('pegawai/DataPegawai/index')."';
            </script>";
 		}else{	 			
 			$foto = $this->upload->file_name;	 				 			
			$status_upload = true;
 		} 
 		if($foto != ''){
			$foto = $foto;
		}else{
			$foto = $file_foto;
		}
 		
		
		$config2['upload_path']    = $this->file_path;
     	$config2['allowed_types']  = 'gif|jpg|png|jpeg|pdf|doc|txt|xml|zip|rar';
     	$config2['max_size']       = '2000';
     	$config2['max_width']      = '2000';
     	$config2['max_height']     = '2000';
     	$config2['file_name']      = 'file-'.trim(str_replace(" ","",date('dmYHis')));
     	$this->load->library('upload', $config2);
     	$this->upload->initialize($config2);
 		if ($this->upload->do_upload("surat_studi_lanjut")){
 			$surat_studi_lanjut = $this->upload->file_name;
			$status_upload = true;
 		}else{
 			echo "<script>alert('Surat Studi Lanjut gagal diupload!');
                window.location.href='".base_url('pegawai/DataPegawai/index')."';
            </script>"; 			
 		} 

 		if($surat_studi_lanjut != ''){
			$surat_studi_lanjut = $surat_studi_lanjut;
		}else{
			$surat_studi_lanjut = $file_studi_lanjut;
		}
 		

		$config3['upload_path']    = $this->file_path;
     	$config3['allowed_types']  = 'gif|jpg|png|jpeg|pdf|doc|txt|xml|zip|rar';
     	$config3['max_size']       = '2000';
     	$config3['max_width']      = '2000';
     	$config3['max_height']     = '2000';
     	$config3['file_name']      = 'file-'.trim(str_replace(" ","",date('dmYHis')));
     	$this->load->library('upload', $config3);
     	$this->upload->initialize($config3);
 		if ($this->upload->do_upload("surat_lulus_seleksi")){
 			$surat_lulus_seleksi = $this->upload->file_name;
			$status_upload = true;
 		}else{
 			echo "<script>alert('Surat Lulus Seleksi gagal diupload!');
                window.location.href='".base_url('pegawai/DataPegawai/index')."';
            </script>"; 			
 		} 

 		if($surat_lulus_seleksi != ''){
			$surat_lulus_seleksi = $surat_lulus_seleksi;
		}else{
			$surat_lulus_seleksi = $file_lulus_seleksi;
		}

 		
		$config4['upload_path']    = $this->file_path;
     	$config4['allowed_types']  = 'gif|jpg|png|jpeg|pdf|doc|txt|xml|zip|rar';
     	$config4['max_size']       = '2000';
     	$config4['max_width']      = '2000';
     	$config4['max_height']     = '2000';
     	$config4['file_name']      = 'file-'.trim(str_replace(" ","",date('dmYHis')));
     	$this->load->library('upload', $config4);	     	
     	$this->upload->initialize($config4);
 		if ($this->upload->do_upload("surat_terima_beasiswa")){
 			$surat_terima_beasiswa = $this->upload->file_name;
			$status_upload = true;
 		}else{
 			echo "<script>alert('Surat Terima Beasiswa gagal diupload!');
                window.location.href='".base_url('pegawai/DataPegawai/index')."';
            </script>";	 			
 		} 
 		if($surat_terima_beasiswa != ''){
			$surat_terima_beasiswa = $surat_terima_beasiswa;
		}else{
			$surat_terima_beasiswa = $file_terima_beasiswa;
		}
		

			$data = array(
				'nama_lengkap' => $nama_lengkap,
				'nip' => $nip,
				'nidn' => $nidn,
				'tanggal_lahir' => $tanggal_lahir,
				'email' => $email,
				'no_telp' => $no_telp,
				'foto' => $foto,
				'profesi'=>$profesi,
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

			if(!empty($id_pegawai)){
				$this->db->where('id_pegawai', $id_pegawai);
				$this->db->update('pegawai', $data);
				$insert = $this->db->affected_rows();

		        $object = array(
					'id_pegawai'=>$id_pegawai,
					'tanggal'=>date('Y-m-d H:i:s'),
					'pesan'=>'Update data pegawai',
					'id_user'=>$this->session->userdata('id_user')
				);

				$this->Notifikasi->insert($object);
			}else{
				$insert = $this->PGPegawai->insert($data);	
			}			
			if ($insert) {
				$this->session->set_flashdata('success','Data berhasil disimpan!');
				redirect('pegawai/DataPegawai');
			} else {
				$this->session->set_flashdata('error','Data gagal disimpan!');
				redirect('pegawai/DataPegawai');   
			}
       
	}

	function file_download()
    {
        $nama_file = $_GET['file_name'];
        $data = file_get_contents(base_url()."data/file/pegawai/".$nama_file);

        force_download($nama_file, $data);
	}

}

/* End of file DataPegawai.php */
/* Location: ./application/modules/pegawai/controllers/DataPegawai.php */