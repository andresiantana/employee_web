<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
    var $photo_path;
    var $photo_path_url;

	public function __construct()
	{
		parent::__construct();
        $this->load->library('template');
		$this->load->helper(array('form','url'));		
		$this->load->library('session');
        $this->load->library('form_validation');
        $this->load->model('User');
        // menentukan path photo (folder penyimpanan)
        $this->gallery_path = realpath(APPPATH.'../data/images/user');
        $this->gallery_path_url = base_url().'data/images/user';
		//Do your magic here
	}

	public function index() {
        $data = null;
        $this->template->displayLogin('admin/login/login',$data);
    }

    public function cek_login() {
        $data = array(
                    'username' => $this->input->post('username', TRUE),
                    'password' => $this->input->post('password', TRUE),
                    'nama_role'=>'Admin'
                );
        $this->load->model('user'); // load model_user
        $hasil = $this->user->cek_user_role($data);
        if ($hasil->num_rows() == 1) {
            foreach ($hasil->result() as $sess) {
                $sess_data['login'] = 'Sudah Login';
                $sess_data['username'] = $sess->username;
                $sess_data['nama_user'] = $sess->nama_lengkap;
                $sess_data['nama_role'] = $sess->nama_role;
                $this->session->set_userdata($sess_data);
            }
            redirect('admin/Dashboard');     
        }
        else {
            echo "<script>alert('Gagal login: Cek username, password!');history.go(-1);</script>";
        }
    }

    public function register() {
        $data = null;
        $this->template->displayLogin('admin/Login/register',$data);
    }

    public function register_proses(){
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('nama_lengkap', 'Nama Lengkap', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if($this->form_validation->run() == FALSE){
            $data = null;
            $this->template->displayLogin('admin/Login/register',$data);
        }else{
            $username = $this->input->post('username');
            $nama_lengkap = $this->input->post('nama_lengkap');
            $password = $this->input->post('password');
            $no_telp = $this->input->post('no_telp');
            $alamat = $this->input->post('alamat');

            $object = array(
                'username'=>$username,
                'password'=>$password,
                'nama_lengkap'=>$nama_lengkap,
                'no_telp'=>$no_telp,
                'alamat'=>$alamat,
                'photo'=>'',
                'path_photo'=>'',
                'id_role'=>''
            );

            $cek_data = $this->User->cek_data($username);
            if(empty($cek_data)){
                $insert = $this->User->insert($object);
                if($insert){
                    echo "<script>alert('Data User berhasil disimpan!');
                        window.location.href='".base_url('admin/Login')."';
                    </script>";
                }
            }else{
                echo "<script>alert('Maaf, username sudah ada!');
                    window.location.href='".base_url('admin/Login/register')."';
                </script>";
            }         
        }   
    }

}

/* End of file Login.php */
/* Location: ./application/controllers/Login.php */