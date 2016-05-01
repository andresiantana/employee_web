<?php
class Generator{
    protected $_ci;
    
    function __construct() {
        $this->_ci =&get_instance();
        $this->_ci->load->model('Notifikasi');
        $this->_ci->load->model('Pegawai');
    }
    
    function noPengajuanBiaya() {
        $default="0001";
        $prefix = 'PB'.date('ymd');
        $sql = "SELECT CAST(MAX(SUBSTR(kode_pengajuan,".(strlen($prefix)+1).",".(strlen($default)).")) AS integer) nomaksimal 
                FROM pengajuan_biaya 
                WHERE kode_pengajuan LIKE ('".$prefix."%')";
        $noPengajuan = $this->db->query($sql);
        $noPengajuanBaru =$prefix.(isset($noPengajuan['nomaksimal']) ? (str_pad($noPengajuan['nomaksimal']+1, strlen($default), 0,STR_PAD_LEFT)) : $default);
        return $noPengajuanBaru;
    }
}
