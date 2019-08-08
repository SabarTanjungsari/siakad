<?php defined('BASEPATH') or exit('No direct script access allowed');

class Icon_model extends CI_Model
{
	public function get($id = null)
	{
		$this->db->from('icon');
		if ($id != null) {

			$this->db->where('icon_id', $id);
		}
		$query = $this->db->get();
		return $query;
	}
}
