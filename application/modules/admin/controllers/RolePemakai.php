<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RolePemakai extends CI_Controller {

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
        $this->load->model('RoleM');
        $this->load->model('User');
		//Do your magic here
	}
	public function index()
	{
		$data['judul'] = 'Employee Web';
		$data['menu'] = 'master';
		$data['data']	= $this->User->tampilDataPemakai()->result_object();
		$data['username'] = $this->session->userdata('username');
		$this->template->display('admin/rolePemakai/admin',$data);
	}

	public function hapus($id){
		$hapus = $this->User->delete($id);
		if($this->db->affected_rows()){
			$this->session->set_flashdata('info','Data berhasil Dihapus.');
				redirect('admin/rolePemakai');
		}else{
			$this->session->set_flashdata('info','Data gagal Dihapus.');
			redirect('admin/rolePemakai');
		}
	}

	public function edit($id = null){		
		$data['judul'] = 'Employee Web';
		$data['menu'] = 'master';
		$data['username'] = $this->session->userdata('username');
		$data['editdata'] = $this->db->get_where('user',array('username'=>$id))->row();
		$data['role'] = $this->RoleM->dd_role();
		$data['role_selected'] = $this->input->post('id_role') ? $this->input->post('id_role') : ''; // untuk edit ganti '' menjadi data dari database misalnya $row->id_role
		$this->template->display('admin/rolePemakai/edit',$data);
	}

	public function update(){
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
		if($this->db->affected_rows()){
			$this->session->set_flashdata('info', 'Data User Pemakai berhasil diedit.');
			redirect('admin/rolePemakai');
		}else{
			$this->session->set_flashdata('info', 'Data User Pemakai gagal diedit.');
			redirect('admin/rolePemakai');
		}
	}
}

/* End of file RolePemakai.php */
/* Location: ./application/modules/admin/controllers/RolePemakai.php */