<?php defined('BASEPATH') or exit('No direct script access allowed');

class Menu_model extends CI_Model
{
	function menus()
	{
		$this->db->select("*");
		$this->db->from("menu");
		$q = $this->db->get();

		$final = array();
		if ($q->num_rows() > 0) {
			foreach ($q->result() as $row) {

				$this->db->select("*");
				$this->db->from("menuline");
				$this->db->where("menu_id", $row->menu_id);
				$q = $this->db->get();
				if ($q->num_rows() > 0) {
					$row->children = $q->result();
				}
				array_push($final, $row);
			}
		}
		return $final;
	}
}
