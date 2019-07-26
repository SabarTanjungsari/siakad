<?php defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('logged') != TRUE) {
			redirect('auth');
		}

		$this->load->model('Menu_model');
	}

	public function index()
	{
		$menus = $this->Menu_model->menus();
		$data = array('menus' => $menus);
		$this->template->load('template', 'dashboard', $data);
	}

	public function profile()
	{
		$menus = $this->Menu_model->menus();
		$data = array('menus' => $menus);
		$this->template->load('template', 'user/profile', $data);
	}
}
