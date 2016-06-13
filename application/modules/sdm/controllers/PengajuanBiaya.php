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
	 	$this->load->helper(array('url','html','form','download','string'));
		$this->load->model('User');
		$this->load->model('Pegawai');
		$this->load->model('Notifikasi');
		$this->load->model('KategoriBiayaM');
		$this->load->model('SDPengajuanBiayaT');
		$this->load->model('SDUraianPengajuanBiayaT');
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

		$nip = $this->input->post('nip');
		$kode_pengajuan = $this->input->post('kode_pengajuan');
		$id_kategori_biaya = null;
		$status_pengajuan = $this->input->post('status_pengajuan');
		$tanggal_awal = $this->input->post('tanggal_awal');
	
		$tanggal_akhir = $this->input->post('tanggal_akhir');
	
		if($nip != '' || $kode_pengajuan != '' || $status_pengajuan != '' || $tanggal_awal != '' || $tanggal_akhir != ''){
			$data['data'] =  $this->SDPengajuanBiayaT->tampilData($nip,$kode_pengajuan,$id_kategori_biaya,$status_pengajuan,$tanggal_awal,$tanggal_akhir)->result_object();		
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
        $jumlah_nominal = isset($_POST['jumlah_nominal']) ? $_POST['jumlah_nominal'] : "";

        $datapengajuan = $this->db->get_where('pengajuan_biaya',array('id_pengajuan_biaya'=>$id_pengajuan_biaya))->row();

        if($status_pengajuan == 'Approved'){
        	$object = array(
				'status_pengajuan'=>$status_pengajuan,
				'jumlah_nominal'=>$jumlah_nominal,
				'jumlah_disetujui'=>$jumlah_disetujui
			);
        }else{
        	$object = array(
			'status_pengajuan'=>$status_pengajuan,
			'alasan_status'=>$alasan_pengajuan,
			'jumlah_disetujui'=>0
			);
        }        

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
			$data['uraian_biaya'] = $this->db->select('*')
									->from('uraian_pengajuan_biaya')
									->where('id_pengajuan_biaya',$data['datapengajuan']->id_pengajuan_biaya)
									->get()->result_object();
		}	
		$this->template->display('sdm/pengajuanBiaya/pengajuanBiaya',$data);
	}

	public function insert()
	{
		$status = true;
		$tgl = '';
		$tanggal = '';

		$id_pengajuan_biaya = $this->input->post('id_pengajuan_biaya');
		$id_pegawai = $this->input->post('id_pegawai');
		$jumlah_nominal = $this->input->post('jumlah_nominal');		
		$status_pengajuan = $this->input->post('status_pengajuan');

		if(!empty($id_pengajuan_biaya)){
			$object = array(
				'jumlah_nominal' => $jumlah_nominal,
				'status_pengajuan' => $status_pengajuan
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

		// input uraian
		if(count($this->input->post('rincian')) > 0) {
			foreach ($this->input->post('rincian') as $i => $data) {	
				$id_pegawai = $datapegawai->id_pegawai;
				$id_pengajuan_biaya = $id_pengajuan_biaya;
				$id_kategori_biaya = isset($data['id_kategori_biaya']) ? $data['id_kategori_biaya'] : null;
				$id_uraian = $data['id_uraian'];
				$nominal 	= $data['nominal'];
				$nominal_disetujui 	= $data['nominal_disetujui'];

				$uraian = array(
					'id_pengajuan_biaya'=>$id_pengajuan_biaya,
					'nominal'=>$nominal,
					'nominal_disetujui'=>$nominal_disetujui
				);

				$uraian_baru = array(
					'id_uraian'=>'',
					'id_pengajuan_biaya'=>$id_pengajuan_biaya,
					'id_kategori_biaya'=>$id_kategori_biaya,
					'nominal'=>$nominal_disetujui,
					'nominal_disetujui'=>$nominal_disetujui
				);

				if(!empty($id_uraian)){
					$this->db->where('id_uraian', $id_uraian);
					$this->db->update('uraian_pengajuan_biaya', $uraian);
					$insert = $this->db->affected_rows();
				}else{
					$insert = $this->SDUraianPengajuanBiayaT->insert($uraian_baru);	
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
		$kategori_biaya_attribute = 'id="rincian_0_id_kategori_biaya" name="rincian[0][id_kategori_biaya]" class="form-control kategori_biaya" required';
		$kategori_biaya = $this->KategoriBiayaM->dd_kategori();
		$kategori_selected = $this->input->post('id_kategori_biaya') ? $this->input->post('id_kategori_biaya') : '';

		$data['tr'] = '';
		$data['tr'] .= '<tr>';
		$data['tr'] .= '<td>'.form_dropdown('rincian[0][id_kategori_biaya]', $kategori_biaya, $kategori_selected, $kategori_biaya_attribute).'</td>';
		$data['tr'] .= '<td><input id="rincian_0_nominal" name="rincian[0][nominal]" type="text" class="form-control numbers-only nominal" onblur="hitungTotalBiaya(this);" readonly=true><input id="rincian_0_id_uraian" name="rincian[0][id_uraian]" type="hidden" class="form-control numbers-only" onblur="hitungTotalBiaya(this);"></td>';
		$data['tr'] .= '<td><input id="rincian_0_nominal_disetujui" name="rincian[0][nominal_disetujui]" type="text" class="form-control numbers-only nominal_disetujui" onblur="hitungTotalBiayaDisetujui(this);" required></td>';
		$data['tr'] .= '<td><a href="javascript:tambahBiaya(this);"><button id="tambahBiaya" type="button" class="btn btn-small btn-success"><i class="fa fa-plus"></i></button></a> <a style="margin-left:10px;" href="javascript:hapusBiaya(this);"><button type="button" class="btn btn-small btn-danger" onClick="hapusBiaya(this);"><i class="fa fa-minus"></i></button></a></td>';
		$data['tr'] .= '</tr>';
		echo json_encode($data); 
		exit;
	}
}

/* End of file PengajuanBiaya.php */
/* Location: ./application/modules/sdm/controllers/PengajuanBiaya.php */