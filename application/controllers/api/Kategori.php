<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/RestController.php';
use chriskacerguis\RestServer\RestController;

class Kategori extends RestController
{
	public $api;

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_api', 'api');
	}

	public function index_get()
	{
		$idUser = $this->get('id_user');
		$token = $this->get('token');
		$cekUser = $this->api->cek_user($idUser,$token);
		if($cekUser!= 0){
			$getData = $this->api->get_data_kategori();
			$dataResponse = [
				'status' => true,
				'result' => $getData->result_array(),
				'message' => 'Data berhasil didapatkan !',
			];
			$this->response($dataResponse, 200);
		} else {
			$this->response( [
				'status' => false,
				'message' => 'Not Authorized'
			], 404 );
		}
	}
}
