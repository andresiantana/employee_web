<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
        $this->load->library('template');
		$this->load->helper(array('form','url'));		
		$this->load->library('session');
        $this->load->library('form_validation');
        $this->load->model('User');
	}

    public function index() {
        $data = null;
        $this->template->displayLogin('pegawai/login/login',$data);
    }

    public function cek_login() {
        $data = array(
                    'username' => $this->input->post('username', TRUE),
                    'password' => $this->input->post('password', TRUE),
                    'nama_role'=>'Pegawai'
                );
        $this->load->model('user'); // load model_user
        $hasil = $this->user->cek_user_role($data);
        if ($hasil->num_rows() == 1) {
            foreach ($hasil->result() as $sess) {
                $sess_data['login'] = 'Sudah Login';
                $sess_data['id_user'] = $sess->id_user;
                $sess_data['username'] = $sess->username;
                $sess_data['nama_user'] = $sess->nama_lengkap;
                $sess_data['nama_role'] = $sess->nama_role;
                $this->session->set_userdata($sess_data);
            }
            redirect('pegawai/DataPegawai');     
        }
        else {
            echo "<script>alert('Gagal login: Cek username, password!');history.go(-1);</script>";
        }
    }

    public function resetPassword()
    {
        $data = null;
        $this->template->displayLogin('pegawai/login/resetpassword',$data);
    }

    public function cekUser(){
        $status     = '';
        $pesan      = '';
        $username   = $this->input->post('username') ? $this->input->post('username') : '';

        $cek_user   = $this->db->select('*')
                        ->from('user')
                        ->join('role', 'role.id_role = user.id_role','Left')
                        ->like('username', $username)
                        ->where('role.nama_role','Pegawai')
                        ->get()->num_rows();
        if($cek_user > 0){
            $status = true;
        }else{
            $status = false;
            $pesan = 'Username tidak terdaftar dalam database!';
        }

        $data['status'] = $status;
        $data['pesan']  = $pesan;
        echo json_encode($data); 
        exit;
    }

    public function randomPassword(){
        // function untuk membuat password random 6 digit karakter
        $username   = $this->input->post('username') ? $this->input->post('username') : '';
        $status     = '';
        $digit      = 6;
        $karakter   = "ABCDEFGHJKLMNPQRSTUVWXYZ23456789";

        srand((double)microtime()*1000000);
        $i = 0;
        $pass = "";
        while ($i <= $digit-1)
        {
            $num    = rand() % 32;
            $tmp    = substr($karakter,$num,1);
            $pass   = $pass.$tmp;
            $i++;
        }

        $object = array(
            'password'=>$pass
        );

        $this->db->where('username', $username);
        $this->db->update('user', $object);
        if($this->db->affected_rows()){
            $status = true;
            $pass = $pass;
        }else{
            $status = false;
            $pass = null;
        }

        $data['status'] = $status;
        $data['password_baru']  = $pass;
        echo json_encode($data); 
        exit;
    }

}

/* End of file Login.php */
/* Location: ./application/controllers/Login.php */