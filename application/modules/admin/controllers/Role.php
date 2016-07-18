<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Role extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('template');
		if ($this->session->userdata('username')=="") {
			redirect('login');
		}
		$this->load->library('template');
		$this->load->helper(array('form','url'));		
		$this->load->library('session');
        $this->load->library('form_validation');
        $this->load->model('ADRoleM');
	}

	public function index()
	{
		$data['judulHeader'] 	= 'Role';
		$data['menu'] 			= 'master';
		$data['data']			= $this->ADRoleM->tampilData()->result_object();
		$data['username'] 		= $this->session->userdata('username');
		$data['id_user'] 		= $this->session->userdata('id_user');
		$data['nama_role'] 		= $this->session->userdata('nama_role');
		$this->template->display('admin/role/admin',$data);
	}

	public function tambah()
	{
		$data['judulHeader'] 	= 'Role';
		$data['menu'] 			= 'master';
		$data['username'] 		= $this->session->userdata('username');
		$data['id_user'] 		= $this->session->userdata('id_user');
		$data['nama_role'] 		= $this->session->userdata('nama_role');
		$this->template->display('admin/role/tambah',$data);
		
	}

	public function insert()
	{
		$this->form_validation->set_rules('nama_role', 'Nama Role', 'required');

		if ($this->form_validation->run() == FALSE) {
			$data['judulHeader'] 	= 'Role';
			$data['menu'] 			= 'master';
			$data['username'] 		= $this->session->userdata('username');
			$data['id_user'] 		= $this->session->userdata('id_user');
			$data['nama_role'] 		= $this->session->userdata('nama_role');

			$this->template->display('admin/role/tambah',$data);
		} else {			
			$nama_role 	= $this->input->post('nama_role');

			$cek_data 	= $this->ADRoleM->cekNama($nama_role)->num_rows();
			if($cek_data > 0){
				echo "<script>alert('Nama Role ".$nama_role." sudah ada pada database sebelumnya !');
                    window.location.href='".base_url('admin/role/tambah')."';
                </script>";
			}else{
				$object = array(
					'id_role'=>'',
					'nama_role'=>$nama_role
				);

				$insert = $this->ADRoleM->insert($object);
				if($insert){
					echo "<script>alert('Data Role berhasil disimpan!');
	                    window.location.href='".base_url('admin/role')."';
	                </script>";
				}
			}				
		}
	}

	public function hapus($id)
	{
		$hapus = $this->ADRoleM->delete($id);
		if ($this->db->affected_rows()) {
			$this->session->set_flashdata('info','Data berhasil Dihapus.');
				redirect('admin/role');
		} else {
			$this->session->set_flashdata('info','Data gaa Dihapus.');
			redirect('admin/role');
		}
	}

	public function edit($id = null)
	{		
		$data['judulHeader'] 	= 'Role';
		$data['menu'] 			= 'master';
		$data['username'] 		= $this->session->userdata('username');
		$data['id_user'] 		= $this->session->userdata('id_user');
		$data['nama_role'] 		= $this->session->userdata('nama_role');
		$data['editdata'] 		= $this->db->get_where('role',array('id_role'=>$id))->row();
		$this->template->display('admin/role/edit',$data);
	}

	public function update()
	{
		$id_role 	= $this->input->post('id_role');
		$nama_role 	= $this->input->post('nama_role');

		$object = array(
			'nama_role'=>$nama_role
		);

		$this->db->where('id_role', $id_role);
		$this->db->update('role', $object);
		if($this->db->affected_rows()){
			$this->session->set_flashdata('info', 'Data Role berhasil diedit.');
			redirect('admin/role');
		}else{
			$this->session->set_flashdata('info', 'Data Role gagal diedit.');
			redirect('admin/role');
		}
	}
}

/* End of file Role.php */
/* Location: ./application/modules/admin/controllers/Role.php */