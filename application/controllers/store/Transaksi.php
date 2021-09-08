<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi extends CI_Controller
{
	public $session;
	public $toko;
	public $form_validation;
	public $input;
	public $transaksi;


	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_toko', 'toko');
		$this->load->model('M_transaksi_toko', 'transaksi');
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
		$data['dataTransaksi'] = $this->transaksi->get_data_pesanan($idToko)->result_array();
		$view ='v_transaksi';
		$this->_layout($data,$view);
	}

	public function konfirm($id=null,$idPesanan=null)
	{

		//cek jumlah id pesanan dulu berdasarkan id pesanan, jika sudah terkirim semua , maka status di pesanan akan dirubah
		$getData = $this->transaksi->get_data_pesanan3($idPesanan);
		if($getData->num_rows() != 0){
			//menghitung jumlah produk yang ada di pesanan
			$jumlahProduk = $getData->num_rows();
			$dataStatus = [
				'status' => 3
			];
			$this->transaksi->perbaharui_status_pesanan($dataStatus,$id);
			//mendapatkan status selesai dari semua toko(status = 3) , jika sama dengan jumlah produk maka status di pesanan di perbaharui
			$StatusSelesai = $this->transaksi->get_data_pesanan2($idPesanan)->num_rows();
			if($jumlahProduk == $StatusSelesai){
				//update status produk semua
				$dataUtama = [
					'status' => 4,
				];
				$this->transaksi->perbaharui_pesanan($dataUtama,$idPesanan);
			}
			$this->session->set_flashdata('pesan1', '<div class="alert alert-success" role="alert">Data pesanan berhasil diperbaharui!</div>');
			redirect('store/transaksi');
		} else {
			redirect('store/transaksi');
		}

	}
}
