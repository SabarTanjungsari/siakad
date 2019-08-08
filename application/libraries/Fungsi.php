<?php

class Fungsi
{
	protected $ci;

	function __construct()
	{
		$this->ci = &get_instance();
	}

	function user_login()
	{
		$this->ci->load->model('user_model');
		$user_id = $this->ci->session->userdata('userid');
		$user_data = $this->ci->user_model->get($user_id)->row();
		return $user_data;
	}

	function role_menu($class)
	{
		$this->ci->load->model('menu_model');
		$role_id = $this->ci->session->userdata('roleid');
		$role_data = $this->ci->menu_model->getmenu_role($role_id, $class)->row();
		return $role_data;
	}
}
