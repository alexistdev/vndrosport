<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Toko extends CI_Controller
{
	public $session;
	public $admin;
	public $form_validation;
	public $input;

	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_toko', 'admin');
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
		$data['title'] = _myJudul();
		$data['dataToko'] = $this->admin->get_data_toko()->result_array();
		$view ='v_toko';
		$this->_layout($data,$view);
	}
}
