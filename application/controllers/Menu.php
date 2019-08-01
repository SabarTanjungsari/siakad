<?php defined('BASEPATH') or exit('No direct script access allowed');

class Menu extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		logged();
		check_admin(ucfirst($this->router->fetch_class()));
		get_menu();
	}

	public function index()
	{
		$this->template->load('template', 'menu');
	}

	public function get_menus($role_id = null)
	{
		$this->load->model('Menu_model');
		$menus = $this->Menu_model->menus();
		$data = array('menus' => $menus);
		$this->load->view('welcome_message', $data);
	}
}
