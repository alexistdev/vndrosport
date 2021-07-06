<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Member extends CI_Controller
{

	public $session;


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
		$view ='v_member';
		$this->_layout($data,$view);
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect('Login');
	}

}
