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
		$this->load->library("PHPExcel");	
		$this->load->helper(array('url','html','form','download'));			
		$this->load->library('form_validation');
		$this->load->library('session');      
        $this->load->model('ProdiM');
	}

	public function index($id=NULL)
	{
		$data['username'] 		= $this->session->userdata('username');
		$data['id_user'] 		= $this->session->userdata('id_user');
		$data['nama_role'] 		= $this->session->userdata('nama_role');
		$data['judulHeader'] 	= 'Prodi';
		$data['menu'] 			= 'prodi';
		// $data['data']	= $this->ProdiM->tampilData()->result_object();		
		$data['fakultas'] 		= $this->db->select('*')
								->from('fakultas')
								->get()->result_object();

		$jml = $this->db->get('prodi');
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
		 $data['halaman'] = $this->pagination->create_links();

		//tamplikan data
	 	$kode_fakultas = $this->input->post('kode_fakultas');
		$nama_prodi = $this->input->post('nama_prodi');
		if($kode_fakultas != '' || $nama_prodi != ''){
			$jml = $this->db->select('*')
						->from('prodi')
						->where('prodi.kode_fakultas',$kode_fakultas)
						->like('prodi.nama_prodi',$nama_prodi)
						->join('fakultas', 'fakultas.kode_fakultas = prodi.kode_fakultas','Left')
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
			$data['data'] 		=  $this->ProdiM->tampilDataProdi($config['per_page'], $id, $kode_fakultas, $nama_prodi);
			$tr['tr'] 			= $this->load->view('admin/prodi/pencarian',$data,true);
			echo json_encode($tr['tr']); 
			exit;
		}else{
			$nama_prodi 	= null;
			$kode_fakultas 	= null;
			$data['data'] 	= $this->ProdiM->tampilDataProdi($config['per_page'], $id, $kode_fakultas, $nama_prodi);
		}		 
		
		$this->template->display('admin/prodi/admin',$data);
	}

	public function tambah()
	{
		$data['username'] 		= $this->session->userdata('username');
		$data['id_user'] 		= $this->session->userdata('id_user');
		$data['nama_role'] 		= $this->session->userdata('nama_role');
		$data['judulHeader'] 	= 'Prodi';
		$data['menu'] 			= 'prodi';	
		$data['fakultas'] 		= $this->db->select('*')
								->from('fakultas')
								->get()->result_object();	
		$this->template->display('admin/prodi/tambah',$data);
	}

	public function insert()
	{
		$status = '';

		foreach ($this->input->post('prodi') as $i => $data) {	
			$kode_fakultas 	= $this->input->post('kode_fakultas');
			$kode_prodi 	= $data['kode_prodi'];
			$nama_prodi 	= $data['nama_prodi'];
			$status_aktif 	= true;

			$object = array(
				'kode_fakultas'=>$kode_fakultas,
				'kode_prodi'=>$kode_prodi,
				'nama_prodi'=>$nama_prodi,
				'status_aktif'=>$status_aktif
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

	public function importProdi($sukses = "")
	{
		$data['username'] 	= $this->session->userdata('username');
		$data['id_user'] 	= $this->session->userdata('id_user');
		$data['nama_role'] 	= $this->session->userdata('nama_role');
		$data['judulHeader'] = 'Prodi';
		$data['menu'] = 'prodi';		
		$this->template->display('admin/prodi/import',$data);
	}

	public function do_upload(){
     	$config['upload_path'] 		= './data/uploads/';
        $config['allowed_types'] 	= 'xlsx|csv|xls';
	    $config['max_size'] 		= '10000'; 
	    $config['overwrite'] 		= true;
	    $config['encrypt_name'] 	= FALSE;
	    $config['remove_spaces'] 	= TRUE;
        
        $this->load->library('upload', $config);
        
        if (!$this->upload->do_upload('file')){
            $error = array('error' => $this->upload->display_errors());
            echo "<script>alert('Data Gagal diupload. File harus .xls/.xlsx/.csv!');
                    window.location.href='".base_url('admin/Prodi/index')."';
                </script>";
        }
        else{
        	if(isset($_POST['drop']) && $_POST['drop'] == 1){
        		$this->db->empty_table('prodi');
        	}
            $data 			= array('upload_data' => $this->upload->data());
            $upload_data 	= $this->upload->data(); //Mengambil detail data yang di upload
            $filename 		= $upload_data['file_name'];//Nama File

            $this->ProdiM->upload_data($filename);
            unlink('./data/uploads/'.$filename);
            redirect('admin/Prodi/importProdi/sukses','refresh');
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
		$data['judulHeader'] 	= 'Prodi';
		$data['menu'] 			= 'prodi';
		$data['username'] 		= $this->session->userdata('username');
		$data['id_user'] 		= $this->session->userdata('id_user');
		$data['nama_role'] 		= $this->session->userdata('nama_role');
		$data['fakultas'] 		= $this->db->select('*')
								->from('fakultas')
								->get()->result_object();
		$data['editdata'] 		= $this->db->get_where('prodi',array('id_prodi'=>$id))->row();
		$this->template->display('admin/prodi/edit',$data);
	}

	public function update()
	{
		$id_prodi 		= $this->input->post('id_prodi');
		$kode_fakultas 	= $this->input->post('kode_fakultas');
		$kode_prodi 	= $this->input->post('kode_prodi');
		$nama_prodi 	= $this->input->post('nama_prodi');

		$object = array(
			'kode_fakultas'=>$kode_fakultas,
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
			'status_aktif'=>$status,
		);

		$this->db->where('id_prodi', $id);
		$this->db->update('prodi', $object);

		if($this->db->affected_rows()){
			$this->session->set_flashdata('info','Data berhasil Diblokir.');
			redirect('admin/Prodi');
		}else{
			$this->session->set_flashdata('info','Data gagal Diblokir.');
			redirect('admin/Prodi');
		}
	}
}

/* End of file Prodi.php */
/* Location: ./application/modules/admin/controllers/Prodi.php */