<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Setting extends CI_Controller
{

	public $session;
	public $form_validation;
	public $input;
	public $admin;

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_admin', 'admin');
		if ($this->session->userdata('is_login_admin') !== TRUE) {
			redirect('admin/login');
		}
	}

	private function _layout($data, $view)
	{
		$this->load->view('admin/view/' . $view, $data);
	}

	public function index()
	{
		$this->form_validation->set_rules(
			'password1',
			'Password',
			'trim|required|min_length[6]|max_length[16]',
			[
				'required' => 'Anda harus mengisi password terlebih dahulu!',
				'max_length' => 'Panjang karakter maksimal 16 karakter',
				'min_length' => 'Panjang karakter minimal 6 karakter',
			]
		);
		$this->form_validation->set_rules(
			'password2',
			'Password',
			'trim|matches[password1]',
			[
				'required' => 'Anda harus mengisi password terlebih dahulu!',
				'matches' => 'Password tidak sama!',
			]
		);
		$this->form_validation->set_error_delimiters('<span class="text-danger text-sm" >', '</span>');
		if ($this->form_validation->run() === false) {
			$data['title'] = _myJudul();
			$view = 'v_setting';
			$this->_layout($data, $view);
		} else {
			$password1 = $this->input->post('password1', TRUE);
			$dataAdmin = [
				'password' => password_hash($password1,PASSWORD_BCRYPT),
			];
			$this->admin->perbaharui_admin($dataAdmin);
			$this->session->set_flashdata('pesan1', '<div class="alert alert-success" role="alert">Password berhasil diperbaharui!</div>');
			redirect('admin/setting/');
		}
	}
}
