<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Setting extends CI_Controller
{

	public $session;


	/**
	 * Aplikasi Daihatsu
	 * Dikembangkan oleh: AlexistDev
	 * web: www.alexistdev.com
	 * contact: alexistdev@gmail.com
	 * hp : 082371408678
	 */

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
		$view ='v_setting';
		$this->_layout($data,$view);
	}
}