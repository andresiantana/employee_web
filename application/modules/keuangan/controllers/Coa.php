<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Coa extends CI_Controller {

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
        $this->load->model('CoaM');
	}

	public function index($id = NULL)
	{
		$data['username'] = $this->session->userdata('username');
		$data['id_user'] = $this->session->userdata('id_user');
		$data['nama_role'] = $this->session->userdata('nama_role');
		$data['judulHeader'] = 'Coa';
		$data['menu'] = 'coa';

		$jml = $this->db->get('coa');

		//pengaturan pagination
		 $config['base_url'] = base_url().'keuangan/coa/index';
		 $config['total_rows'] = $jml->num_rows();
		 $config['per_page'] = '10';
		 $config['first_page'] = 'Awal';
		 $config['last_page'] = 'Akhir';
		 $config['next_page'] = '&laquo;';
		 $config['prev_page'] = '&raquo;';

		//inisialisasi config
		 $this->pagination->initialize($config);

		//buat pagination
		 $data['halaman'] = $this->pagination->create_links();

		//tamplikan data
	 	$nama_akun = $this->input->post('nama_akun');
		if($nama_akun != ''){
			$jml = $this->db->select('*')
						->from('coa')
						->like('nama_akun',$nama_akun)
						->get();
			//pengaturan pagination
			 $config['base_url'] = base_url().'keuangan/coa/index';
			 $config['total_rows'] = $jml->num_rows();
			 $config['per_page'] = '10';
			 $config['first_page'] = 'Awal';
			 $config['last_page'] = 'Akhir';
			 $config['next_page'] = '&laquo;';
			 $config['prev_page'] = '&raquo;';

			//inisialisasi config
		 	$this->pagination->initialize($config);

			//buat pagination
		 	$data['halaman'] = $this->pagination->create_links();
			$data['data'] =  $this->CoaM->tampilDataAkun($config['per_page'], $id, $nama_akun);
			$tr['tr'] = $this->load->view('keuangan/coa/pencarian',$data,true);
			echo json_encode($tr['tr']); 
			exit;
		}else{
			$nama_akun = '';
			$data['data'] = $this->CoaM->tampilDataAkun($config['per_page'], $id, $nama_akun);
		}

		// $data['data']	= $this->CoaM->tampilData()->result_object();		
		$this->template->display('keuangan/coa/admin',$data);
	}

	public function tambah()
	{
		$data['username'] = $this->session->userdata('username');
		$data['id_user'] = $this->session->userdata('id_user');
		$data['nama_role'] = $this->session->userdata('nama_role');
		$data['judulHeader'] = 'Coa';
		$data['menu'] = 'coa';		
		$this->template->display('keuangan/coa/tambah',$data);
	}

	public function insert()
	{
		$no_akun = $this->input->post('no_akun');
		$nama_akun = $this->input->post('nama_akun');
		$data = array(
					'no_akun' => $no_akun,
					'nama_akun' => $nama_akun
				);
		$insert = $this->CoaM->insert($data);
		if ($insert) {
			$this->session->set_flashdata('success','Data berhasil disimpan!');
			redirect('keuangan/Coa');
		} else {
			$this->session->set_flashdata('error','Data gagal disimpan!');
			redirect('keuangan/Coa/tambah');   
		}
	}

	public function hapus($id)
	{
		$hapus = $this->CoaM->delete($id);
		if($this->db->affected_rows()){
			$this->session->set_flashdata('info','Data berhasil Dihapus.');
			redirect('keuangan/Coa');
		}else{
			$this->session->set_flashdata('info','Data gagal Dihapus.');
			redirect('keuangan/Coa');
		}
	}

	public function edit($id = null)
	{		
		$data['judulHeader'] = 'Coa';
		$data['menu'] = 'coa';
		$data['username'] = $this->session->userdata('username');
		$data['id_user'] = $this->session->userdata('id_user');
		$data['nama_role'] = $this->session->userdata('nama_role');
		$data['editdata'] = $this->db->get_where('coa',array('no_akun'=>$id))->row();		
		$this->template->display('keuangan/coa/edit',$data);
	}

	public function update()
	{
		$no_akun = $this->input->post('no_akun');
		$nama_akun = $this->input->post('nama_akun');

		$data = array(
			'nama_akun'=>$nama_akun
		);

		$this->db->where('no_akun', $no_akun);
		$this->db->update('coa', $data);
		if ($this->db->affected_rows()) {
			$this->session->set_flashdata('info', 'Data User Pemakai berhasil diedit.');
			redirect('keuangan/Coa');
		} else {
			$this->session->set_flashdata('info', 'Data User Pemakai gagal diedit.');
			redirect('keuangan/Coa');
		}
	}

}

/* End of file Coa.php */
/* Location: ./application/modules/keuangan/controllers/Coa.php */