<?php defined('BASEPATH') or exit('No direct script access allowed');

class Role_model extends CI_Model
{
	public function get($id = null)
	{
		$this->db->from('role');
		if ($id != null) {

			$this->db->where('role_id', $id);
		}
		$query = $this->db->get();
		return $query;
	}
}
