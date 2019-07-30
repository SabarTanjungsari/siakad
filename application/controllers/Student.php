<?php defined('BASEPATH') or exit('No direct script access allowed');

class Student extends CI_Controller
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
		$this->template->load('template', 'dashboard');
	}

	public function profile()
	{
		$this->template->load('template', 'user/profile');
	}
}
