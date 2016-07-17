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
		$this->load->library('form_validation');
		$this->load->library('session');        
        $this->load->helper(array('form','url'));
        $this->load->model('ADRoleM');
        $this->load->model('ADUserM');
	}

	public function index($id=NULL)
	{
		$data['username'] 		= $this->session->userdata('username');
		$data['id_user'] 		= $this->session->userdata('id_user');
		$data['nama_role'] 		= $this->session->userdata('nama_role');
		$data['judulHeader'] 	= 'Daftar User';
		$data['menu'] = 'rolePemakai';
		$data['role'] = $this->db->select('*')
						->from('role')
						->get()->result_object();

		$jml = $this->db->get('user');

		//pengaturan pagination
		 $config['base_url'] 	= base_url().'admin/rolePemakai/index';
		 $config['total_rows'] 	= $jml->num_rows();
		 $config['per_page'] 	= '10';
		 $config['first_page'] 	= 'Awal';
		 $config['last_page'] 	= 'Akhir';
		 $config['next_page'] 	= '&laquo;';
		 $config['prev_page'] 	= '&raquo;';

		//inisialisasi config
		 $this->pagination->initialize($config);

		//buat pagination
		 $data['halaman'] = $this->pagination->create_links();

		//tamplikan data
	 	$id_role = $this->input->post('id_role');
		$username = $this->input->post('username');
		if($id_role != '' || $username != ''){
			$jml = $this->db->select('*')
						->from('user')
						->where('id_role',$id_role)
						->like('username',$username)
						->get();
			//pengaturan pagination
			 $config['base_url'] 	= base_url().'admin/prodi/index';
			 $config['total_rows'] 	= $jml->num_rows();
			 $config['per_page'] 	= '10';
			 $config['first_page'] 	= 'Awal';
			 $config['last_page'] 	= 'Akhir';
			 $config['next_page'] 	= '&laquo;';
			 $config['prev_page'] 	= '&raquo;';

			//inisialisasi config
		 	$this->pagination->initialize($config);

			//buat pagination
		 	$data['halaman'] 	= $this->pagination->create_links();
			$data['data'] 		=  $this->User->tampilDataUser($config['per_page'], $id, $id_role, $username);
			$tr['tr'] 			= $this->load->view('admin/rolePemakai/pencarian',$data,true);
			echo json_encode($tr['tr']); 
			exit;
		}else{
			$nama_prodi 	= null;
			$kode_fakultas 	= null;
			$data['data'] 	= $this->User->tampilDataUser($config['per_page'], $id, $id_role, $username);
		}	

		// $data['data']	= $this->User->tampilDataPemakai()->result_object();		
		$this->template->display('admin/rolePemakai/admin',$data);
	}

	public function tambah()
	{
		$data['username'] 		= $this->session->userdata('username');
		$data['id_user'] 		= $this->session->userdata('id_user');
		$data['nama_role'] 		= $this->session->userdata('nama_role');
		$data['judulHeader'] 	= 'Daftar User';
		$data['menu'] 			= 'rolePemakai';		
		$data['role'] 			= $this->db->select('*')
								->from('role')
								->where('id_role !=',1)
								->where('id_role !=',2)
								->get()->result_object();
		$this->template->display('admin/rolePemakai/tambah',$data);
	}

	public function insert()
	{
		$username 	= $this->input->post('username');
		$password 	= $this->input->post('password');
		$role 		= $this->input->post('role');
		$data 		= array(
						'username' => $username,
						'password' => $password,
						'id_role' => $role
					);
		$insert = $this->ADUserM->insert($data);
		if ($insert) {
			$datas['message'] = 'sukses';
			redirect('admin/RolePemakai',$datas);
		} else {
			$datas['message'] = 'gagal';
			redirect('admin/RolePemakai/tambah',$datas);   
		}
	}


	public function block_aktif($id)
	{
		$aksi 	= $this->input->get('aksi');
		$status = '';

		if($aksi == 'aktif'){
			$status = true;
		}else{
			$status = false;
		}
		$object = array(
			'user_aktif'=>$status,
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
		$hapus = $this->ADUserM->delete($id);
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
		$data['judulHeader'] 	= 'Daftar User';
		$data['menu'] 			= 'rolePemakai';
		$data['username'] 		= $this->session->userdata('username');
		$data['id_user'] 		= $this->session->userdata('id_user');
		$data['nama_role'] 		= $this->session->userdata('nama_role');
		$data['editdata'] 		= $this->db->get_where('user',array('id_user'=>$id))->row();
		$data['role'] 			= $this->ADRoleM->dd_role_user();
		$data['role_selected'] 	= $this->input->post('id_role') ? $this->input->post('id_role') : ''; // untuk edit ganti '' menjadi data dari database misalnya $row->id_role
		$this->template->display('admin/rolePemakai/edit',$data);
	}

	public function update()
	{
		$id_role 		= $this->input->post('id_role');
		$username 		= $this->input->post('username');
		$username_lama 	= $this->input->post('username_lama');
		$nama_lengkap 	= $this->input->post('nama_lengkap');

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