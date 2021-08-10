<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/RestController.php';
use chriskacerguis\RestServer\RestController;

class Auth extends RestController
{

	public $api;

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_api', 'api');
	}

	public function index_post()
	{
		$email = $this->post('email');
		if(in_array($email,["",null])){
			$this->response([
				'status' => false,
				'message' => 'Email atau Password yang anda masukkan salah'
			], 404);
		} else {
			$password = $this->post('password');
			$cekLogin = $this->api->validasi_login($email)->row();
			if(!password_verify($password, $cekLogin->password)){
				$this->response([
					'status' => false,
					'message' => 'Email atau Password yang anda masukkan salah'
				], 404);
			} else {
				$dataSession = [
					'status' => true,
					'id_user' => $cekLogin->id_user,
					'token' => $cekLogin->remember_token,
					'message' => 'Anda berhasil login',
				];
				$this->response($dataSession,200);
			}
		}
	}
}
