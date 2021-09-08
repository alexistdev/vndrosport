<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/RestController.php';
use chriskacerguis\RestServer\RestController;

class Produk extends RestController
{

	public $api;
	public $form_validation;
	public $input;

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_api', 'api');
		$this->load->library('form_validation');
	}

	private function _configRules()
	{
		$config = [
			[
				'field' => 'id_toko',
				'label' => 'Id Toko',
				'rules' => 'trim|required',
			],
		];
		return $config;
	}

	public function index_get()
	{
		$this->form_validation->set_data($this->input->get());
		$this->form_validation->set_rules($this->_configRules());
		if($this->form_validation->run()==FALSE){
			$data = [
				'status' => false,
				'message' => 'Data tidak lengkap',
			];
			$this->response($data, 404);
		} else {
			$idToko = $this->get('id_toko',TRUE);
			$getProduk = $this->api->get_data_produk($idToko);
			if ($getProduk->num_rows() != 0) {
				$data = [
					'status' => true,
					'result' => $getProduk->result_array(),
					'message' => 'Data berhasil didapatkan',
				];
				$this->response($data, 200);
			} else {
				$this->response([
					'status' => false,
					'message' => 'No data found'
				], 404);
			}
		}
	}

	public function detail_get()
	{
		$id = $this->get('id');
		if($id != null || !empty($id)){
			$getDetail = $this->api->get_data_produk3($id);
			if($getDetail->num_rows() != 0){
				foreach ($getDetail->result_array() as $row){
					$data['status'] = true;
					$data['nama_toko'] =$row['nama_toko'];
					$data['last_online'] =$row['last_online'];
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
