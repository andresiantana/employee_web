<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Model {
	
	public function tampilDataPemakai(){
		$this->db->select('*');
		$this->db->from('user');
		$this->db->join('role', 'role.id_role = user.id_role','Left');
		$query = $this->db->get();
        return $query;
	}

	public function tampilDataUser($num, $offset, $id_role, $username)
	{
		$this->db->order_by('user.username', 'ASC');
		if($id_role != ''){
			$this->db->where('user.id_role', $id_role);
		}
		if($username != ''){
			$this->db->like('username', $username);
		}
		$this->db->join('role', 'role.id_role = user.id_role','Left');
		$data = $this->db->get('user', $num, $offset);

		return $data->result();
	}

	public function cek_user_role($data) {
		$this->db->select('*');
		$this->db->from('user');
		$this->db->join('role', 'role.id_role = user.id_role','Left');
		$this->db->where($data);
		$query = $this->db->get();
		return $query;
	}

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

	public function delete($id){
		return $this->db->delete('user', array('username'=>$id));	
	}
}

/* End of file User.php */
/* Location: ./application/models/User.php */