<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ProdiM extends CI_Model {

	public function tampilData(){
		$this->db->select('*');
		$this->db->from('prodi');
		$this->db->join('fakultas', 'fakultas.kode_fakultas = prodi.kode_fakultas','Left');
		$query = $this->db->get();
        return $query;
	}

	public function tampilDataProdi($num, $offset, $kode, $nama)
	{
		$this->db->order_by('nama_prodi', 'ASC');
		if($kode != ''){
			$this->db->where('prodi.kode_fakultas', $kode);
		}
		if($nama != ''){
			$this->db->like('prodi.nama_prodi', $nama);
		}
		$this->db->join('fakultas', 'fakultas.kode_fakultas = prodi.kode_fakultas','Left');
		$data = $this->db->get('prodi', $num, $offset);

		return $data->result();
	}

	public function insert($data){
		return $this->db->insert('prodi', $data);
	}
	
	public function delete($id){
		return $this->db->delete('prodi', array('id_prodi'=>$id));	
	}

    public function cekNama($nama) {
		$this->db->like('nama_prodi', $nama);
        $query = $this->db->get("prodi");
        return $query;
    }

    public function dd_prodi(){
		// ambil data dari db
		$this->db->order_by('nama_prodi','asc');
		$result = $this->db->get('prodi');

		// membuat array
		$dd[''] = '--Pilih Prodi--';
		if($result->num_rows() > 0){
			foreach($result->result() as $row){
				$dd[$row->id_prodi] = $row->nama_prodi;
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
        		"id_prodi"=>'',
                "kode_fakultas"	=> $worksheet[$i]["A"],
                "kode_prodi"	=> $worksheet[$i]["B"],
                "nama_prodi"	=> $worksheet[$i]["C"],
                "status_aktif"	=>true
           	); 
            $this->db->insert('prodi', $ins);
        }
    }
}

/* End of file ProdiM.php */
/* Location: ./application/models/ProdiM.php */