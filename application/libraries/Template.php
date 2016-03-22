<?php
class Template{
    protected $_ci;
    
    function __construct() {
        $this->_ci =&get_instance();
    }
    
    function display($template,$data=null){
        $data['_content'] = $this->_ci->load->view($template,$data,true);
        $data['_menu'] = $this->_ci->load->view('menu',$data,true);  
        $data['_error'] = $this->_ci->load->view('error_404',$data,true);      
        $this->_ci->load->view('/template.php',$data);
    }
}
