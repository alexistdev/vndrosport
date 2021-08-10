<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/RestController.php';
use chriskacerguis\RestServer\RestController;

class Pesanan extends RestController
{

	public $api;

	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_api', 'api');
	}

	public function index_get()
	{
		$idUser = $this->get('id_user');
		$myToken = $this->get('token');
		$cekUser = $this->api->cek_user($idUser,$myToken);
		if($cekUser != 0){
			$getData = $this->api->get_data_pesanan($idUser);
			$data = [
				'status' => true,
				'result' => $getData->result_array(),
				'message' => 'Data berhasil didapatkan',
			];
			$this->response($data, 200);
		} else {
			$this->response( [
				'status' => false,
				'message' => 'Not Authorized'
			], 404 );
		}
	}


}
