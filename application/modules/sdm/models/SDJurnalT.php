<?php
$obj = &get_instance();
$obj->load->model('JurnalT');
defined('BASEPATH') OR exit('No direct script access allowed');

class SDJurnalT extends JurnalT {
	public function tampilJurnalPegawai($id_pegawai = null){
		$this->db->select('sum(biaya) as biaya');
		$this->db->from('jurnal');
		$this->db->join('pencairan_biaya', 'pencairan_biaya.id_pencairan_biaya = jurnal.id_pencairan_biaya');
		$this->db->join('pegawai', 'pegawai.id_pegawai = jurnal.id_pegawai','left');
		$this->db->where('jurnal.id_pegawai',$id_pegawai);
		$this->db->where('jurnal.status_aktif is true');
		$query = $this->db->get();
		return $query;
	}
}

/* End of file SDJurnalT.php */
/* Location: ./application/modules/sdm/models/SDJurnalT.php */