<?php
$obj = &get_instance();
$obj->load->model('UraianPengajuanBiayaT');
defined('BASEPATH') OR exit('No direct script access allowed');

class PGUraianPengajuanBiayaT extends UraianPengajuanBiayaT {
	public function tampilUraian($id_pegawai = null){
		$this->db->select('*');
		$this->db->from('uraian_pengajuan_biaya');
		$this->db->join('pengajuan_biaya', 'pengajuan_biaya.id_pengajuan_biaya = uraian_pengajuan_biaya.id_pengajuan_biaya');
		$this->db->join('kategori_biaya', 'kategori_biaya.id_kategori_biaya = uraian_pengajuan_biaya.id_kategori_biaya','left');
		$this->db->join('pencairan_biaya', 'pencairan_biaya.id_pencairan_biaya = pencairan_biaya.id_pencairan_biaya');
		$this->db->where('pengajuan_biaya.id_pencairan_biaya is not null');
		$query = $this->db->get();
		return $query;
	}

	public function tampilUraianPengajuan($id_pengajuan_biaya = null){
		$this->db->select('*');
		$this->db->from('uraian_pengajuan_biaya');
		$this->db->join('pengajuan_biaya', 'pengajuan_biaya.id_pengajuan_biaya = uraian_pengajuan_biaya.id_pengajuan_biaya');
		$this->db->join('kategori_biaya', 'kategori_biaya.id_kategori_biaya = uraian_pengajuan_biaya.id_kategori_biaya');
		$this->db->where('pengajuan_biaya.id_pengajuan_biaya',$id_pengajuan_biaya);
		$query = $this->db->get();
		return $query;
	}
}

/* End of file SDUraianPengajuanBiayaT.php */
/* Location: ./application/modules/pegawai/models/SDUraianPengajuanBiayaT.php */