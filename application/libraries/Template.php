<?php
class Template{
    protected $_ci;
    
    function __construct() {
        $this->_ci =&get_instance();
        $this->_ci->load->model('Notifikasi');
        $this->_ci->load->model('Pegawai');
    }
    
    function display($template,$data=null){
        $data['judul'] = 'Employee Web';
        $data['_content'] = $this->_ci->load->view($template,$data,true);   
        $data['isi_notifikasi']      = array();
        $data['isi_notifikasi2']      = array();
        $data['userPegawai'] =  $this->_ci->Pegawai->tampilUserPegawai($data['id_user'])->row();

        if($data['nama_role'] == 'Admin'){
            $data['_menu'] = $this->_ci->load->view('menu_admin',$data,true); 
            $data['isi_notifikasi'] = $this->_ci->Notifikasi->tampilNotifikasi()->result_object();
            $data['_notifikasi'] = $this->_ci->load->view('notifikasi_admin',$data,true);             
        }else if($data['nama_role'] == 'SDM'){
            $data['_menu'] = $this->_ci->load->view('menu_sdm',$data,true); 
            $data['isi_notifikasi'] = $this->_ci->Notifikasi->tampilNotifikasiSDM()->result_object();
            $data['isi_notifikasi2'] = $this->_ci->Pegawai->tampilDataPegawaiBaru()->result_object();
            $data['_notifikasi'] = $this->_ci->load->view('notifikasi_sdm',$data,true);             
        }else if ($data['nama_role'] == 'Keuangan'){
            $data['_menu'] = $this->_ci->load->view('menu_keuangan',$data,true); 
            $data['isi_notifikasi'] = $this->_ci->Notifikasi->tampilNotifikasi()->result_object();
            $data['_notifikasi'] = $this->_ci->load->view('notifikasi_keuangan',$data,true);             
        } else if ($data['nama_role'] == 'Pegawai') {
            $data['_menu'] = $this->_ci->load->view('menu_pegawai',$data,true); 
            $data['isi_notifikasi'] = $this->_ci->Notifikasi->tampilNotifikasiDariSDM()->result_object();
            $data['_notifikasi'] = $this->_ci->load->view('notifikasi_pegawai',$data,true);             
        }else{
            $data['_menu'] = $this->_ci->load->view('menu_admin',$data,true); 
            $data['isi_notifikasi'] = $this->_ci->Notifikasi->tampilNotifikasi()->result_object();
            $data['_notifikasi'] = $this->_ci->load->view('notifikasi_admin',$data,true);             
        }
        $data['_error'] = $this->_ci->load->view('error_404',$data,true);      
        $this->_ci->load->view('/template.php',$data);
    }

    function displayLogin($template,$data=null){
        $data['_content'] = $this->_ci->load->view($template,$data,true);
        $data['_error'] = $this->_ci->load->view('error_404',$data,true);      
        $this->_ci->load->view('/template_login.php',$data);
    }
}
