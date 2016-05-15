<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CabangBank extends CI_Controller {

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
        $this->load->model('CabangBankM');
	}

	public function index()
	{
		$data['judulHeader'] = 'Cabang Bank';
		$data['menu'] = 'cabangBank';
		$data['data']	= $this->CabangBankM->tampilData()->result_object();
		$data['username'] = $this->session->userdata('username');
		$data['id_user'] = $this->session->userdata('id_user');
		$data['nama_role'] = $this->session->userdata('nama_role');
		$this->template->display('keuangan/cabangBank/admin',$data);
	}

	public function tambah()
	{
		$data['judulHeader'] = 'Cabang Bank';
		$data['menu'] = 'cabangBank';
		$data['username'] = $this->session->userdata('username');
		$data['id_user'] = $this->session->userdata('id_user');
		$data['nama_role'] = $this->session->userdata('nama_role');
		$this->template->display('keuangan/cabangBank/tambah',$data);
		
	}

	public function insert()
	{
		$this->form_validation->set_rules('nama_cabang', 'Nama Cabang', 'required');

		if ($this->form_validation->run() == FALSE) {
			$data['judulHeader'] = 'Cabang Bank';
			$data['menu'] = 'cabangBank';
			$data['username'] = $this->session->userdata('username');
			$data['id_user'] = $this->session->userdata('id_user');
			$data['nama_role'] = $this->session->userdata('nama_role');
			$this->template->display('keuangan/cabangBank/tambah',$data);
		} else {			
			$nama_cabang = $this->input->post('nama_cabang');

			$cek_data = $this->CabangBankM->cekNama($nama_cabang)->num_rows();
			if($cek_data > 0){
				echo "<script>alert('Cabang ".$nama_cabang." sudah ada pada database sebelumnya !');
                    window.location.href='".base_url('keuangan/cabangBank/tambah')."';
                </script>";
			}else{
				$object = array(
					'id_cabang_bank'=>'',
					'nama_cabang'=>$nama_cabang
				);

				$insert = $this->CabangBankM->insert($object);
				if($insert){
					echo "<script>alert('Data berhasil disimpan!');
	                    window.location.href='".base_url('keuangan/CabangBank')."';
	                </script>";
				}
			}				
		}
	}

	public function hapus($id)
	{
		$hapus = $this->CabangBankM->delete($id);
		if ($this->db->affected_rows()) {
			$this->session->set_flashdata('info','Data berhasil Dihapus.');
				redirect('keuangan/cabangBank');
		} else {
			$this->session->set_flashdata('info','Data gagal Dihapus.');
			redirect('keuangan/cabangBank');
		}
	}

	public function edit($id = null)
	{		
		$data['judulHeader'] = 'Cabang Bank';
		$data['menu'] = 'cabangBank';
		$data['username'] = $this->session->userdata('username');
		$data['id_user'] = $this->session->userdata('id_user');
		$data['nama_role'] = $this->session->userdata('nama_role');
		$data['editdata'] = $this->db->get_where('cabang_bank',array('id_cabang_bank'=>$id))->row();
		$this->template->display('keuangan/cabangBank/edit',$data);
	}

	public function update()
	{
		$id_cabang_bank = $this->input->post('id_cabang_bank');
		$nama_cabang = $this->input->post('nama_cabang');

		$object = array(
			'nama_cabang'=>$nama_cabang
		);

		$this->db->where('id_cabang_bank', $id_cabang_bank);
		$this->db->update('cabang_bank', $object);
		if($this->db->affected_rows()){
			$this->session->set_flashdata('info', 'Data berhasil diedit.');
			redirect('keuangan/CabangBank');
		}else{
			$this->session->set_flashdata('info', 'Data gagal diedit.');
			redirect('keuangan/CabangBank');
		}
	}
}

/* End of file CabangBank.php */
/* Location: ./application/modules/keuangan/controllers/CabangBank.php */