<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class KategoriBiaya extends CI_Controller {

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
        $this->load->model('KategoriBiayaM');
	}

	public function index($id = NULL)
	{
		$data['judulHeader'] = 'Kategori Biaya';
		$data['menu'] = 'kategoriBiaya';
		// $data['data']	= $this->KategoriBiayaM->tampilData()->result_object();
		$data['username'] = $this->session->userdata('username');
		$data['id_user'] = $this->session->userdata('id_user');
		$data['nama_role'] = $this->session->userdata('nama_role');

		$jml = $this->db->get('kategori_biaya');

		//pengaturan pagination
		 $config['base_url'] = base_url().'keuangan/kategoriBiaya/index';
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
	 	$nama_kategori = $this->input->post('nama_kategori');
		if($nama_kategori != ''){
			$jml = $this->db->select('*')
						->from('kategori_biaya')
						->like('nama_kategori',$nama_kategori)
						->get();
			//pengaturan pagination
			 $config['base_url'] = base_url().'keuangan/kategoriBiaya/index';
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
			$data['data'] =  $this->KategoriBiayaM->tampilDataKategori($config['per_page'], $id, $nama_kategori);
			$tr['tr'] = $this->load->view('keuangan/kategoriBiaya/pencarian',$data,true);
			echo json_encode($tr['tr']); 
			exit;
		}else{
			$nama_akun = '';
			$data['data'] = $this->KategoriBiayaM->tampilDataKategori($config['per_page'], $id, $nama_kategori);
		}

		$this->template->display('keuangan/kategoriBiaya/admin',$data);
	}

	public function tambah()
	{
		$data['judulHeader'] = 'Kategori Biaya';
		$data['menu'] = 'kategoriBiaya';
		$data['username'] = $this->session->userdata('username');
		$data['id_user'] = $this->session->userdata('id_user');
		$data['nama_role'] = $this->session->userdata('nama_role');
		$this->template->display('keuangan/kategoriBiaya/tambah',$data);
		
	}

	public function insert()
	{
		$this->form_validation->set_rules('nama_kategori', 'Nama Kategori', 'required');

		if ($this->form_validation->run() == FALSE) {
			$data['judulHeader'] = 'Kategori Biaya';
			$data['menu'] = 'kategoriBiaya';
			$data['username'] = $this->session->userdata('username');
			$data['id_user'] = $this->session->userdata('id_user');
			$data['nama_role'] = $this->session->userdata('nama_role');
			$this->template->display('keuangan/kategoriBiaya/tambah',$data);
		} else {			
			$nama_kategori = $this->input->post('nama_kategori');

			$cek_data = $this->KategoriBiayaM->cekNama($nama_kategori)->num_rows();
			if($cek_data > 0){
				echo "<script>alert('Nama Kategori ".$nama_kategori." sudah ada pada database sebelumnya !');
                    window.location.href='".base_url('keuangan/kategoriBiaya/tambah')."';
                </script>";
			}else{
				$object = array(
					'id_kategori_biaya'=>'',
					'nama_kategori'=>$nama_kategori
				);

				$insert = $this->KategoriBiayaM->insert($object);
				if($insert){
					echo "<script>alert('Data berhasil disimpan!');
	                    window.location.href='".base_url('keuangan/kategoriBiaya')."';
	                </script>";
				}
			}				
		}
	}

	public function hapus($id)
	{
		$hapus = $this->KategoriBiayaM->delete($id);
		if ($this->db->affected_rows()) {
			$this->session->set_flashdata('info','Data berhasil Dihapus.');
				redirect('keuangan/kategoriBiaya');
		} else {
			$this->session->set_flashdata('info','Data gaa Dihapus.');
			redirect('keuangan/kategoriBiaya');
		}
	}

	public function edit($id = null)
	{		
		$data['judulHeader'] = 'Kategori Biaya';
		$data['menu'] = 'kategoriBiaya';
		$data['username'] = $this->session->userdata('username');
		$data['id_user'] = $this->session->userdata('id_user');
		$data['nama_role'] = $this->session->userdata('nama_role');
		$data['editdata'] = $this->db->get_where('kategori_biaya',array('id_kategori_biaya'=>$id))->row();
		$this->template->display('keuangan/kategoriBiaya/edit',$data);
	}

	public function update()
	{
		$id_kategori_biaya = $this->input->post('id_kategori_biaya');
		$nama_kategori = $this->input->post('nama_kategori');

		$object = array(
			'nama_kategori'=>$nama_kategori
		);

		$this->db->where('id_kategori_biaya', $id_kategori_biaya);
		$this->db->update('kategori_biaya', $object);
		if($this->db->affected_rows()){
			$this->session->set_flashdata('info', 'Data berhasil diedit.');
			redirect('keuangan/kategoriBiaya');
		}else{
			$this->session->set_flashdata('info', 'Data gagal diedit.');
			redirect('keuangan/kategoriBiaya');
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
			'kategori_aktif'=>$status,
		);

		$this->db->where('id_kategori_biaya', $id);
		$this->db->update('kategori_biaya', $object);

		if($this->db->affected_rows()){
			$this->session->set_flashdata('info','Data berhasil Diblokir.');
			redirect('keuangan/KategoriBiaya');
		}else{
			$this->session->set_flashdata('info','Data gagal Diblokir.');
			redirect('keuangan/KategoriBiaya');
		}
	}
}

/* End of file KategoriBiaya.php */
/* Location: ./application/modules/admin/controllers/KategoriBiaya.php */