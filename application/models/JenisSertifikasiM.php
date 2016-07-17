<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class JenisSertifikasiM extends CI_Model {

	public function tampilData(){
		return $this->db->get('jenis_sertifikasi');
	}

	public function tampilDataSertifikasi($num, $offset, $nama_sertifikasi)
	{
		$this->db->order_by('nama_jenis_sertifikasi', 'ASC');
		if($nama_sertifikasi != ''){
			$this->db->like('nama_jenis_sertifikasi', $nama_sertifikasi);
		}
		$data = $this->db->get('jenis_sertifikasi', $num, $offset);

		return $data->result();
	}

	public function insert($data){
		return $this->db->insert('jenis_sertifikasi', $data);
	}
	
	public function delete($id){
		return $this->db->delete('jenis_sertifikasi', array('id_jenis_sertifikasi'=>$id));	
	}

    public function cekNama($nama) {
		$this->db->like('nama_jenis_sertifikasi', $nama);
        $query = $this->db->get("jenis_sertifikasi");
        return $query;
    }

    public function dd_jenis_sertifikasi(){
		// ambil data dari db
		$this->db->where('jenis_sertifikasi_aktif is TRUE');
		$this->db->order_by('nama_jenis_sertifikasi','asc');
		$result = $this->db->get('jenis_sertifikasi');

		// membuat array
		$dd[''] = '-Pilih Jenis Sertifikasi-';
		if($result->num_rows() > 0){
			foreach($result->result() as $row){
				$dd[$row->id_jenis_sertifikasi] = $row->nama_jenis_sertifikasi;
			}
		}
		return $dd;
	}
}

/* End of file JenisSertifikasiM.php */
/* Location: ./application/models/JenisSertifikasiM.php */