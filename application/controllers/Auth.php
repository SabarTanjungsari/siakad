<?php defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('Menu_model');
	}

	public function index()
	{
		$menus = $this->Menu_model->menus();
		$data = array('menus' => $menus);
		$this->template->load('template', 'login', $data);
	}
}
