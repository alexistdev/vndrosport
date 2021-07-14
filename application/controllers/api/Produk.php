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
				$data = [
					'status' => true,
					'result' => $getDetail->result_array(),
					'message' => 'Data berhasil didapatkan',
				];
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
