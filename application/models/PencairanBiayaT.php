<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PencairanBiayaT extends CI_Model {

	public function tampilData(){
		$this->db->select('*');
		$this->db->from('pencairan_biaya');
		$this->db->join('pegawai', 'pegawai.id_pegawai = pencairan_biaya.id_pegawai');
		$this->db->join('pengajuan_biaya', 'pengajuan_biaya.id_pengajuan_biaya = pencairan_biaya.id_pengajuan_biaya');
		$query = $this->db->get();
		return $query;
	}

	public function insert($data){
		return $this->db->insert('pencairan_biaya', $data);
	}
	
	public function delete($id){
		return $this->db->delete('pencairan_biaya', array('id_pencairan_biaya'=>$id));	
	}

	public function noPencairanBiaya() {
        $default="0001";
        $prefix = 'PCB'.date('ymd');
        $sql = "SELECT COUNT(kode_pencairan) nomaksimal 
                FROM pencairan_biaya 
                WHERE kode_pencairan LIKE ('".$prefix."%')";
        $noPencairan = $this->db->query($sql);
        $noPencairan = $noPencairan->row_array();
        $noPencairanBaru =$prefix.(isset($noPencairan['nomaksimal']) ? (str_pad($noPencairan['nomaksimal']+1, strlen($default), 0,STR_PAD_LEFT)) : $default);
        return $noPencairanBaru;
    }
}

/* End of file PencairanBiayaT.php */
/* Location: ./application/models/PencairanBiayaT.php */