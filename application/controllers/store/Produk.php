<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produk extends CI_Controller
{
	public $session;
	public $toko;


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
		$data['title'] = _store();
		$idUser = $this->session->userdata('id_user');
		$idToko = $this->toko->get_data_toko($idUser)->row()->id;
		$data['dataProduk'] = $this->toko->get_data_produk($idToko)->result_array();

		$view ='v_produk';
		$this->_layout($data,$view);
	}

}
