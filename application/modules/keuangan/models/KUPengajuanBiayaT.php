<?php
$obj = &get_instance();
$obj->load->model('PengajuanBiayaT');
defined('BASEPATH') OR exit('No direct script access allowed');

class KUPengajuanBiayaT extends PengajuanBiayaT {
	public function tampilData($nama_pegawai = null , $kode_pengajuan = null, $id_kategori_biaya = null , $status_pengajuan = null, $tanggal_awal = null ,$tanggal_akhir = null){
		$this->db->select('*');
		$this->db->from('pengajuan_biaya');
		$this->db->join('pegawai', 'pegawai.id_pegawai = pengajuan_biaya.id_pegawai');
		$this->db->join('kategori_biaya', 'kategori_biaya.id_kategori_biaya = pengajuan_biaya.id_kategori_biaya','left');
		$this->db->like('pengajuan_biaya.status_pengajuan', 'Approved');
		if($nama_pegawai != ''){
			$this->db->like('pegawai.nama_lengkap', $nama_pegawai);
		}
		if($kode_pengajuan != ''){
			$this->db->like('pengajuan_biaya.kode_pengajuan', $kode_pengajuan);
		}
		if($id_kategori_biaya != ''){
			$this->db->where('pengajuan_biaya.id_kategori_biaya', $id_kategori_biaya);
		}
		if($tanggal_awal != ''){
			$this->db->where('pengajuan_biaya.tanggal', $tanggal_awal);
		}
		$query = $this->db->get();
		return $query;
	}
}

/* End of file KUPengajuanBiayaT.php */
/* Location: ./application/modules/keuangan/models/KUPengajuanBiayaT.php */