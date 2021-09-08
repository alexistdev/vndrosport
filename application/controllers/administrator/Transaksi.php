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

	public function setuju($idx=null)
	{
		$id = decrypt_url($idx);
		$getData = $this->transaksi->get_data_transaksi($id);
		if($idx == '' || $idx == null || $getData->num_rows() == 0) {
			redirect('admin/transaksi');
		} else {
			echo $id;
			$dataStatus = [
				'status' => 3
			];
			$this->transaksi->perbaharui_status($dataStatus,$id);
			$dataDetailStatus = [
				'status' => 2,
			];
			$this->transaksi->perbaharui_status_detail($dataDetailStatus,$id);
			$this->session->set_flashdata('pesan1', '<div class="alert alert-success" role="alert">Pesanan telah dikonfirmasi!</div>');
			redirect('admin/transaksi');
		}
	}

}
