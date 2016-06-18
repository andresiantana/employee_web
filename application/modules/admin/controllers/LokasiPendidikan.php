<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LokasiPendidikan extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('username')=="") {
			redirect('login');
		}
		$this->load->library('template');
		$this->load->library("PHPExcel");	
		$this->load->helper(array('form','url'));			
		$this->load->library('form_validation');
		$this->load->library('session');      
        $this->load->model('LokasiPendidikanM');
	}

	public function index($id=NULL)
	{
		$data['username'] 		= $this->session->userdata('username');
		$data['id_user'] 		= $this->session->userdata('id_user');
		$data['nama_role'] 		= $this->session->userdata('nama_role');
		$data['judulHeader'] 	= 'Lokasi Pendidikan';
		$data['menu'] 			= 'lokasiPendidikan';

		$jml = $this->db->get('lokasi_pendidikan');

		//pengaturan pagination
		 $config['base_url'] = base_url().'admin/lokasiPendidikan/index';
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
	 	$nama_lokasi = $this->input->post('nama_lokasi');
		$nama_universitas = $this->input->post('nama_universitas');
		if($nama_lokasi != '' || $nama_universitas != ''){
			$jml = $this->db->select('*')
						->from('lokasi_pendidikan')
						->where('nama_lokasi',$nama_lokasi)
						->like('nama_universitas',$nama_universitas)
						->get();
			//pengaturan pagination
			 $config['base_url'] = base_url().'admin/lokasiPendidikan/index';
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
			$data['data'] =  $this->LokasiPendidikanM->tampilDataLokasi($config['per_page'], $id, $nama_lokasi, $nama_universitas);
			$tr['tr'] = $this->load->view('admin/lokasiPendidikan/pencarian',$data,true);
			echo json_encode($tr['tr']); 
			exit;
		}else{
			$nama_lokasi = '';
			$nama_universitas = '';
			$data['data'] = $this->LokasiPendidikanM->tampilDataLokasi($config['per_page'], $id, $nama_lokasi, $nama_universitas);
		}	

		// $data['data']	= $this->LokasiPendidikanM->tampilData()->result_object();		
		$this->template->display('admin/lokasiPendidikan/admin',$data);
	}

	public function tambah()
	{
		$data['username'] 	= $this->session->userdata('username');
		$data['id_user'] 	= $this->session->userdata('id_user');
		$data['nama_role'] 	= $this->session->userdata('nama_role');
		$data['judulHeader'] = 'Lokasi Pendidikan';
		$data['menu'] = 'lokasiPendidikan';		
		$this->template->display('admin/lokasiPendidikan/tambah',$data);
	}

	public function insert()
	{
		$status = '';

		foreach ($this->input->post('pendidikan') as $i => $data) {	
			$nama_lokasi = $this->input->post('nama_lokasi');
			$nama_universitas = $data['nama_universitas'];
			$alamat 	= $data['alamat'];
			$no_telp 	= $data['no_telp'];

			$object = array(
				'nama_lokasi'=>$nama_lokasi,
				'nama_universitas'=>$nama_universitas,
				'alamat'=>$alamat,
				'no_telp'=>$no_telp
			);

			$insert = $this->LokasiPendidikanM->insert($object);
			
			if($insert){
				$status = 'berhasil';
			}
		}

		if($status == 'berhasil'){
			echo "<script>alert('Data berhasil disimpan!');
                    window.location.href='".base_url('admin/LokasiPendidikan/index')."';
                </script>";
		}else{
			echo "<script>alert('Data gagal disimpan!');
                    window.location.href='".base_url('admin/LokasiPendidikan/tambah')."';
                </script>";
		}
	}

	public function hapus($id)
	{
		$hapus = $this->LokasiPendidikanM->delete($id);
		if($this->db->affected_rows()){
			$this->session->set_flashdata('info','Data berhasil Dihapus.');
			redirect('admin/LokasiPendidikan');
		}else{
			$this->session->set_flashdata('info','Data gagal Dihapus.');
			redirect('admin/LokasiPendidikan');
		}
	}

	public function edit($id = null)
	{		
		$data['judulHeader'] = 'Lokasi Pendidikan';
		$data['menu'] = 'lokasiPendikan';
		$data['username'] = $this->session->userdata('username');
		$data['id_user'] = $this->session->userdata('id_user');
		$data['nama_role'] = $this->session->userdata('nama_role');
		$data['editdata'] = $this->db->get_where('lokasi_pendidikan',array('id_lokasi'=>$id))->row();
		$this->template->display('admin/lokasiPendidikan/edit',$data);
	}

	public function update()
	{
		$id_lokasi = $this->input->post('id_lokasi');
		$nama_lokasi = $this->input->post('nama_lokasi');
		$nama_universitas = $this->input->post('nama_universitas');
		$alamat = $this->input->post('alamat');
		$no_telp = $this->input->post('no_telp');

		$object = array(
			'nama_lokasi'=>$nama_lokasi,
			'nama_universitas'=>$nama_universitas,
			'alamat'=>$alamat,
			'no_telp'=>$no_telp
		);

		$this->db->where('id_lokasi', $id_lokasi);
		$this->db->update('lokasi_pendidikan', $object);
		if ($this->db->affected_rows()) {
			$this->session->set_flashdata('info', 'Data berhasil diubah.');
			redirect('admin/LokasiPendidikan');
		} else {
			$this->session->set_flashdata('info', 'Data gagal diubah.');
			redirect('admin/LokasiPendidikan');
		}
	}

	public function setFormUniversitas(){
		$data['tr'] = '';
		$data['tr'] .= '<tr>';
		$data['tr'] .= '<td><input id="pendidikan_0_nama_universitas" class="form-control nama_universitas" name="pendidikan[0][nama_universitas]" type="text"></td>';
		$data['tr'] .= '<td><textarea id="pendidikan_0_alamat" name="pendidikan[0][alamat]" class="form-control"></textarea></td>';
		$data['tr'] .= '<td><input id="pendidikan_0_no_telp" name="pendidikan[0][no_telp]" type="text" class="form-control"></td>';
		$data['tr'] .= '<td><a href="#" class="btn btn-small btn-success" onclick="tambahUniversitas();"><i class="fa fa-plus"> </i></a><a style="margin-left:10px;" href="#" class="btn btn-small btn-success" onClick="hapusUniversitas(this);" ><i class="fa fa-minus"> </i></a></td>';
		$data['tr'] .= '</tr>';
		echo json_encode($data); 
		exit;
	}

	public function importLokasiPendidikan($sukses = "")
	{
		$data['username'] 	= $this->session->userdata('username');
		$data['id_user'] 	= $this->session->userdata('id_user');
		$data['nama_role'] 	= $this->session->userdata('nama_role');
		$data['judulHeader'] = 'Lokasi Pendidikan';
		$data['menu'] = 'lokasiPendidikan';		
		$this->template->display('admin/lokasiPendidikan/import',$data);
	}

	public function do_upload(){
        $config['upload_path'] = './data/uploads/';
        $config['allowed_types'] = 'xlsx|xls';
        
        $this->load->library('upload', $config);
        
        if (!$this->upload->do_upload("file")){
            $error = array('error' => $this->upload->display_errors());
        }
        else{
        	if(isset($_POST['drop']) && $_POST['drop'] == 1){
        		$this->db->empty_table('lokasi_pendidikan');
        	}
            $data = array('upload_data' => $this->upload->data());
            $upload_data = $this->upload->data(); //Mengambil detail data yang di upload
            $filename = $upload_data['file_name'];//Nama File
            $this->LokasiPendidikanM->upload_data($filename);
            unlink('./data/uploads/'.$filename);
            redirect('admin/LokasiPendidikan/importLokasiPendidikan/sukses','refresh');
        }
    }

}

/* End of file LokasiPendidikan.php */
/* Location: ./application/modules/admin/controllers/LokasiPendidikan.php */