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

	public function tampilKartuPegawai($id_pegawai){
		$approve = 'Approved';
		$this->db->select('*');
		$this->db->from('pegawai');
		$this->db->join('user', 'user.id_user = pegawai.id_user');
		$this->db->like('status_approve_sdm', $approve);
		if($id_pegawai != ''){
			$this->db->where('id_pegawai', $id_pegawai);
		}
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