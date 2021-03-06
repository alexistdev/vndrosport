<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produk extends CI_Controller
{
	public $session;
	public $produk;
	public $form_validation;
	public $input;

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_produk', 'produk');
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
		$data['dataProduk'] = $this->produk->get_data_produk()->result_array();
		$view = 'v_produk';
		$this->_layout($data, $view);
	}
}
