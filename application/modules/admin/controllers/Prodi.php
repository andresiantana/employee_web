<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Prodi extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('username')=="") {
			redirect('login');
		}
		$this->load->library('template');	
		$this->load->helper(array('form','url'));			
		$this->load->library('form_validation');
		$this->load->library('session');      
        $this->load->model('ProdiM');
	}

	public function index()
	{
		$data['username'] 		= $this->session->userdata('username');
		$data['id_user'] 		= $this->session->userdata('id_user');
		$data['nama_role'] 		= $this->session->userdata('nama_role');
		$data['judulHeader'] 	= 'Prodi';
		$data['menu'] 	= 'prodi';
		$data['data']	= $this->ProdiM->tampilData()->result_object();		
		$data['fakultas'] = $this->db->select('*')
						->from('fakultas')
						->get()->result_object();
		$this->template->display('admin/prodi/admin',$data);
	}

	public function tambah()
	{
		$data['username'] 	= $this->session->userdata('username');
		$data['id_user'] 	= $this->session->userdata('id_user');
		$data['nama_role'] 	= $this->session->userdata('nama_role');
		$data['judulHeader'] = 'Prodi';
		$data['menu'] = 'prodi';	
		$data['fakultas'] = $this->db->select('*')
						->from('fakultas')
						->get()->result_object();	
		$this->template->display('admin/prodi/tambah',$data);
	}

	public function insert()
	{
		$status = '';

		foreach ($this->input->post('prodi') as $i => $data) {	
			$id_fakultas = $this->input->post('id_fakultas');
			$kode_prodi = $data['kode_prodi'];
			$nama_prodi = $data['nama_prodi'];
			$status_prodi 	= true;

			$object = array(
				'id_fakultas'=>$id_fakultas,
				'kode_prodi'=>$kode_prodi,
				'nama_prodi'=>$nama_prodi,
				'status_prodi'=>$status_prodi
			);

			$insert = $this->ProdiM->insert($object);
			
			if($insert){
				$status = 'berhasil';
			}
		}

		if($status == 'berhasil'){
			echo "<script>alert('Data berhasil disimpan!');
                    window.location.href='".base_url('admin/Prodi/index')."';
                </script>";
		}else{
			echo "<script>alert('Data gagal disimpan!');
                    window.location.href='".base_url('admin/Prodi/tambah')."';
                </script>";
		}
	}

	public function hapus($id)
	{
		$hapus = $this->ProdiM->delete($id);
		if($this->db->affected_rows()){
			$this->session->set_flashdata('info','Data berhasil Dihapus.');
			redirect('admin/Prodi');
		}else{
			$this->session->set_flashdata('info','Data gagal Dihapus.');
			redirect('admin/Prodi');
		}
	}

	public function edit($id = null)
	{		
		$data['judulHeader'] = 'Prodi';
		$data['menu'] = 'prodi';
		$data['username'] = $this->session->userdata('username');
		$data['id_user'] = $this->session->userdata('id_user');
		$data['nama_role'] = $this->session->userdata('nama_role');
		$data['fakultas'] = $this->db->select('*')
						->from('fakultas')
						->get()->result_object();
		$data['editdata'] = $this->db->get_where('prodi',array('id_prodi'=>$id))->row();
		$this->template->display('admin/prodi/edit',$data);
	}

	public function update()
	{
		$id_prodi = $this->input->post('id_prodi');
		$id_fakultas = $this->input->post('id_fakultas');
		$kode_prodi = $this->input->post('kode_prodi');
		$nama_prodi = $this->input->post('nama_prodi');

		$object = array(
			'id_fakultas'=>$id_fakultas,
			'kode_prodi'=>$kode_prodi,
			'nama_prodi'=>$nama_prodi
		);

		$this->db->where('id_prodi', $id_prodi);
		$this->db->update('prodi', $object);
		if ($this->db->affected_rows()) {
			$this->session->set_flashdata('info', 'Data berhasil diubah.');
			redirect('admin/Prodi');
		} else {
			$this->session->set_flashdata('info', 'Data gagal diubah.');
			redirect('admin/Prodi');
		}
	}

	public function setFormProdi(){
		$data['tr'] = '';
		$data['tr'] .= '<tr>';
		$data['tr'] .= '<td><input id="prodi_0_kode_prodi" class="form-control kode_prodi" name="prodi[0][kode_prodi]" type="text"></td>';
		$data['tr'] .= '<td><input id="prodi_0_nama_prodi" name="prodi[0][nama_prodi]" type="text" class="form-control"></td>';
		$data['tr'] .= '<td><a href="#" class="btn btn-small btn-success" onclick="tambahProdi();"><i class="fa fa-plus"> </i></a><a style="margin-left:10px;" href="#" class="btn btn-small btn-success" onClick="hapusProdi(this);" ><i class="fa fa-minus"> </i></a></td>';
		$data['tr'] .= '</tr>';
		echo json_encode($data); 
		exit;
	}
}

/* End of file Prodi.php */
/* Location: ./application/modules/admin/controllers/Prodi.php */