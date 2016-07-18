<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DaftarPegawai extends CI_Controller {

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
        $this->load->model('SDPegawai');
        $this->load->model('Notifikasi');
        $this->load->model('SDJurnalT');
	}

	public function index()
	{
		$data['username'] = $this->session->userdata('username');
		$data['id_user'] = $this->session->userdata('id_user');
		$data['nama_role'] = $this->session->userdata('nama_role');
		$data['judulHeader'] = 'Daftar Pegawai';
		$data['menu'] = 'daftarPegawai';
		$data['data']	= $this->SDPegawai->tampilDataPegawai()->result_object();		
		$this->template->display('sdm/daftarPegawai/index',$data);
	}

	function file_download()
    {
        $nama_file = $_GET['file_name'];
        $data = file_get_contents(base_url()."data/file/pegawai/".$nama_file);

        force_download($nama_file, $data);
	}

	function approveData()
    {
    	$status = '';
    	$status_notifikasi = false;

        $id_pegawai = isset($_GET['id_pegawai']) ? $_GET['id_pegawai'] : null;
        $object = array(
			'status_approve_sdm'=>'Approved',
			'tanggal_approve_sdm'=>date('Y-m-d')
		);

		$this->db->where('id_pegawai', $id_pegawai);
		$this->db->update('pegawai', $object);

		if($this->db->affected_rows()){
			$tanggal = date('Y-m-d H:i:s');
			$pesan = 'Data Pengajuan Pegawai sudah di Approve oleh SDM';
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

	function rejectData()
    {
    	$status = '';
    	$status_notifikasi = false;

        $id_pegawai = isset($_GET['id_pegawai']) ? $_GET['id_pegawai'] : null;
        $object = array(
			'status_approve_sdm'=>'Reject',
			'tanggal_approve_sdm'=>date('Y-m-d')
		);

		$this->db->where('id_pegawai', $id_pegawai);
		$this->db->update('pegawai', $object);

		if($this->db->affected_rows()){
			$tanggal = date('Y-m-d H:i:s');
			$pesan = 'Data Pengajuan Pegawai di Reject oleh SDM';
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

	public function notifikasi($id = null)
	{		
		$data['judulHeader'] = 'Pemberitahuan';
		$data['menu'] = 'dashboard';
		$data['username'] = $this->session->userdata('username');
		$data['id_user'] = $this->session->userdata('id_user');
		$data['nama_role'] = $this->session->userdata('nama_role');
		$data['datapegawai'] = $this->db->get_where('pegawai',array('id_pegawai'=>$id))->row();
		$this->template->display('sdm/daftarPegawai/notifikasi',$data);
	}

	public function loadNotifikasi()
	{		
		$id  = isset($_POST['id_notifikasi']) ? $_POST['id_notifikasi'] : null;
		$data['isi_pesan'] = '';
		$data['status'] = '';
		$data['judulHeader'] = 'Pemberitahuan';
		$data['menu'] = 'dashboard';
		$data['username'] = $this->session->userdata('username');
		$data['nama_role'] = $this->session->userdata('nama_role');
		$notifikasi = $this->db->get_where('notifikasi',array('id_notifikasi'=>$id))->row();
		$user = $this->db->get_where('user',array('id_user'=>$notifikasi->id_user))->row();
		$data['isi_pesan'] = 'Nama User : '.$user->nama_lengkap.' <br> Tanggal : '.date('d M Y H:i:s',strtotime($notifikasi->tanggal)).' <br> Isi Pesan : '.$notifikasi->pesan;

		$object = array(
			'status_baca'=>true
		);

		$this->db->where('id_notifikasi', $id);
		$this->db->update('notifikasi', $object);
		if ($this->db->affected_rows()) {
			$data['status'] = true;
		}
		echo json_encode($data);
		exit;
	}

	function kirimNotifikasi()
    {
    	$status = '';

        $id_pegawai = $this->input->post('id_pegawai') ;
        $tanggal = $this->input->post('tanggal');
        $pesan = $this->input->post('isi_pesan');

  //       $tgl = explode("/",$tanggal);		
		// $tanggal = $tgl[2]."-".$tgl[1]."-".$tgl[0];
		// $tanggal = $tanggal." ".date('H:i:s');

        $object = array(
			'id_pegawai'=>$id_pegawai,
			'tanggal'=>$tanggal,
			'pesan'=>$pesan,
			'id_user'=>$this->session->userdata('id_user')
		);

		$insert = $this->Notifikasi->insert($object);
		if($insert){
			$status = true;
		}else{
			$status = false;
		}

		if($status == 'berhasil'){
			echo "<script>alert('Notifikasi berhasil dikirim!');
                    window.location.href='".base_url('sdm/daftarPegawai')."';
                </script>";
		}else{
			echo "<script>alert('Notifikasi gagal dikirim!');
                    window.location.href='".base_url('sdm/daftarPegawai')."';
                </script>";
		}
	}

	function updateStatusLulus()
    {
    	$status = '';

        $id_pegawai = isset($_GET['id_pegawai']) ? $_GET['id_pegawai'] : null;
        $status_kelulusan = isset($_GET['status_kelulusan']) ? $_GET['status_kelulusan'] : null;
        $tanggal_selesai_studi = isset($_GET['tanggal_selesai_studi']) ? $_GET['tanggal_selesai_studi'] : null;

        // load data pegawai
        $pegawai = $this->db->get_where('pegawai',array('id_pegawai'=>$id_pegawai))->row();
        $tanggal_mulai_studi = $pegawai->tanggal_mulai_studi;

        // menghitung bulan
        $tgl1 = strtotime($tanggal_selesai_studi);
		$tgl2 = strtotime($tanggal_mulai_studi);
		$diff_secs = abs($tgl1-$tgl2);
		$base_year = min(date("Y", $tgl1), date("Y", $tgl2));
		$diff = mktime(0, 0, $diff_secs, 1, 1, $base_year);
		// return array( "years" => date(“Y”, $diff) – $base_year,
		// “months_total” => (date(“Y”, $diff) – $base_year) * 12 + date(“n”, $diff) – 1,
		// “months” => date(“n”, $diff) – 1,
		// “days_total” => floor($diff_secs / (3600 * 24)),
		// “days” => date(“j”, $diff) – 1,
		// “hours_total” => floor($diff_secs / 3600),
		// “hours” => date(“G”, $diff),
		// “minutes_total” => floor($diff_secs / 60),
		// “minutes” => (int) date(“i”, $diff),
		// “seconds_total” => $diff_secs,
		// “seconds” => (int) date(“s”, $diff)&nbsp; );
		$bln = date('m');
		$thn = date('Y');
		$jumlah_hari = cal_days_in_month(CAL_GREGORIAN,$bln, $thn);
        $bulan = (date("Y", $diff) - $base_year) * 12 + date("n", $diff) - 1;

        $object = array(
			'status_kelulusan'=>$status_kelulusan,
			'tanggal_selesai_studi'=>$tanggal_selesai_studi,
			'lama_bulan_studi'=>$bulan
		);

		$this->db->where('id_pegawai', $id_pegawai);
		$query = $this->db->update('pegawai', $object);
		if($query){			
	        $object = array(
				'id_pegawai'=>$id_pegawai,
				'tanggal'=>date('Y-m')."-".$jumlah_hari,
				'pesan'=>"Pegawai sudah Lulus Studi",
				'id_user'=>$this->session->userdata('id_user')
			);

			$insert = $this->Notifikasi->insert($object);
			if($status_kelulusan == 'Lulus'){
				$dataJurnal = $this->SDJurnalT->tampilJurnalPegawai($id_pegawai)->row();
				// Jurnal Pegawai Studi Lanjut		
				$object_jurnal_kredit = array(
					'id_jurnal'=>'',
					'id_pencairan_biaya'=>NULL,
					'id_pegawai'=>$id_pegawai,
					'tanggal_jurnal'=>date('Y-m')."-".$jumlah_hari,
					'no_akun'=>111,
					'keterangan'=>'Pegawai Studi Lanjut',
					'status'=>'K',
					'biaya'=>$dataJurnal->biaya,
					'status_aktif'=>true
				);	
				$object_jurnal_debit = array(
					'id_jurnal'=>'',
					'id_pencairan_biaya'=>NULL,
					'id_pegawai'=>$id_pegawai,
					'tanggal_jurnal'=>date('Y-m')."-".$jumlah_hari,
					'no_akun'=>114,
					'keterangan'=>'Pegawai Studi Lanjut',
					'status'=>'D',
					'biaya'=>$dataJurnal->biaya,
					'status_aktif'=>true
				);	

				$this->JurnalT->insert($object_jurnal_debit);
		 		$this->JurnalT->insert($object_jurnal_kredit);

		 		$amortisasi = (2*$bulan)+12;
        		$biaya_amortisasi = ($dataJurnal->biaya/$amortisasi);

        		for($i = 0; $i<$amortisasi; $i++){
        			// Jurnal Beban Amortisasi							
					$object_jurnal_amortisasi_kredit = array(
						'id_jurnal'=>'',
						'id_pencairan_biaya'=>NULL,
						'id_pegawai'=>$id_pegawai,
						'tanggal_jurnal'=>date('Y-m')."-".$jumlah_hari,
						'no_akun'=>114,
						'keterangan'=>'Pegawai Studi Lanjut',
						'status'=>'K',
						'biaya'=>$biaya_amortisasi,
						'status_aktif'=>true
					);	

					$object_jurnal_amortisasi_debit = array(
						'id_jurnal'=>'',
						'id_pencairan_biaya'=>NULL,
						'id_pegawai'=>$id_pegawai,
						'tanggal_jurnal'=>date('Y-m')."-".$jumlah_hari,
						'no_akun'=>511,
						'keterangan'=>'Beban Amortisasi PID',
						'status'=>'D',
						'biaya'=>$biaya_amortisasi,
						'status_aktif'=>true
					);	

					$this->JurnalT->insert($object_jurnal_amortisasi_debit);
			 		$this->JurnalT->insert($object_jurnal_amortisasi_kredit);
        		}

			}

			// update jurnal aktif = false
			$object = array(
				'status_aktif'=>false
			);
			$this->db->where('id_pegawai', $id_pegawai);
			$this->db->where('id_pencairan_biaya is not null');
			$query_jurnal = $this->db->update('jurnal', $object);
			if($query_jurnal){
				$status = true;
			}
			$status = true;
		}else{
			$status = false;
		}

		$data['status'] = $status;
		echo json_encode($data); 
		exit;
	}

}

/* End of file DaftarPegawai.php */
/* Location: ./application/modules/admin/controllers/DaftarPegawai.php */