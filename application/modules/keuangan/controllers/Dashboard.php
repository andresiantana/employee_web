<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('template');
		if ($this->session->userdata('username')=="") {
			redirect('login');
		}
		$this->load->library('form_validation');
		$this->load->helper('text');
		$this->load->helper('form');		
		$this->load->model('User');
		$this->load->model('KURoleM');
	}
	
	public function index()
	{
		$data['username'] = $this->session->userdata('username');
		$data['id_user'] = $this->session->userdata('id_user');
		$data['nama_role'] = $this->session->userdata('nama_role');
		$data['menu'] = 'beranda';
		$data['judulHeader'] = 'Beranda';
		$this->template->display('keuangan/dashboard', $data);
	}

	public function editProfile($id = null)
	{		
		$data['judulHeader'] = 'Daftar User';
		$data['menu'] = 'dashboard';
		$data['username'] = $this->session->userdata('username');
		$data['id_user'] = $this->session->userdata('id_user');
		$data['nama_role'] = $this->session->userdata('nama_role');
		$data['editdata'] = $this->db->get_where('user',array('username'=>$id))->row();
		$data['role'] = $this->KURoleM->dd_role_user();
		$data['role_selected'] = $this->input->post('id_role') ? $this->input->post('id_role') : ''; // untuk edit ganti '' menjadi data dari database misalnya $row->id_role
		$this->template->display('keuangan/edit_profile',$data);
	}

	public function updateProfile(){
		$id_user = $this->input->post('id_user');
		$nama_user = $this->input->post('username');
		$nama_lengkap = $this->input->post('nama_lengkap');
		$no_telp = $this->input->post('no_telp');
		$id_role = $this->input->post('id_role');
		$alamat = $this->input->post('alamat');
		$password = $this->input->post('password');

		if(empty($password)){
			$password = $this->input->post('password_lama');
		}
		$object = array(
			'username'=>$nama_user,
			'password'=>$password,
			'nama_lengkap'=>$nama_lengkap,
			'no_telp'=>$no_telp,			
			'alamat'=>$alamat,
			'id_role'=>$id_role
		);

		$this->db->where('id_user', $id_user);
		$this->db->update('user', $object);
		if($this->db->affected_rows()){
			echo "<script>alert('Data Profile berhasil diubah!');
                    window.location.href='".base_url('keuangan/dashboard')."';
                </script>";
		}else{
			echo "<script>alert('Data Profile gagal diubah!');
                    window.location.href='".base_url('keuangan/dashboard')."';
                </script>";
		}
	}

	public function logout() {
		$this->session->unset_userdata('username');
		$this->session->unset_userdata('id_user');
		$this->session->unset_userdata('nama_role');
		session_destroy();
		redirect('keuangan/Login');
	}

}

/* End of file Dashboard.php */
/* Location: ./application/controllers/admin/Dashboard.php */