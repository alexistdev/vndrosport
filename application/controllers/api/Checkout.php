<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/RestController.php';
use chriskacerguis\RestServer\RestController;

class Checkout extends RestController
{

	public $api;

	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_api', 'api');
	}

	public function index_post()
	{
		$idUser = $this->post('id_user');
		$myToken = $this->post('token');
		$cekUser = $this->api->cek_user($idUser,$myToken);
		if($cekUser!= 0){
			$dataKeranjang = $this->api->get_data_keranjang($idUser);
			if($dataKeranjang->num_rows() != 0){
				$idKeranjang = $dataKeranjang->row()->id;
				$judul = $this->api->get_judul_keranjang($idKeranjang)->row()->nama_produk;
				//memindahkan ke tabel pesanan
				$dataPesanan = [
					'id_user' => $idUser,
					'judul' => $judul,
					'tanggal' => time(),
					'sub_total' => $dataKeranjang->row()->sub_total,
					'biaya_antar' => 20000,
					'total_jumlah' => $dataKeranjang->row()->total_biaya,
					'status' => 1,
				];
				$idPesanan = $this->api->simpan_pesanan($dataPesanan);
				//simpan ke tabel detail_pesanan
				$idKeranjang = $dataKeranjang->row()->id;
				$dataKeranjang = $this->api->get_data_detailpesanan($idKeranjang);
				foreach($dataKeranjang->result_array() as $row) {
					$dataDetailPesanan = [
						'id_pesanan' => $idPesanan,
						'id_produk' => $row['id_produk'],
						'jumlah' => $row['jumlah'],
						'sub_total' => $row['m_sub_total'],
					];
					$this->api->simpan_detailpesanan($dataDetailPesanan);
				}
				//menghapus data di total_keranjang
				$this->api->hapus_totalkeranjang($idUser);
				//menghapus data di keranjang
				$this->api->hapus_keranjang($idKeranjang);
				$dataResponse = [
					'status' => true,
					'message' => 'Data berhasil disimpan !'
				];
				$this->response($dataResponse, 200);

			} else {
				$this->response( [
					'status' => false,
					'message' => 'No data found'
				], 404 );
			}
		} else {
			$this->response( [
				'status' => false,
				'message' => 'Not Authorized'
			], 404 );
		}
	}

}
