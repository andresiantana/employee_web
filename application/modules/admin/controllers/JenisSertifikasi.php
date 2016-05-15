<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class JenisSertifikasi extends CI_Controller {

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
        $this->load->model('JenisSertifikasiM');
	}

	public function index()
	{
		$data['username'] = $this->session->userdata('username');
		$data['id_user'] = $this->session->userdata('id_user');
		$data['nama_role'] = $this->session->userdata('nama_role');
		$data['judulHeader'] = 'Jenis Sertifikasi';
		$data['menu'] = 'jenisSertifikasi';
		$data['data']	= $this->JenisSertifikasiM->tampilData()->result_object();		
		$this->template->display('admin/jenisSertifikasi/admin',$data);
	}

	public function tambah()
	{
		$data['username'] = $this->session->userdata('username');
		$data['id_user'] = $this->session->userdata('id_user');
		$data['nama_role'] = $this->session->userdata('nama_role');
		$data['judulHeader'] = 'Jenis Sertifikasi';
		$data['menu'] = 'jenisSertifikasi';		
		$this->template->display('admin/jenisSertifikasi/tambah',$data);
	}

	public function insert()
	{
		$nama_jenis_sertifikasi = $this->input->post('nama_jenis_sertifikasi');
		$status = true;
		$data = array(
					'nama_jenis_sertifikasi' => $nama_jenis_sertifikasi,
					'status' => $status
				);
		$insert = $this->JenisSertifikasiM->insert($data);
		if ($insert) {
			$this->session->set_flashdata('success','Data berhasil disimpan!');
			redirect('admin/JenisSertifikasi');
		} else {
			$this->session->set_flashdata('error','Data gagal disimpan!');
			redirect('admin/JenisSertifikasi/tambah');   
		}
	}


	public function block_aktif($id)
	{
		$aksi = $this->input->get('aksi');
		$status = '';

		if($aksi == 'aktif'){
			$status = true;
		}else{
			$status = false;
		}
		$object = array(
			'status'=>$status,
		);

		$this->db->where('id_jenis_sertifikasi', $id);
		$this->db->update('jenis_sertifikasi', $object);

		if($this->db->affected_rows()){
			$this->session->set_flashdata('info','Data berhasil Diblokir.');
			redirect('admin/JenisSertifikasi');
		}else{
			$this->session->set_flashdata('info','Data gagal Diblokir.');
			redirect('admin/JenisSertifikasi');
		}
	}

	public function hapus($id)
	{
		$hapus = $this->JenisSertifikasiM->delete($id);
		if($this->db->affected_rows()){
			$this->session->set_flashdata('info','Data berhasil Dihapus.');
			redirect('admin/jenisSertifikasi');
		}else{
			$this->session->set_flashdata('info','Data gagal Dihapus.');
			redirect('admin/jenisSertifikasi');
		}
	}

	public function edit($id = null)
	{		
		$data['judulHeader'] = 'Jenis Sertifikasi';
		$data['menu'] = 'jenisSertifikasi';
		$data['username'] = $this->session->userdata('username');
		$data['id_user'] = $this->session->userdata('id_user');
		$data['nama_role'] = $this->session->userdata('nama_role');
		$data['editdata'] = $this->db->get_where('jenis_sertifikasi',array('id_jenis_sertifikasi'=>$id))->row();
		$this->template->display('admin/jenisSertifikasi/edit',$data);
	}

	public function update()
	{
		$id_jenis_sertifikasi = $this->input->post('id_jenis_sertifikasi');
		$nama_jenis_sertifikasi = $this->input->post('nama_jenis_sertifikasi');

		$object = array(
			'nama_jenis_sertifikasi'=>$nama_jenis_sertifikasi
		);

		$this->db->where('id_jenis_sertifikasi', $id_jenis_sertifikasi);
		$this->db->update('jenis_sertifikasi', $object);
		if ($this->db->affected_rows()) {
			$this->session->set_flashdata('info', 'Data User Pemakai berhasil diedit.');
			redirect('admin/JenisSertifikasi');
		} else {
			$this->session->set_flashdata('info', 'Data User Pemakai gagal diedit.');
			redirect('admin/JenisSertifikasi');
		}
	}
}

/* End of file JenisSertifikasi.php */
/* Location: ./application/modules/admin/controllers/JenisSertifikasi.php */