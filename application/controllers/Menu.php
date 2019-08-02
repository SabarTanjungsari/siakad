<?php defined('BASEPATH') or exit('No direct script access allowed');

class Menu extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		logged();
		check_admin(ucfirst($this->router->fetch_class()));
		get_menu();
		$this->load->model(['menu_model', 'icon_model']);
	}

	public function index()
	{
		$data['row'] = $this->menu_model->get();
		$this->template->load('template', 'menu/menu_data', $data);
	}

	public function add()
	{
		$menu = new stdClass();
		$menu->menu_id = null;
		$menu->name = null;
		$menu->icon = null;
		$menu->link = null;
		$menu->description = null;

		$data = array(
			'page' => 'add',
			'row' => $menu,
			'icons' => $this->icon_model->get()
		);
		$this->template->load('template', 'menu/menu_form', $data);
	}

	public function edit($id)
	{
		$query = $this->menu_model->get($id);

		if ($query->num_rows() > 0) {
			$menu = $query->row();
			$data = array(
				'page' => 'edit',
				'row' => $menu
			);
			$this->template->load('template', 'menu/menu_form', $data);
		} else {
			$this->session->set_flashdata('error', 'Data not found');
			redirect('menu');
		}
	}

	public function process()
	{
		$page = $this->input->post('page');

		if (ucfirst($page) == 'Add') {
			$this->form_validation->set_rules('name', 'Name', 'trim|required|is_unique[menu.name]');
		} else if (ucfirst($page) == 'Edit') {
			$this->form_validation->set_rules('name', 'Name', 'trim|required|callback_name_check');
		}

		$this->form_validation->set_rules('icon', 'Icon', 'trim|required');
		$this->form_validation->set_rules('description', 'Description', 'trim|required');
		$this->form_validation->set_message('is_unique', 'This {field} has been used, please replace the other one');

		$this->form_validation->set_error_delimiters('<span class="small text-danger">', '</span>');

		if ($this->form_validation->run() == FALSE) {
			if (ucfirst($page) == 'Add') {
				$menu = new stdClass();
				$menu->menu_id = null;
				$menu->name = $this->input->post('name');
				$menu->icon = $this->input->post('icon');
				$menu->link = $this->input->post('link');
				$menu->description = $this->input->post('description');

				$data = array(
					'page' => $this->input->post('page'),
					'row' => $menu,
				);
				$this->template->load('template', 'menu/menu_form', $data);
			} else if (ucfirst($page) == 'Edit') {
				$menu = new stdClass();
				$menu->menu_id = $this->input->post('menu_id');
				$menu->name = $this->input->post('name');
				$menu->icon = $this->input->post('icon');
				$menu->link = $this->input->post('link');
				$menu->description = $this->input->post('description');

				$data = array(
					'page' => $this->input->post('page'),
					'row' => $menu,
				);
				$this->template->load('template', 'menu/menu_form', $data);
			}
		} else {
			$post = $this->input->post(null, true);

			if (isset($_POST['add'])) {
				$this->menu_model->add($post);
				if ($this->db->affected_rows() > 0) {
					$this->session->set_flashdata('success', 'Data saved successfully');
				}
				redirect('menu');
			} elseif (isset($_POST['edit'])) {
				$this->menu_model->edit($post);
				if ($this->db->affected_rows() > 0) {
					$this->session->set_flashdata('success', 'Data saved successfully');
				}
				redirect('menu');
			}
		}
	}


	public function delete($id)
	{
		$menu = $this->menu_model->get($id)->row();
		$this->menu_model->delete($id);

		if ($this->db->affected_rows() > 0) {
			$this->session->set_flashdata('success', 'Data deleted successfully');
		}

		redirect(base_url('menu'));
	}

	public function name_check()
	{
		$post = $this->input->post(null, TRUE);
		$this->db->select('*');
		$this->db->from('menu');
		$this->db->where('name', $post['name']);
		$this->db->where('menu_id !=', $post['menu_id']);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			$this->form_validation->set_message('name_check', 'This {field} has been used, please replace the other one');
			return FALSE;
		} else {
			return TRUE;
		}
	}

	public function get_menus($role_id = null)
	{
		$this->load->model('Menu_model');
		$menus = $this->Menu_model->menus();
		$data = array('menus' => $menus);
		$this->load->view('welcome_message', $data);
	}
}
