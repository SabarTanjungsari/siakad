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
		$this->load->view('login');
	}

	public function process()
	{
		$post = $this->input->post(null, TRUE);
		if (isset($post['login'])) {
			$this->load->model('user_model');
			$query = $this->user_model->login($post);
			if ($query->num_rows() > 0) {
				$row = $query->row();
				$params = array(
					'userid' => $row->user_id,
					'roleid' => $row->role_id
				);
				$this->session->set_userdata($params);

				redirect('dashboard');
			} else {
				redirect('auth');
			}
		}
	}

	public function logout()
	{
		$params = array('userid', 'level', 'logged');
		$this->session->unset_userdata($params);

		redirect('auth/login');
	}
}
