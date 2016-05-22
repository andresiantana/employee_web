<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fakultas extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('username')=="") {
			redirect('login');
		}
		$this->load->library('template');
		$this->load->library("PHPExcel");	
		$this->load->helper(array('form','url'));			
		$this->load->library('form_validation');
		$this->load->library('session');      
        $this->load->model('FakultasM');
	}

	public function index()
	{
		$data['username'] 		= $this->session->userdata('username');
		$data['id_user'] 		= $this->session->userdata('id_user');
		$data['nama_role'] 		= $this->session->userdata('nama_role');
		$data['judulHeader'] 	= 'Fakultas';
		$data['menu'] 	= 'fakultas';
		$data['data']	= $this->FakultasM->tampilData()->result_object();				
		$this->template->display('admin/fakultas/admin',$data);
	}

	public function tambah()
	{
		$data['username'] 	= $this->session->userdata('username');
		$data['id_user'] 	= $this->session->userdata('id_user');
		$data['nama_role'] 	= $this->session->userdata('nama_role');
		$data['judulHeader'] = 'Fakultas';
		$data['menu'] = 'fakultas';		
		$this->template->display('admin/fakultas/tambah',$data);
	}

	public function insert()
	{
		$status = '';

		foreach ($this->input->post('fakultas') as $i => $data) {	
			$kode_fakultas = $data['kode_fakultas'];
			$nama_fakultas = $data['nama_fakultas'];
			$status_aktif 	= true;

			$object = array(
				'kode_fakultas'=>$kode_fakultas,
				'nama_fakultas'=>$nama_fakultas,
				'status_aktif'=>$status_aktif
			);

			$insert = $this->FakultasM->insert($object);
			
			if($insert){
				$status = 'berhasil';
			}
		}

		if($status == 'berhasil'){
			echo "<script>alert('Data berhasil disimpan!');
                    window.location.href='".base_url('admin/Fakultas/index')."';
                </script>";
		}else{
			echo "<script>alert('Data gagal disimpan!');
                    window.location.href='".base_url('admin/Fakultas/tambah')."';
                </script>";
		}
	}

	public function importFakultas($sukses = "")
	{
		$data['username'] 	= $this->session->userdata('username');
		$data['id_user'] 	= $this->session->userdata('id_user');
		$data['nama_role'] 	= $this->session->userdata('nama_role');
		$data['judulHeader'] = 'Fakultas';
		$data['menu'] = 'fakultas';		
		$this->template->display('admin/fakultas/import',$data);
	}

	public function do_upload(){
        $config['upload_path'] = './data/uploads/';
        $config['allowed_types'] = 'xlsx|xls';
        
        $this->load->library('upload', $config);
        
        if (!$this->upload->do_upload("file")){
            $error = array('error' => $this->upload->display_errors());
        }
        else{
            $data = array('upload_data' => $this->upload->data());
            $upload_data = $this->upload->data(); //Mengambil detail data yang di upload
            $filename = $upload_data['file_name'];//Nama File
            $this->FakultasM->upload_data($filename);
            unlink('./data/uploads/'.$filename);
            redirect('admin/Fakultas/importFakultas/sukses','refresh');
        }
    }

	public function hapus($id)
	{
		$hapus = $this->FakultasM->delete($id);
		if($this->db->affected_rows()){
			$this->session->set_flashdata('info','Data berhasil Dihapus.');
			redirect('admin/Fakultas');
		}else{
			$this->session->set_flashdata('info','Data gagal Dihapus.');
			redirect('admin/Fakultas');
		}
	}

	public function edit($id = null)
	{		
		$data['judulHeader'] = 'Fakultas';
		$data['menu'] = 'fakultas';
		$data['username'] = $this->session->userdata('username');
		$data['id_user'] = $this->session->userdata('id_user');
		$data['nama_role'] = $this->session->userdata('nama_role');
		$data['editdata'] = $this->db->get_where('fakultas',array('kode_fakultas'=>$id))->row();
		$this->template->display('admin/fakultas/edit',$data);
	}

	public function update()
	{
		$kode_fakultas = $this->input->post('kode_fakultas');
		$nama_fakultas = $this->input->post('nama_fakultas');

		$object = array(
			'nama_fakultas'=>$nama_fakultas
		);

		$this->db->where('kode_fakultas', $kode_fakultas);
		$this->db->update('fakultas', $object);
		if ($this->db->affected_rows()) {
			$this->session->set_flashdata('info', 'Data berhasil diubah.');
			redirect('admin/Fakultas');
		} else {
			$this->session->set_flashdata('info', 'Data gagal diubah.');
			redirect('admin/Fakultas');
		}
	}

	public function setFormFakultas(){
		$data['tr'] = '';
		$data['tr'] .= '<tr>';
		$data['tr'] .= '<td><input id="fakultas_0_kode_fakultas" class="form-control kode_fakultas" name="fakultas[0][kode_fakultas]" type="text"></td>';
		$data['tr'] .= '<td><input id="fakultas_0_nama_fakultas" name="fakultas[0][nama_fakultas]" type="text" class="form-control"></td>';
		$data['tr'] .= '<td><a href="#" class="btn btn-small btn-success" onclick="tambahFakultas();"><i class="fa fa-plus"> </i></a><a style="margin-left:10px;" href="#" class="btn btn-small btn-success" onClick="hapusFakultas(this);" ><i class="fa fa-minus"> </i></a></td>';
		$data['tr'] .= '</tr>';
		echo json_encode($data); 
		exit;
	}
}

/* End of file Fakultas.php */
/* Location: ./application/modules/admin/controllers/Fakultas.php */