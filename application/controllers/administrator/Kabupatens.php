<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kabupatens extends CI_Controller
{
	public $session;
	public $admin;
	public $form_validation;
	public $input;

	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_admin', 'admin');
		if ($this->session->userdata('is_login_admin') !== TRUE) {
			redirect('Login');
		}
	}

	private function _layout($data, $view)
	{
		$this->load->view('admin/view/' . $view, $data);
	}

	public function index()
	{
		$data['title'] = _myJudul();
		$data['dataKabupaten'] = $this->admin->get_data_kabupaten()->result_array();
		$view ='v_kabupaten';
		$this->_layout($data,$view);
//		echo json_encode($data['dataKabupaten']);
	}
}
