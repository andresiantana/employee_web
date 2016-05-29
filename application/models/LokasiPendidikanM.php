<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LokasiPendidikanM extends CI_Model {

	public function tampilData($lokasi = null){
		if($lokasi != ''){
			$this->db->like('nama_lokasi', $lokasi);
        	$query = $this->db->get("lokasi_pendidikan");
		}else{
			$query = $this->db->get("lokasi_pendidikan");
		}
		return $query;
	}

    public function tampilDataLokasi($num, $offset, $nama_lokasi, $nama_universitas)
    {
        $this->db->order_by('nama_universitas', 'ASC');
        if($nama_lokasi != ''){
            $this->db->where('nama_lokasi', $nama_lokasi);
        }
        if($nama_universitas != ''){
            $this->db->like('nama_universitas', $nama_universitas);
        }
        $data = $this->db->get('lokasi_pendidikan', $num, $offset);

        return $data->result();
    }

    public function insert($data){
		return $this->db->insert('lokasi_pendidikan', $data);	
	}

	public function delete($id){
		return $this->db->delete('lokasi_pendidikan', array('id_lokasi'=>$id));	
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
        		"id_lokasi"=>'',
                "nama_lokasi"	=> $worksheet[$i]["A"],
                "nama_universitas"	=> $worksheet[$i]["B"],
                "kota"	=> $worksheet[$i]["C"],
                "negara"	=> $worksheet[$i]["D"],
                "alamat"	=> $worksheet[$i]["E"],
                "no_telp"	=> $worksheet[$i]["F"],
                "lokasi_aktif"	=>true
           	); 
            $this->db->insert('lokasi_pendidikan', $ins);
        }
    }
}

/* End of file User.php */
/* Location: ./application/models/User.php */