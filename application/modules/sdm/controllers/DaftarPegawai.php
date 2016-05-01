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
        $this->load->model('Pegawai');
        $this->load->model('Notifikasi');

	}

	public function index()
	{
		$data['username'] = $this->session->userdata('username');
		$data['id_user'] = $this->session->userdata('id_user');
		$data['nama_role'] = $this->session->userdata('nama_role');
		$data['judulHeader'] = 'Daftar Pegawai';
		$data['menu'] = 'daftarPegawai';
		$data['data']	= $this->Pegawai->tampilDataPegawai()->result_object();		
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

        $id_pegawai = isset($_GET['id_pegawai']) ? $_GET['id_pegawai'] : null;
        $object = array(
			'status_approve_sdm'=>'Approved'
		);

		$this->db->where('id_pegawai', $id_pegawai);
		$this->db->update('pegawai', $object);
		if($this->db->affected_rows()){
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
		$data['judulHeader'] = 'Notifikasi';
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
		$data['judulHeader'] = 'Notifikasi';
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

        $tgl = explode("/",$tanggal);		
		$tanggal = $tgl[2]."-".$tgl[1]."-".$tgl[0];
		$tanggal = $tanggal." ".date('H:i:s');

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
}

/* End of file DaftarPegawai.php */
/* Location: ./application/modules/admin/controllers/DaftarPegawai.php */