<?php defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
	//var $data;
	function __construct()
	{
		parent::__construct();
		logged();
		get_menu();
	}

	public function index()
	{
		$this->template->load('template', 'dashboard');
	}
}
