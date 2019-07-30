<?php defined('BASEPATH') or exit('No direct script access allowed');

class Menu extends CI_Controller
{
	public function index()
	{
		$this->load->model('Menu_model');
		$menus = $this->Menu_model->menus();
		//$data = array('menus' => $menus);
		echo json_encode($menus);
	}
	public function get_menus($role_id = null)
	{
		$this->load->model('Menu_model');
		$menus = $this->Menu_model->menus();
		$data = array('menus' => $menus);
		$this->load->view('welcome_message', $data);
	}
}
