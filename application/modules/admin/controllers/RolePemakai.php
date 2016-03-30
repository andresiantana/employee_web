<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RolePemakai extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('username')=="") {
			redirect('login');
		}
		$this->load->library('template');				
		$this->load->library('session');
        $this->load->library('form_validation');
        $this->load->helper(array('form','url'));
        $this->load->model('RoleM');
        $this->load->model('User');
	}

	public function index()
	{
		$data['username'] = $this->session->userdata('username');
		$data['nama_role'] = $this->session->userdata('nama_role');
		$data['judulHeader'] = 'Daftar User';
		$data['menu'] = 'rolePemakai';
		$data['data']	= $this->User->tampilDataPemakai()->result_object();		
		$this->template->display('admin/rolePemakai/admin',$data);
	}

	public function tambah()
	{
		$data['username'] = $this->session->userdata('username');
		$data['nama_role'] = $this->session->userdata('nama_role');
		$data['judulHeader'] = 'Daftar User';
		$data['menu'] = 'rolePemakai';		
		$data['role'] = $this->db->select('*')
						->from('role')
						->where('id_role !=',1)
						->get()->result_object();
		$this->template->display('admin/rolePemakai/tambah',$data);
	}

	public function insert()
	{
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$role = $this->input->post('role');
		$data = array(
					'username' => $username,
					'password' => $password,
					'id_role' => $role
				);
		$insert = $this->User->insert($data);
		if ($insert) {
			$this->session->set_flashdata('success','Data berhasil disimpan!');
			redirect('admin/RolePemakai');
		} else {
			$this->session->set_flashdata('error','Data gagal disimpan!');
			redirect('admin/RolePemakai/tambah');   
		}
	}


	public function block($id)
	{
		$object = array(
			'user_aktif'=>FALSE,
		);

		$this->db->where('id_user', $id);
		$this->db->update('user', $object);

		if($this->db->affected_rows()){
			$this->session->set_flashdata('info','Data berhasil Diblokir.');
			redirect('admin/rolePemakai');
		}else{
			$this->session->set_flashdata('info','Data gagal Diblokir.');
			redirect('admin/rolePemakai');
		}
	}

	public function hapus($id)
	{
		$hapus = $this->User->delete($id);
		if($this->db->affected_rows()){
			$this->session->set_flashdata('info','Data berhasil Dihapus.');
			redirect('admin/rolePemakai');
		}else{
			$this->session->set_flashdata('info','Data gagal Dihapus.');
			redirect('admin/rolePemakai');
		}
	}

	public function edit($id = null)
	{		
		$data['judulHeader'] = 'Daftar User';
		$data['menu'] = 'rolePemakai';
		$data['username'] = $this->session->userdata('username');
		$data['nama_role'] = $this->session->userdata('nama_role');
		$data['editdata'] = $this->db->get_where('user',array('id_user'=>$id))->row();
		$data['role'] = $this->RoleM->dd_role_user();
		$data['role_selected'] = $this->input->post('id_role') ? $this->input->post('id_role') : ''; // untuk edit ganti '' menjadi data dari database misalnya $row->id_role
		$this->template->display('admin/rolePemakai/edit',$data);
	}

	public function update()
	{
		$id_role = $this->input->post('id_role');
		$username = $this->input->post('username');
		$username_lama = $this->input->post('username_lama');
		$nama_lengkap = $this->input->post('nama_lengkap');

		$object = array(
			'id_role'=>$id_role,
			'username'=>$username,
			'nama_lengkap'=>$nama_lengkap
		);

		$this->db->where('username', $username_lama);
		$this->db->update('user', $object);
		if ($this->db->affected_rows()) {
			$this->session->set_flashdata('info', 'Data User Pemakai berhasil diedit.');
			redirect('admin/rolePemakai');
		} else {
			$this->session->set_flashdata('info', 'Data User Pemakai gagal diedit.');
			redirect('admin/rolePemakai');
		}
	}
}

/* End of file RolePemakai.php */
/* Location: ./application/modules/admin/controllers/RolePemakai.php */