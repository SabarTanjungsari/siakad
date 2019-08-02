<?php defined('BASEPATH') or exit('No direct script access allowed');

class Menu_model extends CI_Model
{
	public function get($id = null)
	{
		$this->db->select('*');
		$this->db->from('menu');
		if ($id != null) {

			$this->db->where('menu_id', $id);
		}
		$query = $this->db->get();
		return $query;
	}

	public function add($post)
	{
		$params = [
			'name' => $post['name'],
			'icon' => $post['icon'],
			'description' => $post['description'],
			'link' => $post['link'],
			'createdby' => $this->session->userdata('userid'),
			'updatedby' => $this->session->userdata('usetid'),
		];
		$this->db->insert('menu', $params);
	}

	public function edit($post)
	{
		$params = [
			'name' => $post['name'],
			'icon' => $post['icon'],
			'description' => $post['description'],
			'link' => $post['link'],
			'createdby' => $this->session->userdata('userid'),
			'updatedby' => $this->session->userdata('userid'),
			'updated' => date("Y-m-d H:m:s")
		];

		$this->db->where('menu_id', $post['menu_id']);
		$this->db->update('menu', $params);
	}

	public function delete($id)
	{
		$this->db->where('menu_id', $id);
		$this->db->delete('menu');
	}

	function menus()
	{
		$this->db->distinct();
		$this->db->select("menu.*");
		$this->db->from("menu");
		$this->db->join('menuline', 'menuline.menu_id = menu.menu_id');
		$this->db->join('role_menu', 'role_menu.menuline_id = menuline.menuline_id');
		$this->db->where('role_id', $this->session->userdata('roleid'));
		$this->db->order_by('menu.menu_id', 'asc');
		$q = $this->db->get();

		$final = array();
		if ($q->num_rows() > 0) {
			foreach ($q->result() as $row) {

				$this->db->distinct();
				$this->db->select("menuline.menuline_id as id,*");
				$this->db->from("menuline");
				$this->db->join('role_menu', 'role_menu.menuline_id = menuline.menuline_id');
				$this->db->where('role_id', $this->session->userdata('roleid'));
				$this->db->where("menu_id", $row->menu_id);
				$this->db->order_by('id', 'asc');
				$q = $this->db->get();
				if ($q->num_rows() > 0) {
					$row->children = $q->result();
				}
				array_push($final, $row);
			}
		}
		return $final;
	}

	function getmenu_role($role_id, $class)
	{
		$this->db->select('count(role_menu.role_id) as count');
		$this->db->from('role_menu');
		$this->db->join('menuline', 'menuline.menuline_id = role_menu.menuline_id');
		$this->db->where('role_menu.role_id', $role_id);
		$this->db->where('menuline.link', $class);
		$query = $this->db->get();
		return $query;
	}
}
