<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pegawai extends CI_Model {
	
	public function index(){

	}

	public function tampilData(){
		return $this->db->get('pegawai');
	}

	public function tampilDataPegawai(){
		$this->db->select('*');
		$this->db->from('pegawai');
		$this->db->join('user', 'user.id_user = pegawai.id_user');
		$query = $this->db->get();
		return $query;
	}

	public function tampilDataPegawaiApprove($nidn = null, $nip = null, $nama = null){
		$approve = 'Approved';
		$this->db->select('*');
		$this->db->from('pegawai');
		$this->db->join('user', 'user.id_user = pegawai.id_user');
		$this->db->join('fakultas', 'fakultas.kode_fakultas = pegawai.kode_fakultas','left');
		$this->db->join('prodi', 'prodi.id_prodi = pegawai.id_prodi','left');
		if(isset($_GET['pages'])){
			if(!empty($_GET['pages']) && $_GET['pages'] == 'pegawai'){
				$this->db->where('pegawai.id_user',$this->session->userdata('id_user'));
			}
		}
		$this->db->like('status_approve_sdm', $approve);
		if($nidn != ''){
			$this->db->like('nidn', $nidn);
		}
		if($nip != ''){
			$this->db->like('nip', $nip);
		}
		if($nama != ''){
			$this->db->like('nama', $nama);
		}
		$query = $this->db->get();
		return $query;
	}

	public function tampilDataPegawaiApprovePDPP($nidn = null, $nip = null, $nama = null){
		$approve = 'Approved';
		$this->db->select('*');
		$this->db->from('pegawai');
		$this->db->join('user', 'user.id_user = pegawai.id_user');
		$this->db->join('fakultas', 'fakultas.kode_fakultas = pegawai.kode_fakultas','left');
		$this->db->join('prodi', 'prodi.id_prodi = pegawai.id_prodi','left');
		$this->db->join('pengajuan_biaya', 'pengajuan_biaya.id_pegawai = pegawai.id_pegawai','left');
		$this->db->join('pencairan_biaya','pengajuan_biaya.id_pengajuan_biaya = pencairan_biaya.id_pengajuan_biaya');
		if(isset($_GET['pages'])){
			if(!empty($_GET['pages']) && $_GET['pages'] == 'pegawai'){
				$this->db->where('pegawai.id_user',$this->session->userdata('id_user'));
			}
		}
		$this->db->like('status_approve_sdm', $approve);
		if($nidn != ''){
			$this->db->like('nidn', $nidn);
		}
		if($nip != ''){
			$this->db->like('nip', $nip);
		}
		if($nama != ''){
			$this->db->like('nama', $nama);
		}
		$query = $this->db->get();
		return $query;
	}
	
	public function tampilDataPegawaiBaru(){
		$approve = 'Approved';
		$this->db->select('*');
		$this->db->from('pegawai');
		$this->db->join('user', 'user.id_user = pegawai.id_user');
		$this->db->join('fakultas', 'fakultas.kode_fakultas = pegawai.kode_fakultas','left');
		$this->db->join('prodi', 'prodi.id_prodi = pegawai.id_prodi','left');
		$this->db->where('status_approve_sdm is null');

		$query = $this->db->get();
		return $query;
	}

	public function tampilKartuPegawai($id_pegawai){
		$approve = 'Approved';
		$this->db->select('*');
		$this->db->from('pegawai');
		$this->db->join('user', 'user.id_user = pegawai.id_user');
		$this->db->join('fakultas', 'fakultas.kode_fakultas = pegawai.kode_fakultas','left');
		$this->db->join('prodi', 'prodi.id_prodi = pegawai.id_prodi','left');
		$this->db->join('lokasi_pendidikan', 'lokasi_pendidikan.id_lokasi = pegawai.id_lokasi','left');
		$this->db->like('status_approve_sdm', $approve);
		if($id_pegawai != ''){
			$this->db->where('id_pegawai', $id_pegawai);
		}
		$query = $this->db->get();
		return $query;
	}

	public function tampilUserPegawai($id_user){
		$approve = 'Approved';
		$this->db->select('*');
		$this->db->from('pegawai');
		$this->db->join('user', 'user.id_user = pegawai.id_user','left');
		$this->db->like('status_approve_sdm', $approve);
		if($id_user != ''){
			$this->db->where('pegawai.id_user', $id_user);
		}
		$this->db->limit = 1;
		$query = $this->db->get();
		return $query;
	}

	public function insert($data){
		return $this->db->insert('pegawai', $data);
	}
	
	public function delete($id){
		return $this->db->delete('pegawai', array('id_pegawai'=>$id));	
	}
}

/* End of file Pegawai.php */
/* Location: ./application/modules/pegawai/models/Pegawai.php */