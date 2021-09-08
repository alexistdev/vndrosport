<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/RestController.php';
use chriskacerguis\RestServer\RestController;

class Bayar extends RestController
{
	public $api;

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_api', 'api');
	}

	public function index_get()
	{
		$idPesanan = $this->get('id_pesanan');
		if(in_array($idPesanan,["",null])){
			$this->response([
				'status' => false,
				'message' => 'Data tidak lengkap'
			], 404);
		} else {
			$getData = $this->api->get_data_pesanan2($idPesanan);
			if($getData->num_rows() != 0){
				$dataPesanan =  [
					'status' => 2
				];
				$this->api->perbaharui_pesanan($dataPesanan,$idPesanan);
				$this->response([
					'status' => true,
					'message' => 'Data pesanan berhasil diupdate'
				], 200);
			} else {
				$this->response([
					'status' => false,
					'message' => 'Data tidak ada'
				], 404);
			}
		}
	}

}
