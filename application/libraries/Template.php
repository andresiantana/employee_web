<?php
class Template{
    protected $_ci;
    
    function __construct() {
        $this->_ci =&get_instance();
    }
    
    function display($template,$data=null){
        $data['judul'] = 'Employee Web';
        $data['_content'] = $this->_ci->load->view($template,$data,true);
        if($data['nama_role'] == 'Admin'){
            $data['_menu'] = $this->_ci->load->view('menu_admin',$data,true); 
        }else if($data['nama_role'] == 'SDM'){
            $data['_menu'] = $this->_ci->load->view('menu_sdm',$data,true); 
        }else if ($data['nama_role'] == 'Keuangan'){
            $data['_menu'] = $this->_ci->load->view('menu_keuangan',$data,true); 
        } else if ($data['nama_role'] == 'Pegawai') {
            $data['_menu'] = $this->_ci->load->view('menu_pegawai',$data,true); 
        }else{
            $data['_menu'] = $this->_ci->load->view('menu_admin',$data,true); 
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
