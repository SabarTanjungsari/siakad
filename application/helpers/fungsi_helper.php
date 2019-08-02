<?php

function logged()
{
	$ci = &get_instance();
	$user_session = $ci->session->userdata('userid');
	if (!$user_session) {
		redirect('auth');
	}
}

function check_admin($class)
{
	$ci = &get_instance();
	$ci->load->library('fungsi');

	if ($ci->fungsi->role_menu($class)->count != 1) {
		redirect('dashboard');
	}
}

function get_menu()
{
	$ci = &get_instance();
	$ci->load->model('menu_model');

	$menu_ = $ci->menu_model->menus();
	$menus = array('menus' => $menu_);
	$ci->session->set_userdata($menus);
}
