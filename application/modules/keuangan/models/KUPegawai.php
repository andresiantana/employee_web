<?php
$obj = &get_instance();
$obj->load->model('Pegawai');
defined('BASEPATH') OR exit('No direct script access allowed');

class KUPegawai extends Pegawai {
	public function tampilDataPegawai() {
		$this->db->select('*');
		$this->db->from('pegawai');
		$this->db->join('user', 'user.id_user = pegawai.id_user');
		$this->db->join('fakultas', 'fakultas.kode_fakultas = pegawai.kode_fakultas','left');
		$this->db->join('prodi', 'prodi.id_prodi = pegawai.id_prodi','left');
		$query = $this->db->get();
		return $query;
	}

	public function tampilDataPegawaiAmortisasi() {
		$this->db->select('*');
		$this->db->from('pegawai');
		$this->db->join('user', 'user.id_user = pegawai.id_user');
		$this->db->join('fakultas', 'fakultas.kode_fakultas = pegawai.kode_fakultas','left');
		$this->db->join('prodi', 'prodi.id_prodi = pegawai.id_prodi','left');
		$this->db->join('jurnal', 'jurnal.id_pegawai = pegawai.id_pegawai','left');
		$this->db->where('pegawai.status_kelulusan','Lulus');
		$this->db->where('jurnal.status_aktif',true);
		$this->db->where('jurnal.no_akun',114);
		$query = $this->db->get();
		return $query;
	}

	public function printAmortisasiPerPegawai($id) {
		$this->db->select('*');
		$this->db->from('pegawai');
		$this->db->join('user', 'user.id_user = pegawai.id_user');
		$this->db->join('fakultas', 'fakultas.kode_fakultas = pegawai.kode_fakultas','left');
		$this->db->join('prodi', 'prodi.id_prodi = pegawai.id_prodi','left');
		$this->db->join('jurnal', 'jurnal.id_pegawai = pegawai.id_pegawai','left');
		$this->db->where('pegawai.status_kelulusan','Lulus');
		$this->db->where('pegawai.id_pegawai',$id);
		$this->db->where('jurnal.status_aktif',true);
		$this->db->where('jurnal.no_akun',114);
		$query = $this->db->get();
		return $query;
	}
}

/* End of file PGPegawai.php */
/* Location: ./application/modules/pegawai/models/PGPegawai.php */