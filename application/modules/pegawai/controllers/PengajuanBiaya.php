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
		$this->load->model('UraianPengajuanBiayaT');
		$this->load->model('PGUraianPengajuanBiayaT');
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
			$data['datapengajuan']	= $this->db->get_where('pengajuan_biaya',array('id_pengajuan_biaya'=>$id))->row();
			$data['kode_pengajuan']	= $data['datapengajuan']->kode_pengajuan;
		}

		// untuk load data pengajuan biaya		
		$data['datapegawai'] =  $this->db->select('*')
							->from('pegawai')
							->join('fakultas', 'pegawai.kode_fakultas = fakultas.kode_Fakultas')
							->join('prodi', 'pegawai.id_prodi = prodi.id_prodi')
							->where('id_user',$this->session->userdata('id_user'))
							->limit('1')
						    ->get()->row();
	 	$data['pengajuan'] =  $this->db->select('*')
							->where('id_pegawai',$data['datapegawai']->id_pegawai)
							->order_by("id_pengajuan_biaya","desc")
							->limit('1')
							->from('pengajuan_biaya')
						    ->get()->row();
	    $data['dataPengajuan'] =  $this->PGPengajuanBiayaT->tampilPengajuanPegawai($data['datapegawai']->id_pegawai)->row();
	    if(count($data['dataPengajuan']) > 0){
	    	echo "<script>alert('Data Pengajuan Biaya masih ada yang belum dilakukan Approved di SDM!');
                    window.location.href='".base_url('pegawai/Dashboard')."';
                </script>";
	    }

		$this->template->display('pegawai/pengajuanBiaya/index',$data);
	}

	public function insert($id = null)
	{
		$status = true;
		$tgl = '';
		$tanggal = '';
		$id_pengajuan_biaya = $this->input->post('id_pengajuan_biaya');
		$kode_pengajuan = $this->input->post('kode_pengajuan');
		$semester = $this->input->post('semester');
		$jumlah_nominal = $this->input->post('jumlah_nominal');
		$id_pegawai = $this->Pegawai->tampilUserPegawai($this->session->userdata('id_user'))->row();
		$id_pegawai = $id_pegawai->id_pegawai;

		$tanggal = $this->input->post('tanggal');
		// $tgl = explode("/",$tanggal);		
		// $tanggal = $tgl[2]."-".$tgl[1]."-".$tgl[0];
		// $tanggal = $tanggal;

		$data = array(
			'id_pengajuan_biaya' =>'',
			'tanggal' => $tanggal,
			'kode_pengajuan'=>$kode_pengajuan,
			'semester' => $semester,
			'jumlah_nominal' => $jumlah_nominal,
			'id_pegawai' => $id_pegawai
		);

		if(!empty($id_pengajuan_biaya)){
			 $object = array(
				'tanggal' => $tanggal,
				'kode_pengajuan'=>$kode_pengajuan,
				// 'semester' => $semester,
				'jumlah_nominal' => $jumlah_nominal,
				'id_pegawai' => $id_pegawai
			);

			$this->db->where('id_pengajuan_biaya', $id_pengajuan_biaya);
			$this->db->update('pengajuan_biaya', $object);
			$insert = $this->db->affected_rows();	       
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
		$datapegawai = $this->db->get_where('pegawai',array('id_user'=>$this->session->userdata('id_user')),array('limit'=>1))->row();
		$datapengajuan_biaya = $this->db->select('*')
							->where('id_pegawai',$datapegawai->id_pegawai)
							->order_by("id_pengajuan_biaya","desc")
							->limit('1')
							->from('pengajuan_biaya')
						    ->get()->row();
		$kategori_biaya = $this->db->get_where('kategori_biaya',array('nama_kategori'=>'SPP'),array('limit'=>1))->row();
		// input detail pengajuan biaya untuk SPP
		$id_pegawai = $datapegawai->id_pegawai;
		$id_pengajuan_biaya = $datapengajuan_biaya->id_pengajuan_biaya;

		$object = array(
			'id_pengajuan_biaya'=>$id_pengajuan_biaya,
			'id_kategori_biaya'=>$kategori_biaya->id_kategori_biaya,
			'nominal'=>$jumlah_nominal
		);

		$insert = $this->UraianPengajuanBiayaT->insert($object);
		
		if($insert){
			$status = true;
		}

		if ($insert && $status) {
			echo "<script>alert('Pengajuan Biaya berhasil disimpan!');
                    window.location.href='".base_url('pegawai/PengajuanBiaya/informasi')."';
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
		$data['menu'] 	= 'informasiPengajuanBiaya';
		$data['kategori'] = $this->db->select('*')
						->from('kategori_biaya')
						->get()->result_object();



		$semester = $this->input->post('semester');
		$id_kategori_biaya = $this->input->post('id_kategori_biaya');
		$tanggal_awal = $this->input->post('tanggal_awal');
		if(!empty($tanggal_awal)){
			$tgl_awal = explode("/",$tanggal_awal);		
			$tgl_awal = $tgl_awal[2]."-".$tgl_awal[1]."-".$tgl_awal[0];
			$tanggal_awal = $tgl_awal;
		}

		$tanggal_akhir = $this->input->post('tanggal_akhir');
		if(!empty($tanggal_akhir)){
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

	public function setFormBiaya(){
		$kategori_biaya_attribute = 'id="biaya_0_id_kategori_biaya" name="biaya[0][id_kategori_biaya]" class="form-control kategori_biaya"';
		$kategori_biaya = $this->KategoriBiayaM->dd_kategori();

		$data['tr'] = '';
		$data['tr'] .= '<tr>';
		$data['tr'] .= '<td>'.form_dropdown('biaya[0][id_kategori_biaya]', $kategori_biaya, '', $kategori_biaya_attribute).'</td>';
		$data['tr'] .= '<td><input id="biaya_0_nominal" name="biaya[0][nominal]" type="text" class="form-control numbers-only" onblur="hitungTotalBiaya(this);"></td>';
		$data['tr'] .= '<td><a href="#" class="btn btn-small btn-success" onclick="tambahBiaya();"><i class="fa fa-plus"> </i></a><a style="margin-left:10px;" href="#" class="btn btn-small btn-success" onClick="hapusBiaya(this);" ><i class="fa fa-minus"> </i></a></td>';
		$data['tr'] .= '</tr>';
		echo json_encode($data); 
		exit;
	}

	public function detail($id_pegawai=null) {
		$data['username'] = $this->session->userdata('username');
		$data['id_user'] = $this->session->userdata('id_user');
		$data['nama_role'] = $this->session->userdata('nama_role');		
		$id_pengajuan_biaya = $_POST['id_pengajuan_biaya'];
		$data['id_pengajuan_biaya'] = $id_pengajuan_biaya;
		$data['detail'] =  $this->PGUraianPengajuanBiayaT->tampilUraianPengajuan($id_pengajuan_biaya)->result_object();
		$data['data_row'] = $this->db->select('*')
							->from('pengajuan_biaya')
							->join('pencairan_biaya', 'pencairan_biaya.id_pencairan_biaya = pengajuan_biaya.id_pencairan_biaya','left')
							->where('pengajuan_biaya.id_pengajuan_biaya',$id_pengajuan_biaya)
							->get()->row();

		$tr['tr'] = $this->load->view('pegawai/pengajuanBiaya/detail',$data,true);
		echo json_encode($tr['tr']); 
		exit;
	}

	public function printDetail($id_pengajuan_biaya = null) {
		$data['username'] = $this->session->userdata('username');
		$data['id_user'] = $this->session->userdata('id_user');
		$data['nama_role'] = $this->session->userdata('nama_role');		
		$id_pengajuan_biaya = $id_pengajuan_biaya;
		$data['id_pengajuan_biaya'] = $id_pengajuan_biaya;
		$data['detail'] =  $this->PGUraianPengajuanBiayaT->tampilUraianPengajuan($id_pengajuan_biaya)->result_object();
		$data['data_row'] = $this->db->select('*')
							->from('pengajuan_biaya')
							->join('pencairan_biaya', 'pencairan_biaya.id_pencairan_biaya = pengajuan_biaya.id_pencairan_biaya','left')
							->where('pengajuan_biaya.id_pengajuan_biaya',$id_pengajuan_biaya)
							->get()->row();
		$data['data_pegawai'] = $this->db->select('*')
								->from('pegawai')
								->where('id_pegawai',$data['data_row']->id_pegawai)
								->get()->row();
		$this->load->view('pegawai/pengajuanBiaya/detail', $data);
	}

	function approvePenerimaan()
    {
    	$status = '';
    	$status_notifikasi = false;

        $id_pencairan_biaya = isset($_GET['id_pencairan_biaya']) ? $_GET['id_pencairan_biaya'] : null;
        $id_pegawai = isset($_GET['id_pegawai']) ? $_GET['id_pegawai'] : null;
        $object = array(
			'tanggal_penerimaan'=>date('Y-m-d')
		);

		$this->db->where('id_pencairan_biaya', $id_pencairan_biaya);
		$this->db->update('pencairan_biaya', $object);

		if($this->db->affected_rows()){
			$tanggal = date('Y-m-d H:i:s');
			$pesan = 'Data Pencairan Biaya sudah di Terima oleh Pegawai';
			$data = array(
				'id_pegawai'=>$id_pegawai,
				'tanggal'=>$tanggal,
				'pesan'=>$pesan,
				'id_user'=>$this->session->userdata('id_user')
			);

			$insert = $this->Notifikasi->insert($data);
			if($insert){
				$status_notifikasi = true;
			}else{
				$status_notifikasi = false;
			}

			$status = true;
		}else{
			$status = false;
		}

		$data['status'] = $status;
		echo json_encode($data); 
		exit;
	}

	function dropDownUniversitas()
    {
        $nama_lokasi = isset($_POST['nama_lokasi']) ? $_POST['nama_lokasi'] : null;
        $id_lokasi = isset($_POST['id_lokasi']) ? $_POST['id_lokasi'] : null;

        $this->db->select('*');
		$this->db->like('nama_lokasi', $nama_lokasi);
		$dataLokasi = $this->db->get('lokasi_pendidikan')->result_object();

		if(count($dataLokasi) > 0){
			echo "<select class='form-control' name='id_lokasi' id='id_lokasi' disabled=true><option value=''>-Pilih Universitas-</option>";
			foreach($dataLokasi as $lokasi){
				if($lokasi->id_lokasi == $id_lokasi){
					echo"<option value='".$lokasi->id_lokasi."' selected>".$lokasi->nama_universitas."</option>";	
				}else{
					echo"<option value='".$lokasi->id_lokasi."'>".$lokasi->nama_universitas."</option>";
				}
			   
		  	}     
		  	echo"</select>";
		}else{
			echo "<select class='form-control' name='id_lokasi' id='id_lokasi'><option value=''>-Pilih Universitas-</option>";
		  	echo"</select>";
		}
	}

}

/* End of file PengajuanBiaya.php */
/* Location: ./application/modules/pegawai/controllers/PengajuanBiaya.php */