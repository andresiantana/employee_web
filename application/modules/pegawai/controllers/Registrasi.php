<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Registrasi extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
        $this->load->library('template');
		$this->load->helper(array('form','url'));		
		$this->load->library('session');
        $this->load->library('form_validation');
        $this->load->model('User');
        $this->load->model('PGRoleM');
		//Do your magic here
	}

	public function index()
	{
		$data = null;
        $this->template->displayLogin('pegawai/login/register',$data);
	}

    public function register_proses(){
        $this->form_validation->set_rules('username', 'Username', 'required');
        // $this->form_validation->set_rules('nama_lengkap', 'Nama Lengkap', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if($this->form_validation->run() == FALSE){
            $this->load->view('pegawai/login/register');
        }else{
            $username = $this->input->post('username');
            $nama_lengkap = $this->input->post('nama_lengkap');
            $password = $this->input->post('password');
            $no_telp = $this->input->post('no_telp');
            $alamat = $this->input->post('alamat');
            $role = $this->PGRoleM->select_role_pegawai();
            if($nama_lengkap == ''){
            	$nama_lengkap = $username;
            }
            $id_role = $role->row()->id_role;
            $object = array(
                'username'=>$username,
                'password'=>$password,
                'nama_lengkap'=>$nama_lengkap,
                'no_telp'=>$no_telp,
                'alamat'=>$alamat,
                'photo'=>'',
                'path_photo'=>'',
                'id_role'=>$id_role
            );

            $cek_data = $this->User->cek_data($username);
            if(empty($cek_data)){
                $insert = $this->User->insert($object);
                if($insert){
                    echo "<script>alert('Data Registrasi User Pegawai berhasil disimpan!');
                        window.location.href='".base_url('pegawai/login')."';
                    </script>";
                }
            }else{
                echo "<script>alert('Maaf, username sudah ada!');
                    window.location.href='".base_url('pegawai/login/register')."';
                </script>";
            }         
        }   
    }

}

/* End of file Registrasi.php */
/* Location: ./application/modules/pegawai/controllers/Registrasi.php */