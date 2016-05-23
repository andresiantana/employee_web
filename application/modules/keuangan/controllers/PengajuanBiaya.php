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
		$this->load->model('KUPengajuanBiayaT');
		$this->load->model('KUPencairanBiayaT');
		$this->load->model('JurnalT');
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
	
		if($nip != '' || $kode_pengajuan != '' ||  $tanggal_awal != '' || $tanggal_akhir != ''){
			$data['data'] =  $this->KUPengajuanBiayaT->tampilData($nip,$kode_pengajuan,$tanggal_awal,$tanggal_akhir)->result_object();		
			$tr['tr'] = $this->load->view('keuangan/pengajuanBiaya/pencarian',$data,true);
			echo json_encode($tr['tr']); 
			exit;
		}else{
			$data['data']	= $this->KUPengajuanBiayaT->tampilData()->result_object();			
		}	

		$this->template->display('keuangan/pengajuanBiaya/index',$data);
	}

	public function pencairanBiaya()
	{
		$id = isset($_GET['id']) ? $_GET['id'] : null;
		$id_pengajuan_biaya = isset($_GET['id_pengajuan_biaya']) ? $_GET['id_pengajuan_biaya'] : null;

		$data['username'] 		= $this->session->userdata('username');
		$data['id_user'] 		= $this->session->userdata('id_user');
		$data['nama_role'] 		= $this->session->userdata('nama_role');
		$data['judulHeader'] 	= 'Pencairan Biaya';
		$data['menu'] 			= 'pencairanBiaya';
		$data['kategori'] 		= $this->db->select('*')
									->from('kategori_biaya')
									->get()->result_object();
		$data['kode_pencairan'] = $this->KUPencairanBiayaT->noPencairanBiaya();
		if(!empty($id)){			
			$data['datapencairan'] = $this->db->get_where('pencairan_biaya',array('id_pencairan_biaya'=>$id))->row();
			$data['kode_pencairan'] = $data['datapencairan']->kode_pencairan;
		}
		if(!empty($id_pengajuan_biaya)){
			$data['datapengajuan'] = $this->db->get_where('pengajuan_biaya',array('id_pengajuan_biaya'=>$id_pengajuan_biaya))->row();
		}
		$this->template->display('keuangan/pengajuanBiaya/pencairanBiaya',$data);
	}

	public function insert_pencairan()
	{
		$tgl = '';
		$tanggal = '';
		$id_pencairan_biaya = $this->input->post('id_pencairan_biaya');
		$id_pengajuan_biaya = $this->input->post('id_pengajuan_biaya');
		$id_pegawai = $this->input->post('id_pegawai');
		$id_kategori_biaya = $this->input->post('id_kategori_biaya');
		$kode_pencairan = $this->input->post('kode_pencairan');
		$semester = $this->input->post('semester');
		$jumlah_biaya = $this->input->post('jumlah_biaya');
		$berhasil_transfer = $this->input->post('berhasil_transfer');
		$gagal_transfer = $this->input->post('gagal_transfer');
		$keterangan = $this->input->post('keterangan');

		$tanggal = $this->input->post('tanggal_pencairan');
		$tgl = explode("/",$tanggal);		
		$tanggal = $tgl[2]."-".$tgl[1]."-".$tgl[0];
		$tanggal = $tanggal;

		$data = array(
			'id_pencairan_biaya' =>'',
			'id_pengajuan_biaya' =>$id_pengajuan_biaya,
			'id_pegawai' => $id_pegawai,
			'tanggal_pencairan'=>$tanggal,
			'kode_pencairan' => $kode_pencairan,
			'jumlah_biaya' => $jumlah_biaya,
			'berhasil_transfer' => $berhasil_transfer,
			'gagal_transfer' => $gagal_transfer,
			'keterangan' => $keterangan
		);

		if(!empty($id_pencairan_biaya)){
			$this->db->where('id_pencairan_biaya', $id_pencairan_biaya);
			$this->db->update('pencairan_biaya', $data);
			$insert = $this->db->affected_rows();

	        $object = array(
				'id_pengajuan_biaya' =>$id_pengajuan_biaya,
				'id_pegawai' => $id_pegawai,
				'tanggal_pencairan'=>$tanggal,
				'kode_pencairan' => $kode_pencairan,
				'jumlah_biaya' => $jumlah_biaya,
				'berhasil_transfer' => $berhasil_transfer,
				'gagal_transfer' => $gagal_transfer,
				'keterangan' => $keterangan
			);
		}else{
			$insert = $this->KUPencairanBiayaT->insert($data);	
			// update pengajuan_biaya
			$datapencairan = $this->db->get_where('pencairan_biaya',array('id_pengajuan_biaya'=>$id_pengajuan_biaya),array('limit'=>1))->row();
		 	$pengajuan = array(
				'id_pencairan_biaya'=>$datapencairan->id_pencairan_biaya
			);

			$this->db->where('id_pengajuan_biaya', $id_pengajuan_biaya);
			$this->db->update('pengajuan_biaya', $pengajuan);

			// send notifikasi
			$datapengajuan = $this->db->get_where('pengajuan_biaya',array('id_pengajuan_biaya'=>$id_pengajuan_biaya))->row();
			$object = array(
				'id_pegawai'=>$datapengajuan->id_pengajuan_biaya,
				'tanggal'=>date('Y-m-d H:i:s'),
				'pesan'=>'Kode Pengajuan : '.$datapengajuan->kode_pengajuan.' Sudah dicairkan oleh Bagian Keuangan',
				'id_user'=>$this->session->userdata('id_user')
			);
			$this->Notifikasi->insert($object);

			// input jurnal Debit dan Kredit
			if($gagal_transfer > 0){
				// Jurnal Gagal Transfer			
				$object_jurnal_kredit = array(
					'id_jurnal'=>'',
					'id_pencairan_biaya'=>$datapencairan->id_pencairan_biaya,
					'id_pegawai'=>$id_pegawai,
					'tanggal_jurnal'=>date('Y-m-d'),
					'no_akun'=>111,
					'keterangan'=>'Pencairan Dana Berhasil Transfer',
					'status'=>'K',
					'biaya'=>$berhasil_transfer
				);	
				$object_jurnal_debit = array(
					'id_jurnal'=>'',
					'id_pencairan_biaya'=>$datapencairan->id_pencairan_biaya,
					'id_pegawai'=>$id_pegawai,
					'tanggal_jurnal'=>date('Y-m-d'),
					'no_akun'=>112,
					'keterangan'=>'Pencairan Dana Berhasil Transfer',
					'status'=>'D',
					'biaya'=>$berhasil_transfer
				);	
			}else{
				// Jurnal Berhasil Transfer			
				$object_jurnal_kredit = array(
					'id_jurnal'=>'',
					'id_pencairan_biaya'=>$datapencairan->id_pencairan_biaya,
					'id_pegawai'=>$id_pegawai,
					'tanggal_jurnal'=>date('Y-m-d'),
					'no_akun'=>111,
					'deskripsi'=>'Pencairan Dana Berhasil Transfer',
					'status'=>'K',
					'biaya'=>$berhasil_transfer
				);	
				$object_jurnal_debit = array(
					'id_jurnal'=>'',
					'id_pencairan_biaya'=>$datapencairan->id_pencairan_biaya,
					'id_pegawai'=>$id_pegawai,
					'tanggal_jurnal'=>date('Y-m-d'),
					'no_akun'=>113,
					'deskripsi'=>'Pencairan Dana Berhasil Transfer',
					'status'=>'D',
					'biaya'=>$berhasil_transfer
				);	
			}
				 	
		 	$this->JurnalT->insert($object_jurnal_debit);
		 	$this->JurnalT->insert($object_jurnal_kredit);
		}	

		if ($insert) {
			echo "<script>alert('Pencairan Biaya berhasil disimpan!');
                    window.location.href='".base_url('keuangan/PengajuanBiaya/pencairanBiaya?id='.$datapencairan->id_pencairan_biaya).'&id_pengajuan_biaya='.$id_pengajuan_biaya."';
                </script>";
		} else {
			echo "<script>alert('Pencairan Biaya gagal disimpan!');
                    window.location.href='".base_url('keuangan/PengajuanBiaya/index')."';
                </script>";  
		}
       
	}

	public function printPencairanBiaya($id = null)
	{
		$data['username'] 		= $this->session->userdata('username');
		$data['id_user'] 		= $this->session->userdata('id_user');
		$data['nama_role'] 		= $this->session->userdata('nama_role');
		$data['datapencairan'] = $this->KUPencairanBiayaT->tampilDataTransaksi($id)->row();			
		$this->load->view('keuangan/pengajuanBiaya/print_pencairan', $data);
	}

}

/* End of file PengajuanBiaya.php */
/* Location: ./application/modules/sdm/controllers/PengajuanBiaya.php */