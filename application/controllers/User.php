<?php defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		logged();
		check_admin(ucfirst($this->router->fetch_class()));
		get_menu();
		$this->load->model(['user_model', 'role_model']);
	}

	public function index()
	{
		$data['row'] = $this->user_model->get();
		$this->template->load('template', 'user/user_data', $data);
	}

	public function add()
	{
		$user = new stdClass();
		$user->user_id = null;
		$user->name = null;
		$user->email = null;
		$user->password = null;
		$user->description = null;
		$user->role_id = null;
		$user->image = 'empty.png';

		$role = $this->role_model->get();

		$data = array(
			'page' => 'add',
			'row' => $user,
			'role' => $role,
		);
		$this->template->load('template', 'user/user_form', $data);
	}

	public function edit($id)
	{
		$query = $this->user_model->get($id);
		$role = $this->role_model->get();

		if ($query->num_rows() > 0) {
			$user = $query->row();
			$data = array(
				'page' => 'edit',
				'row' => $user,
				'role' => $role,
			);
			$this->template->load('template', 'user/user_form', $data);
		} else {
			$this->session->set_flashdata('error', 'Data not found');
			redirect('user');
		}
	}

	public function process()
	{
		$page = $this->input->post('page');

		$this->form_validation->set_rules('username', 'Username', 'required');

		if (ucfirst($page) == 'Add') {
			$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[user.email]');
		} else if (ucfirst($page) == 'Edit') {
			$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|callback_email_check');
		}

		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[5]');
		$this->form_validation->set_rules('passconf', 'Password Confirmation', 'trim|required|matches[password]');
		$this->form_validation->set_rules('role', 'Role', 'required');

		$this->form_validation->set_message('is_unique', 'This {field} has been used, please replace the other one');

		$this->form_validation->set_error_delimiters('<span class="small text-danger">', '</span>');

		if ($this->form_validation->run() == FALSE) {
			if (ucfirst($page) == 'Add') {
				$user = new stdClass();
				$user->user_id = null;
				$user->name = $this->input->post('username');
				$user->email = $this->input->post('email');
				$user->password = $this->input->post('password');
				$user->description = $this->input->post('description');
				$user->role_id = $this->input->post('role');
				$user->image = 'empty.png';

				$role = $this->role_model->get();

				$data = array(
					'page' => $this->input->post('page'),
					'row' => $user,
					'role' => $role,
				);
				$this->template->load('template', 'user/user_form', $data);
			} else if (ucfirst($page) == 'Edit') {
				$user = new stdClass();
				$user->user_id = $this->input->post('user_id');
				$user->name = $this->input->post('username');
				$user->email = $this->input->post('email');
				$user->password = $this->input->post('password');
				$user->description = $this->input->post('description');
				$user->role_id = $this->input->post('role');

				$user->image = $this->user_model->get($this->input->post['user_id'])->row()->image;

				$role = $this->role_model->get();

				$data = array(
					'page' => $this->input->post('page'),
					'row' => $user,
					'role' => $role,
				);
				$this->template->load('template', 'user/user_form', $data);
			}
		} else {
			$post = $this->input->post(null, true);

			$config['upload_path']          = './uploads/user';
			$config['allowed_types']        = 'gif|jpg|png|jpeg';
			$config['max_size']             = 2048;
			$config['file_name']            = 'user-' . date('ymd') . '-' . substr(md5(rand()), 0, 10);
			$this->load->library('upload', $config);

			if (isset($_POST['add'])) {
				if (@$_FILES['image']['name'] != null) {
					if ($this->upload->do_upload('image')) {
						$post['image'] = $this->upload->data('file_name');
						$this->user_model->add($post);
						if ($this->db->affected_rows() > 0) {
							$this->session->set_flashdata('success', 'Data saved successfully');
						}
						redirect('user');
					} else {
						$error = $this->upload->display_errors();
						$this->session->set_flashdata('error', $error);
						redirect("user/add");
					}
				} else {
					$post['image'] = null;
					$this->user_model->add($post);
					if ($this->db->affected_rows() > 0) {
						$this->session->set_flashdata('success', 'Data berhasil disimpan');
					}
					redirect('user');
				}
			} else if (isset($_POST['edit'])) {
				if (@$_FILES['image']['name'] != null) {
					if ($this->upload->do_upload('image')) {

						$user = $this->user_model->get($post['user_id'])->row();
						if ($user->image != null) {
							$target_file = './uploads/user/' . $user->image;
							unlink($target_file);
						}

						$post['image'] = $this->upload->data('file_name');
						$this->user_model->edit($post);
						if ($this->db->affected_rows() > 0) {
							$this->session->set_flashdata('success', 'Data saved successfully');
						}
						redirect('user');
					} else {
						$error = $this->upload->display_errors();
						$this->session->set_flashdata('error', $error);
						redirect('user/add');
					}
				} else {
					$post['image'] = null;
					$this->user_model->edit($post);
					if ($this->db->affected_rows() > 0) {
						$this->session->set_flashdata('success', 'Data saved successfully');
					}
					redirect('user');
				}
			}
		}
	}


	public function delete($id)
	{
		$user = $this->user_model->get($id)->row();
		$this->user_model->delete($id);

		if ($this->db->affected_rows() > 0) {
			$target_file = './uploads/user/' . $user->image;
			unlink($target_file);

			$this->session->set_flashdata('success', 'Data deleted successfully');
		}
		echo "<script>window.location='" . site_url('user') . "'</script>";
	}

	public function email_check()
	{
		$post = $this->input->post(null, TRUE);
		$this->db->select('*');
		$this->db->from('user');
		$this->db->where('email', $post['email']);
		$this->db->where('user_id !=', $post['user_id']);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			$this->form_validation->set_message('email_check', 'This {field} has been used, please replace the other one');
			return FALSE;
		} else {
			return TRUE;
		}
	}

	public function profile()
	{
		$this->template->load('template', 'user/profile');
	}
}
