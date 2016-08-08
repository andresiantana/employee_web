<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class JurnalT extends CI_Model {
	public function insert($data){
		return $this->db->insert('jurnal', $data);
	}

	public function tampilJurnal($bulan = null, $tahun = null) {
		$this->db->from('jurnal');
		$this->db->join('coa', 'coa.no_akun = jurnal.no_akun');
		$this->db->join('pegawai', 'pegawai.id_pegawai = jurnal.id_pegawai');
		
		$this->db->where("YEAR(jurnal.tanggal_jurnal)", $tahun);
		$this->db->where("MONTH(jurnal.tanggal_jurnal)", $bulan);
		$this->db->where("jurnal.status_aktif is true");
		$this->db->where("jurnal.konfirmasi_terima is true");
		$this->db->order_by("jurnal.tanggal_jurnal,jurnal.id_jurnal","asc");
		$query = $this->db->get();
        return $query;
    }

    public function tampilBukuBesar($bulan = null, $tahun = null, $no_akun = null) {
 		$this->db->select('*');
		$this->db->from('jurnal');
		$this->db->join('coa', 'coa.no_akun = jurnal.no_akun');
		$this->db->where("MONTH(jurnal.tanggal_jurnal)", $bulan);
		$this->db->where("YEAR(jurnal.tanggal_jurnal)", $tahun);
		$this->db->where("jurnal.no_akun", $no_akun);
		$this->db->where("jurnal.status_aktif is true");
		$this->db->order_by("jurnal.tanggal_jurnal,jurnal.id_jurnal","asc");
		$this->db->order_by("jurnal.status","asc");
		$query = $this->db->get();
        return $query;
    }

    public function saldoAwal($bulan = null, $tahun = null) {
    	$bulan_sebelumnya = $bulan - 1;
        if($bulan == '01'){
            $bulan_sebelumnya = 12;
            $tahun = date('Y')-1;
        }
        $no_akun = 311; // No. Akun MODAL
        $bulan_sekarang = date('m');

 		$this->db->select('sum(biaya) as biaya');
		$this->db->from('jurnal');
		$this->db->join('coa', 'coa.no_akun = jurnal.no_akun');
		if($bulan != $bulan_sekarang){
			$this->db->where("MONTH(jurnal.tanggal_jurnal)", $bulan_sebelumnya);	
		}else{
			$this->db->where("MONTH(jurnal.tanggal_jurnal)", $bulan);	
		}
		
		$this->db->where("YEAR(jurnal.tanggal_jurnal)", $tahun);
		$this->db->where("jurnal.no_akun", $no_akun);
		$this->db->where("jurnal.status_aktif is true");
		$query = $this->db->get();
        return $query;
    }

    public function saldoDebit($bulan = null, $tahun = null, $no_akun = null) {
    	$bulan_sebelumnya = $bulan - 1;
        if($bulan == '01'){
            $bulan_sebelumnya = 12;
            $tahun = date('Y')-1;
        }

 		$this->db->select('sum(biaya) as biaya');
		$this->db->from('jurnal');
		$this->db->join('coa', 'coa.no_akun = jurnal.no_akun');
		$this->db->where("MONTH(jurnal.tanggal_jurnal)", $bulan_sebelumnya);
		$this->db->where("YEAR(jurnal.tanggal_jurnal)", $tahun);
		$this->db->where("jurnal.no_akun", $no_akun);
		$this->db->where("jurnal.status", 'D');
		$this->db->where("jurnal.status_aktif is true");
		$query = $this->db->get();
        return $query;
    }

    public function saldoKredit($bulan = null, $tahun = null, $no_akun = null) {
    	$bulan_sebelumnya = $bulan - 1;
        if($bulan == '01'){
            $bulan_sebelumnya = 12;
            $tahun = date('Y')-1;
        }

 		$this->db->select('sum(biaya) as biaya');
		$this->db->from('jurnal');
		$this->db->join('coa', 'coa.no_akun = jurnal.no_akun');
		$this->db->where("MONTH(jurnal.tanggal_jurnal)", $bulan_sebelumnya);
		$this->db->where("YEAR(jurnal.tanggal_jurnal)", $tahun);
		$this->db->where("jurnal.no_akun", $no_akun);
		$this->db->where("jurnal.status", 'K');
		$this->db->where("jurnal.status_aktif is true");
		$query = $this->db->get();
        return $query;
    }

}
/* End of file JurnalT.php */
/* Location: ./application/models/JurnalT.php */