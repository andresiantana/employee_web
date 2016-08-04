<?php
$obj = &get_instance();
$obj->load->model('UraianPengajuanBiayaT');
defined('BASEPATH') OR exit('No direct script access allowed');

class KUUraianPengajuanBiayaT extends UraianPengajuanBiayaT {
	public function tampilUraian($id_pegawai = null){
		$this->db->select('*');
		$this->db->from('uraian_pengajuan_biaya');
		$this->db->join('pengajuan_biaya', 'pengajuan_biaya.id_pengajuan_biaya = uraian_pengajuan_biaya.id_pengajuan_biaya');
		$this->db->join('kategori_biaya', 'kategori_biaya.id_kategori_biaya = uraian_pengajuan_biaya.id_kategori_biaya','left');
		$this->db->join('pencairan_biaya', 'pencairan_biaya.id_pencairan_biaya = pengajuan_biaya.id_pencairan_biaya');
		$this->db->where('pengajuan_biaya.id_pencairan_biaya is not null');
		$query = $this->db->get();
		return $query;
	}
	public function detailPengajuan($id_pencairan_biaya = null){
		$this->db->select('*');
		$this->db->from('uraian_pengajuan_biaya');
		$this->db->join('pengajuan_biaya', 'pengajuan_biaya.id_pengajuan_biaya = uraian_pengajuan_biaya.id_pengajuan_biaya');
		$this->db->join('kategori_biaya', 'kategori_biaya.id_kategori_biaya = uraian_pengajuan_biaya.id_kategori_biaya','left');
		$this->db->join('pencairan_biaya', 'pencairan_biaya.id_pencairan_biaya = pengajuan_biaya.id_pencairan_biaya');
		$this->db->where('pengajuan_biaya.id_pencairan_biaya is not null');
		$this->db->where('pengajuan_biaya.id_pencairan_biaya',$id_pencairan_biaya);
		$query = $this->db->get();
		return $query;
	}
	public function detailPengajuanPencairan($id_pencairan_biaya = null){
		$this->db->select('uraian_pengajuan_biaya.id_kategori_biaya,sum(uraian_pengajuan_biaya.nominal) as nominal, sum(uraian_pengajuan_biaya.nominal_disetujui) as nominal_disetujui,pencairan_biaya.kode_pencairan,pencairan_biaya.tanggal_pencairan,kategori_biaya.nama_kategori');
		$this->db->from('uraian_pengajuan_biaya');
		$this->db->join('pengajuan_biaya', 'pengajuan_biaya.id_pengajuan_biaya = uraian_pengajuan_biaya.id_pengajuan_biaya');
		$this->db->join('kategori_biaya', 'kategori_biaya.id_kategori_biaya = uraian_pengajuan_biaya.id_kategori_biaya');
		$this->db->join('pencairan_biaya', 'pencairan_biaya.id_pencairan_biaya = pengajuan_biaya.id_pencairan_biaya');
		$this->db->where('pengajuan_biaya.id_pencairan_biaya is not null');
		$this->db->where('pengajuan_biaya.id_pencairan_biaya',$id_pencairan_biaya);
		$this->db->group_by('uraian_pengajuan_biaya.id_kategori_biaya');
		$query = $this->db->get();
		return $query;
	}
}

/* End of file KUUraianPengajuanBiayaT.php */
/* Location: ./application/modules/keuangan/models/KUUraianPengajuanBiayaT.php */