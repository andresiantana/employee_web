<?php
$obj = &get_instance();
$obj->load->model('UraianPencairanBiayaT');
defined('BASEPATH') OR exit('No direct script access allowed');

class SDUraianPencairanBiayaT extends UraianPencairanBiayaT {
	public function tampilUraian($id_pegawai = null){
		$this->db->select('*');
		$this->db->from('uraian_pencairan_biaya');
		$this->db->join('pencairan_biaya', 'pencairan_biaya.id_pencairan_biaya = uraian_pencairan_biaya.id_pencairan_biaya');
		$this->db->join('kategori_biaya', 'kategori_biaya.id_kategori_biaya = uraian_pencairan_biaya.id_kategori_biaya');
		$this->db->join('pengajuan_biaya', 'pengajuan_biaya.id_pengajuan_biaya = pencairan_biaya.id_pengajuan_biaya');
x		$query = $this->db->get();
		return $query;
	}
}

/* End of file SDUraianPencairanBiayaT.php */
/* Location: ./application/modules/sdm/models/SDUraianPencairanBiayaT.php */