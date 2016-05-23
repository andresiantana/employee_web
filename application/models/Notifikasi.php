<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notifikasi extends CI_Model {

	public function tampilData(){
		return $this->db->get('notifikasi');
	}

	public function tampilNotifikasi(){
		$this->db->select('*');
		$this->db->from('notifikasi');
		$this->db->join('pegawai', 'pegawai.id_pegawai = notifikasi.id_pegawai');
		$this->db->where('notifikasi.status_baca is false');
		$this->db->where('DATE(notifikasi.tanggal) ="'.date('Y-m-d').'"');
		$this->db->order_by('notifikasi.tanggal','DESC');
		$query = $this->db->get();
		return $query;
	}

	public function tampilNotifikasiSDM(){
		$this->db->select('*');
		$this->db->from('notifikasi');
		$this->db->join('pegawai', 'pegawai.id_pegawai = notifikasi.id_pegawai');
		$this->db->where('notifikasi.status_baca is false');
		$this->db->where('DATE(notifikasi.tanggal) ="'.date('Y-m-d').'"');
		$this->db->order_by('notifikasi.tanggal','DESC');
		$query = $this->db->get();
		return $query;
	}

	public function tampilNotifikasiDariSDM(){
		$nama_role = 'SDM';
		$this->db->select('*');
		$this->db->from('notifikasi');
		$this->db->join('pegawai', 'pegawai.id_pegawai = notifikasi.id_pegawai','left');
		$this->db->join('user', 'user.id_user = notifikasi.id_user','left');
		$this->db->join('role', 'role.id_role = user.id_role','left');
		$this->db->where('user.id_role = 3');
		$this->db->where('notifikasi.status_baca is false');
		$this->db->where('DATE(notifikasi.tanggal) ="'.date('Y-m-d').'"');
		$this->db->order_by('notifikasi.tanggal','DESC');
		$query = $this->db->get();
		return $query;
	}

	public function tampilNotifikasiDariKeuangan(){
		$nama_role = 'Keuangan';
		$this->db->select('*');
		$this->db->from('notifikasi');
		$this->db->join('pegawai', 'pegawai.id_pegawai = notifikasi.id_pegawai','left');
		$this->db->join('user', 'user.id_user = notifikasi.id_user','left');
		$this->db->join('role', 'role.id_role = user.id_role','left');
		$this->db->where('user.id_role = 6');
		$this->db->where('notifikasi.status_baca is false');
		$this->db->where('DATE(notifikasi.tanggal) ="'.date('Y-m-d').'"');
		$this->db->order_by('notifikasi.tanggal','DESC');
		$query = $this->db->get();
		return $query;
	}


	public function insert($data){
		return $this->db->insert('notifikasi', $data);
	}
	
	public function delete($id){
		return $this->db->delete('notifikasi', array('id_notifikasi'=>$id));	
	}
}

/* End of file CoaM.php */
/* Location: ./application/models/CoaM.php */