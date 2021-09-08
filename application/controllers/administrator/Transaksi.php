<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi extends CI_Controller
{
	public $session;
	public $transaksi;
	public $form_validation;
	public $input;

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_transaksi', 'transaksi');
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
		$data['dataTransaksi'] = $this->transaksi->get_data_transaksi()->result_array();
		$view = 'v_transaksi';
		$this->_layout($data, $view);
	}
}
