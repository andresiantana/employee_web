<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PengajuanBiayaT extends CI_Model {

	public function tampilData(){
		$this->db->select('*');
		$this->db->from('pengajuan_biaya');
		$this->db->join('pegawai', 'pegawai.id_pegawai = pengajuan_biaya.id_pegawai');
		$this->db->join('kategori_biaya', 'kategori_biaya.id_kategori_biaya = pengajuan_biaya.id_kategori_biaya','left');
		$query = $this->db->get();
		return $query;
	}

	public function insert($data){
		return $this->db->insert('pengajuan_biaya', $data);
	}
	
	public function delete($id){
		return $this->db->delete('pengajuan_biaya', array('id_pengajuan_biaya'=>$id));	
	}

	public function noPengajuanBiaya() {
        $default="0001";
        $prefix = 'PB'.date('ymd');
        $sql = "SELECT COUNT(kode_pengajuan) nomaksimal 
                FROM pengajuan_biaya 
                WHERE kode_pengajuan LIKE ('".$prefix."%')";
        $noPengajuan = $this->db->query($sql);
        $noPengajuan = $noPengajuan->row_array();
        $noPengajuanBaru =$prefix.(isset($noPengajuan['nomaksimal']) ? (str_pad($noPengajuan['nomaksimal']+1, strlen($default), 0,STR_PAD_LEFT)) : $default);
        return $noPengajuanBaru;
    }

	public function tampilPengajuanPegawai($id_pegawai){
		$approve = 'Approved';
		$this->db->select('*');
		$this->db->from('pengajuan_biaya');
		$this->db->where("status_pengajuan is NULL OR status_pengajuan = 'Reject Seterusnya'");
		if($id_pegawai != ''){
			$this->db->where('id_pegawai', $id_pegawai);
		}
		$this->db->limit = 1;
		$query = $this->db->get();
		return $query;
	}
}

/* End of file PengajuanBiayaT.php */
/* Location: ./application/models/PengajuanBiayaT.php */