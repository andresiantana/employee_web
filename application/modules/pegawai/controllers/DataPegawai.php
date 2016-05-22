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
		$this->load->model('JenisSertifikasiM');
		$this->load->model('Notifikasi');
		$this->load->model('SertifikasiT');

		$this->gallery_path = realpath(APPPATH . '../data/images/pegawai/');
       	$this->gallery_path_url = base_url() . 'data/images/pegawai/';

       	$this->file_path = realpath(APPPATH . '../data/file/pegawai/');
       	$this->file_path_url = base_url() . 'data/file/pegawai/';
	}

	public function index()
	{
		$data['username'] = $this->session->userdata('username');
		$data['id_user'] = $this->session->userdata('id_user');
		$data['nama_role'] = $this->session->userdata('nama_role');
		$data['judulHeader'] = 'Daftar Pegawai';
		$data['menu'] 	= 'daftarPegawai';
		$data['data']	= $this->PGPegawai->tampilDataPegawai()->result_object();	
		$data['aa']	= file_get_contents(base_url()."data/");
		$data['fakultas'] = $this->db->select('*')
						->from('fakultas')
						->get()->result_object();
		$this->template->display('pegawai/dataPegawai/index',$data);
	}

	public function lengkapiData($id = null)
	{
		$data['username'] = $this->session->userdata('username');
		$data['id_user'] = $this->session->userdata('id_user');
		$data['nama_role'] = $this->session->userdata('nama_role');
		$data['menu'] = 'dataPegawai';
		$data['judulHeader'] = 'Data Pegawai';
		$data['datapegawai'] = $this->db->get_where('pegawai',array('id_user'=>$this->session->userdata('id_user')))->row();
		if(isset($data['datapegawai']->id_pegawai)){
			$data['datasertifikasi'] = $this->db->get_where('sertifikasi',array('id_pegawai'=>$data['datapegawai']->id_pegawai))->result_object();	
		}		
		$data['cabang_bank'] = $this->db->select('*')
						->from('cabang_bank')
						->get()->result_object();
		$data['fakultas'] = $this->db->select('*')
						->from('fakultas')
						->get()->result_object();
		$data['jenis_sertifikasi'] = $this->db->select('*')
						->from('jenis_sertifikasi')
						->get()->result_object();
		$this->template->display('pegawai/dataPegawai/lengkapi_data', $data);
	}
	
	public function insert()
	{
		$status_upload = true;
		$status = true;
		$tgl = '';
		$tanggal = '';
		$nama_lengkap = $this->input->post('nama_lengkap');
		$nip = $this->input->post('nip');
		$nidn = $this->input->post('nidn');

		$tanggal_lahir = $this->input->post('tanggal_lahir');
		$tgl = explode("/",$tanggal_lahir);		
		$tanggal = $tgl[2]."-".$tgl[1]."-".$tgl[0];
		$tanggal_lahir = $tanggal;

		$id_lokasi = $this->input->post('id_lokasi');
		$email = $this->input->post('email');
		$no_telp = $this->input->post('no_telp');
		$no_hp = $this->input->post('no_hp');
		$status_pegawai = $this->input->post('status_pegawai');
		$kode_fakultas = $this->input->post('kode_fakultas');
		$id_prodi = $this->input->post('id_prodi');
		$nama_bank = $this->input->post('nama_bank');
		$id_cabang_bank = $this->input->post('id_cabang_bank');
		$nomor_rekening = $this->input->post('nomor_rekening');
		$atasnama_rekening = $this->input->post('atasnama_rekening');
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

		// upload foto
		$config['upload_path']    = $this->gallery_path;
     	$config['allowed_types']  = 'gif|jpg|png|jpeg|pdf|doc|txt|xml|zip|rar';
     	$config['max_size']       = '2000';
     	$config['max_width']      = '2000';
     	$config['max_height']     = '2000';
     	$config['file_name']      = 'gambar-'.trim(str_replace(" ","",date('dmYHis')));
     	$this->load->library('upload', $config);
 	 	$this->upload->initialize($config);

 		if ($this->upload->do_upload("foto")){
 			$foto = $this->upload->file_name;
			$status_upload = true;
 		}else{
 			// echo "<script>alert('Foto gagal diupload!');
    //             window.location.href='".base_url('pegawai/DataPegawai/index')."';
    //         </script>"; 			
 			$status_upload = true;
 		} 
 	 	

 		if($foto != ''){
			$foto = $foto;
		}else{
			$foto = $file_foto;
		}
 		
		// upload studi lanjut
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
 			// echo "<script>alert('Surat Studi Lanjut gagal diupload!');
    //             window.location.href='".base_url('pegawai/DataPegawai/index')."';
    //         </script>"; 		
    		$status_upload = true;	
 		}
 		 
 		if($surat_studi_lanjut != ''){
			$surat_studi_lanjut = $surat_studi_lanjut;
		}else{
			$surat_studi_lanjut = $file_studi_lanjut;
		}
 		
		// uload surat lulus seleksi
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
 			// echo "<script>alert('Surat Lulus Seleksi gagal diupload!');
    //             window.location.href='".base_url('pegawai/DataPegawai/index')."';
    //         </script>"; 	
    		$status_upload = true;		
 		}
 		
 		if($surat_lulus_seleksi != ''){
			$surat_lulus_seleksi = $surat_lulus_seleksi;
		}else{
			$surat_lulus_seleksi = $file_lulus_seleksi;
		}

 		// upload surat terima beasiswa
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
 			// echo "<script>alert('Surat Terima Beasiswa gagal diupload!');
    //             window.location.href='".base_url('pegawai/DataPegawai/index')."';
    //         </script>";	
    		$status_upload = true; 			
 		}
 		 
 		if($surat_terima_beasiswa != ''){
			$surat_terima_beasiswa = $surat_terima_beasiswa;
		}else{
			$surat_terima_beasiswa = $file_terima_beasiswa;
		}

		// variabel untuk simpan ke database
		$data = array(
			'id_lokasi' => $id_lokasi,
			'nama_lengkap' => $nama_lengkap,
			'nip' => $nip,
			'nidn' => $nidn,
			'tanggal_lahir' => $tanggal_lahir,
			'email' => $email,
			'no_telp' => $no_telp,
			'no_hp' => $no_hp,
			'foto' => $foto,
			'status_pegawai'=>$status_pegawai,
			'kode_fakultas' => $kode_fakultas,
			'id_prodi' => $id_prodi,
			'nama_bank' => $nama_bank,
			'id_cabang_bank' => $id_cabang_bank,
			'nomor_rekening' => $nomor_rekening,
			'atasnama_rekening' => $atasnama_rekening,
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

			$data_user = array(
				'nama_lengkap'=>$nama_lengkap
			);
			$this->db->where('id_user',$id_user);
			$this->db->update('user',$data_user);
			$this->db->affected_rows();
		}else{
			$insert = $this->PGPegawai->insert($data);	
		}

		$datapegawai = $this->db->get_where('pegawai',array('id_user'=>$this->session->userdata('id_user')),array('limit'=>1))->row();
			if(count($this->input->post('sertifikasi')) > 0) {
				foreach ($this->input->post('sertifikasi') as $i => $data) {	
					$id_pegawai = $datapegawai->id_pegawai;
					$id_jenis_sertifikasi = $data['id_jenis_sertifikasi'];
					$penyelenggara 	= $data['penyelenggara'];
					$skor 	= $data['skor'];
					$upload 	= isset($_FILES['sertifikasi']['name'][$i]['upload']) ? $_FILES['sertifikasi']['name'][0]['upload'] : null;

					$config5['upload_path']    = $this->file_path;
			     	$config5['allowed_types']  = 'gif|jpg|png|jpeg|pdf|doc|txt|xml|zip|rar|xls';
			     	$config5['max_size']       = '2000';
			     	$config5['max_width']      = '2000';
			     	$config5['max_height']     = '2000';
			     	$config5['file_name']      = 'file-'.trim(str_replace(" ","",date('dmYHis')));
			     	$this->load->library('upload', $config5);	     	
			     	$this->upload->initialize($config5);
		 			if ($this->upload->do_upload($_FILES['sertifikasi']['name'][$i]['upload'])){
			 			$upload = $this->upload->file_name;
						$status_upload = true;
						echo $upload;exit;
			 		}else{
			 			$status_upload = true;			
			 		}
			 		
					$object = array(
						'id_pegawai'=>$id_pegawai,
						'id_jenis_sertifikasi'=>$id_jenis_sertifikasi,
						'penyelenggara'=>$penyelenggara,
						'skor'=>$skor,
						'upload'=>$upload
					);

					$insert = $this->SertifikasiT->insert($object);
					
					if($insert){
						$status = 'berhasil';
					}
				}
			}

		if ($insert && $status) {			
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

	function dropDownUniversitas()
    {
        $nama_lokasi = isset($_POST['nama_lokasi']) ? $_POST['nama_lokasi'] : null;
        $this->db->select('*');
		$this->db->like('nama_lokasi', $nama_lokasi);
		$dataLokasi = $this->db->get('lokasi_pendidikan')->result_object();

		if(count($dataLokasi) > 0){
			echo "<select class='form-control' name='id_lokasi' id='id_lokasi'><option value=''>-Pilih Universitas-</option>";
			foreach($dataLokasi as $lokasi){
			   echo"<option value='".$lokasi->id_lokasi."'>".$lokasi->nama_universitas."</option>";
		  	}     
		  	echo"</select></p><script>initComboBox();</script>";
		}
	}

	function dropDownProdi()
    {
        $kode_fakultas = isset($_POST['kode_fakultas']) ? $_POST['kode_fakultas'] : null;
        $this->db->select('*');
		$this->db->where('kode_fakultas', $kode_fakultas);
		$dataProdi = $this->db->get('prodi')->result_object();

		if(count($dataProdi) > 0){
			echo "<select class='form-control' name='id_prodi' id='id_prodi'><option value=''>-Pilih Prodi-</option>";
			foreach($dataProdi as $prodi){
			   echo"<option value='".$prodi->id_prodi."'>".$prodi->nama_prodi."</option>";
		  	}     
		  	echo"</select></p><script>initComboBox();</script>";
		}
	}

	public function setFormSertifikasi(){
		$jenis_sertifikasi_attributes = 'id="sertifikasi_0_id_jenis_sertifikasi" name="sertifikasi[0][id_jenis_sertifikasi]" class="form-control jenis_sertifikasi"';
		$jenis_sertifikasi = $this->JenisSertifikasiM->dd_jenis_sertifikasi();
		$jenis_sertifikasi_selected = $this->input->post('id_jenis_sertifikasi') ? $this->input->post('id_jenis_sertifikasi') : '';

		$data['tr'] = '';
		$data['tr'] .= '<tr>';
		$data['tr'] .= '<td>'.form_dropdown('sertifikasi[0][id_jenis_sertifikasi]', $jenis_sertifikasi, $jenis_sertifikasi_selected, $jenis_sertifikasi_attributes).'</td>';
		$data['tr'] .= '<td><input id="sertifikasi_0_penyelenggara" name="sertifikasi[0][penyelenggara]" type="text" class="form-control"></td>';
		$data['tr'] .= '<td><input id="sertifikasi_0_skor" name="sertifikasi[0][skor]" type="text" class="form-control"></td>';
		$data['tr'] .= '<td><input id="sertifikasi_0_upload" name="sertifikasi[0][upload]" type="file" accept="images/*" class="form-control"></td>';
		$data['tr'] .= '<td><a href="#" class="btn btn-small btn-success" onclick="tambahSertifikasi();"><i class="fa fa-plus"> </i></a><a style="margin-left:10px;" href="#" class="btn btn-small btn-success" onClick="hapusSertifikasi(this);" ><i class="fa fa-minus"> </i></a></td>';
		$data['tr'] .= '</tr>';
		echo json_encode($data); 
		exit;
	}
}

/* End of file DataPegawai.php */
/* Location: ./application/modules/pegawai/controllers/DataPegawai.php */