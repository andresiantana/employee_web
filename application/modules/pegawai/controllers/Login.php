<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form','url'));		
		$this->load->library('session');
        $this->load->library('form_validation');
        $this->load->model('User');
		//Do your magic here
	}

	public function index() {
        $this->load->view('pegawai/login/login');
    }

    public function cek_login() {
        $data = array('username' => $this->input->post('username', TRUE),
                        'password' => $this->input->post('password', TRUE)
        );
        $this->load->model('user'); // load model_user
        $hasil = $this->user->cek_user($data);
        if ($hasil->num_rows() == 1) {
            foreach ($hasil->result() as $sess) {
                $sess_data['login'] = 'Sudah Login';
                $sess_data['username'] = $sess->username;
                $sess_data['nama_user'] = $sess->nama_lengkap;
                $this->session->set_userdata($sess_data);
            }
            redirect('pegawai/dataPegawai');     
        }
        else {
            echo "<script>alert('Gagal login: Cek username, password!');history.go(-1);</script>";
        }
    }

}

/* End of file Login.php */
/* Location: ./application/controllers/Login.php */