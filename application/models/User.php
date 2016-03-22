<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Model {
	
	public function cek_user($data) {
		$query = $this->db->get_where('user', $data);
		return $query;
	}

	public function cek_data($username) {
        $this->db->where("username", $username);
        $query = $this->db->get("user");
        return $query->row_array();
    }

    public function insert($data){
		return $this->db->insert('user', $data);	
	}
}

/* End of file User.php */
/* Location: ./application/models/User.php */