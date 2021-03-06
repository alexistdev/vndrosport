<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/RestController.php';
use chriskacerguis\RestServer\RestController;

class Spesial extends RestController
{

	public $api;

	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_api', 'api');
	}


	public function index_get()
	{
		$getSpesial = $this->api->get_data_spesial(true);
		if($getSpesial->num_rows() != 0 ){
			$data = [
				'status' => true,
				'result' => $getSpesial->result_array(),
				'message' => 'Data berhasil didapatkan',
			];
			$this->response($data, 200);
		}else {
			$this->response( [
				'status' => false,
				'message' => 'No data found'
			], 404 );
		}
	}
}
