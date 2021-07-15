<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/RestController.php';
use chriskacerguis\RestServer\RestController;

class Produk extends RestController
{

	public $api;

	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_api', 'api');
	}

	public function index_get()
	{
		$getProduk = $this->api->get_data_produk();
		if($getProduk->num_rows() != 0 ){
			$data = [
				'status' => true,
				'result' => $getProduk->result_array(),
				'message' => 'Data berhasil didapatkan',
			];
			$this->response($data, 200);
		} else {
			$this->response( [
				'status' => false,
				'message' => 'No data found'
			], 404 );
		}
	}

	public function detail_get()
	{
		$id = $this->get('id');
		if($id != null || !empty($id)){
			$getDetail = $this->api->get_data_produk($id);
			if($getDetail->num_rows() != 0){
				foreach ($getDetail->result_array() as $row){
					$data['status'] = true;
					$data['nama_toko'] =$row['nama_toko'];
					$data['nama_kategori'] =$row['nama_kategori'];
					$data['nama_merek'] =$row['nama_merek'];
					$data['id'] =$row['id'];
					$data['nama_produk'] =$row['nama_produk'];
					$data['harga'] =$row['harga'];
					$data['gambar'] =$row['gambar'];
					$data['ukuran'] =$row['ukuran'];
					$data['warna'] =$row['warna'];
					$data['deskripsi'] =$row['deskripsi'];
				}
				$this->response($data, 200);
			} else {
				$this->response( [
					'status' => false,
					'message' => 'No data found'
				], 404 );
			}
		} else {
			$this->response( [
				'status' => false,
				'message' => 'No data found'
			], 404 );
		}

	}

}
