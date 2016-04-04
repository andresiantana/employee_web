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
		$this->load->helper(array('form','url'));			
		$this->load->library('form_validation');
		$this->load->library('session');      
        $this->load->model('LokasiPendidikanM');
	}

	public function index()
	{
		$data['username'] 		= $this->session->userdata('username');
		$data['nama_role'] 		= $this->session->userdata('nama_role');
		$data['judulHeader'] 	= 'Lokasi Pendidikan';
		$data['menu'] 	= 'lokasiPendidikan';
		$data['data']	= $this->LokasiPendidikanM->tampilData()->result_object();		
		$this->template->display('admin/lokasiPendidikan/admin',$data);
	}

	public function tambah()
	{
		$data['username'] = $this->session->userdata('username');
		$data['nama_role'] = $this->session->userdata('nama_role');
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

}

/* End of file LokasiPendidikan.php */
/* Location: ./application/modules/admin/controllers/LokasiPendidikan.php */