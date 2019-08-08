<?php defined('BASEPATH') or exit('No direct script access allowed');

class User_model extends CI_Model
{
	public function login($post)
	{
		$array = array('email' => $post['email'], 'password' => sha1($post['password']), 'user.isactive' => 'Y');

		$this->db->select('user.user_id, user.name as username, user.email, user.image, role.role_id, role.name as role');
		$this->db->from('user');
		$this->db->join('role', 'role.role_id = user.role_id');
		$this->db->where($array);
		$query = $this->db->get();
		return $query;
	}

	public function get($id = null)
	{
		$this->db->select('user.*, role.name as role, role.role_id');
		$this->db->from('user');
		$this->db->join('role', 'role.role_id = user.role_id');
		if ($id != null) {

			$this->db->where('user.user_id', $id);
		}
		$query = $this->db->get();
		return $query;
	}

	public function add($post)
	{
		$params = [
			'name' => $post['username'],
			'email' => $post['email'],
			'password' => sha1($post['password']),
			'description' => $post['description'],
			'role_id' => $post['role'],
			'image' => $post['image'],
			'createdby' => $this->session->userdata('userid'),
			'updatedby' => $this->session->userdata('userid'),
		];
		$this->db->insert('user', $params);
	}

	public function edit($post)
	{
		$params = [
			'name' => $post['username'],
			'email' => $post['email'],
			'description' => $post['description'],
			'role_id' => $post['role'],
			'createdby' => $this->session->userdata('userid'),
			'updatedby' => $this->session->userdata('userid'),
			'updated' => date("Y-m-d H:m:s")
		];

		if ($post['image'] != null) {
			$params['image'] = $post['image'];
		}

		$user = $this->user_model->get($post['user_id'])->row();
		if ($user->password != $post['password']) {
			$params['password'] = sha1($post['password']);
		}
		$this->db->where('user_id', $post['user_id']);
		$this->db->update('user', $params);
	}

	public function delete($id)
	{
		$this->db->where('user_id', $id);
		$this->db->delete('user');
	}
}
