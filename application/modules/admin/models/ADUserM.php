<?php
$obj = &get_instance();
$obj->load->model('User');
defined('BASEPATH') OR exit('No direct script access allowed');
class ADUserM extends User {

	public function tampilDataPemakai(){
		$this->db->select('*');
		$this->db->from('user');
		$this->db->join('role', 'role.id_role = user.id_role','Left');
		$this->db->not_like('nama_role', 'Admin');
		$query = $this->db->get();
        return $query;
	}
}

/* End of file ADUserM.php */
/* Location: ./application/modules/admin/models/ADUserM.php */