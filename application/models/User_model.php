<?php defined('BASEPATH') or exit('No direct script access allowed');

class User_model extends CI_Model
{
	public function login($post)
	{
		$array = array('email' => $post['email'], 'password' => sha1($post['password']), 'user.isactive' => 'Y');

		$this->db->select('user.user_id, user.name as username, user.email, role.role_id, role.name as role');
		$this->db->from('user');
		$this->db->join('role', 'role.role_id = user.role_id');
		$this->db->where($array);
		$query = $this->db->get();
		return $query;
	}

	public function get($id = null)
	{
		$this->db->from('user');
		if ($id != null) {

			$this->db->where('user_id', $id);
		}
		$query = $this->db->get();
		return $query;
	}
}
