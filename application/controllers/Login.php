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

	public function index()
    {
        $data = null;
        
        redirect('pegawai',array());
    }
}

/* End of file Login.php */
/* Location: ./application/controllers/Login.php */