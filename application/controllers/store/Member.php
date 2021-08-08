<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Member extends CI_Controller
{

	public $session;


	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_toko', 'toko');
		if ($this->session->userdata('is_login_toko') !== TRUE) {
			redirect('Login');
		}
	}

	private function _layout($data, $view)
	{
		$this->load->view('toko/view/' . $view, $data);
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
