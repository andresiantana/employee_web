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

		$nama_pegawai = $this->input->post('nama_pegawai');
		$kode_pengajuan = $this->input->post('kode_pengajuan');
		$status_pengajuan = $this->input->post('status_pengajuan');
		$id_kategori_biaya = $this->input->post('id_kategori_biaya');
		$tanggal_awal = $this->input->post('tanggal_awal');
		if(!empty($tanggal_awal)){
			$tgl_awal = explode("/",$tanggal_awal);		
			$tgl_awal = $tgl_awal[2]."-".$tgl_awal[1]."-".$tgl_awal[0];
			$tanggal_awal = $tgl_awal;
		}

		$tanggal_akhir = $this->input->post('tanggal_akhir');
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

	public function edit($id = null)
	{
		$data['username'] 		= $this->session->userdata('username');
		$data['id_user'] 		= $this->session->userdata('id_user');
		$data['nama_role'] 		= $this->session->userdata('nama_role');
		$data['judulHeader'] 	= 'Pengajuan Biaya';
		$data['menu'] 			= 'pengajuanBiaya';
		$data['kategori'] 		= $this->db->select('*')
									->from('kategori_biaya')
									->get()->result_object();
		$data['kode_pengajuan'] = $this->SDPengajuanBiayaT->noPengajuanBiaya();
		if(!empty($id)){
			$data['datapengajuan'] = $this->db->get_where('pengajuan_biaya',array('id_pengajuan_biaya'=>$id))->row();
			$data['kode_pengajuan'] = $data['datapengajuan']->kode_pengajuan;
		}
		if(isset($data['datapengajuan']->id_pengajuan_biaya)){
			$data['uraian_biaya'] = $this->db->get_where('uraian_pengajuan_biaya',array('id_pengajuan_biaya'=>$data['datapengajuan']->id_pengajuan_biaya))->result_object();	
		}	
		$this->template->display('sdm/pengajuanBiaya/pengajuanBiaya',$data);
	}

	public function insert()
	{
		$status = true;

		$tgl = '';
		$tanggal = '';
		$id_pengajuan_biaya = $this->input->post('id_pengajuan_biaya');
		$id_kategori_biaya = $this->input->post('id_kategori_biaya');
		$kode_pengajuan = $this->input->post('kode_pengajuan');
		$semester = $this->input->post('semester');
		$jumlah_nominal = $this->input->post('jumlah_nominal');
		$id_pegawai = $this->input->post('id_pegawai');
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
		$datapegawai = $this->db->get_where('pegawai',array('id_pegawai'=>$id_pegawai),array('limit'=>1))->row();
		$datapengajuan = $this->db->get_where('pengajuan_biaya',array('id_pengajuan_biaya'=>$id_pengajuan_biaya),array('limit'=>1))->row();
		if(!empty($id_pengajuan_biaya)){
			$id_pengajuan_biaya = $id_pengajuan_biaya;
		}else{
			$id_pengajuan_biaya = $datapengajuan->id_pengajuan_biaya;
		}
			if(count($this->input->post('biaya')) > 0) {
				foreach ($this->input->post('biaya') as $i => $data) {	
					$id_pegawai = $datapegawai->id_pegawai;
					$id_pengajuan_biaya = $id_pengajuan_biaya;
					$id_kategori_biaya = $data['id_kategori_biaya'];
					$id_uraian = $data['id_uraian'];
					$nominal 	= $data['nominal'];

					$object = array(
						'id_pengajuan_biaya'=>$id_pengajuan_biaya,
						'id_kategori_biaya'=>$id_kategori_biaya,
						'nominal'=>$nominal
					);

					if(!empty($id_uraian)){
						$this->db->where('id_uraian', $id_uraian);
						$this->db->update('uraian_pengajuan_biaya', $data);
						$insert = $this->db->affected_rows();
					}else{
						$insert = $this->PGPegawai->insert($data);	
					}
					if($insert){
						$status = true;
					}
				}
			}

		if ($insert && $status) {
			echo "<script>alert('Ubah Pengajuan Biaya berhasil disimpan!');
                    window.location.href='".base_url('sdm/PengajuanBiaya')."';
                </script>";
		} else {
			echo "<script>alert('Ubah Pengajuan Biaya gagal disimpan!');
                    window.location.href='".base_url('sdm/PengajuanBiaya')."';
                </script>";  
		}
       
	}

	public function setFormBiaya(){
		$kategori_biaya_attribute = 'id="biaya_0_id_kategori_biaya" name="biaya[0][id_kategori_biaya]" class="form-control kategori_biaya"';
		$kategori_biaya = $this->KategoriBiayaM->dd_kategori();

		$data['tr'] = '';
		$data['tr'] .= '<tr>';
		$data['tr'] .= '<td>'.form_dropdown('biaya[0][id_kategori_biaya]', $kategori_biaya, '', $kategori_biaya_attribute).'</td>';
		$data['tr'] .= '<td><input id="biaya_0_nominal" name="biaya[0][nominal]" type="text" class="form-control numbers-only" onblur="hitungTotalBiaya(this);">
		<input id="biaya_0_id_uraian" name="biaya[0][id_uraian]" type="hidden" class="form-control numbers-only" onblur="hitungTotalBiaya(this);">
		</td>';
		$data['tr'] .= '<td><a href="#" class="btn btn-small btn-success" onclick="tambahBiaya();"><i class="fa fa-plus"> </i></a><a style="margin-left:10px;" href="#" class="btn btn-small btn-success" onClick="hapusBiaya(this);" ><i class="fa fa-minus"> </i></a></td>';
		$data['tr'] .= '</tr>';
		echo json_encode($data); 
		exit;
	}
}

/* End of file PengajuanBiaya.php */
/* Location: ./application/modules/sdm/controllers/PengajuanBiaya.php */