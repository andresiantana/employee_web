<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class FakultasM extends CI_Model {

	public function tampilData(){
		return $this->db->get('fakultas');
	}

	public function insert($data){
		return $this->db->insert('fakultas', $data);
	}
	
	public function delete($id){
		return $this->db->delete('fakultas', array('kode_fakultas'=>$id));	
	}

    public function cekNama($nama) {
		$this->db->like('nama_fakultas', $nama);
        $query = $this->db->get("fakultas");
        return $query;
    }

    public function dd_fakultas(){
		// ambil data dari db
		$this->db->order_by('nama_fakultas','asc');
		$result = $this->db->get('fakultas');

		// membuat array
		$dd[''] = '--Pilih Fakultas--';
		if($result->num_rows() > 0){
			foreach($result->result() as $row){
				$dd[$row->kode_fakultas] = $row->nama_fakultas;
			}
		}
		return $dd;
	}

 	public function upload_data($filename){
        ini_set('memory_limit', '-1');
        $inputFileName = './data/uploads/'.$filename;
        try {
        $objPHPExcel = PHPExcel_IOFactory::load($inputFileName);
        } catch(Exception $e) {
        die('Error loading file :' . $e->getMessage());
        }
 
        $worksheet = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
        $numRows = count($worksheet);
 
        for ($i=2; $i < ($numRows+1) ; $i++) { 
            $ins = array(
                    "kode_fakultas"	=> $worksheet[$i]["A"],
                    "nama_fakultas"	=> $worksheet[$i]["B"],
                    "status_aktif"	=>true
                   ); 
            $this->db->insert('fakultas', $ins);
        }
    }
}

/* End of file FakultasM.php */
/* Location: ./application/models/FakultasM.php */