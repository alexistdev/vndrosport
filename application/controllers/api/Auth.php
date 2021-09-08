<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/RestController.php';
use chriskacerguis\RestServer\RestController;

class Auth extends RestController
{

	public $api;
	public $toko;

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_api', 'api');
		$this->load->model('M_toko', 'toko');
	}

	public function index_post()
	{

		$email = $this->post('email');
		$password = $this->post('password');
		if(in_array($email,["",null]) || in_array($password,["",null])){
			$this->response([
				'status' => false,
				'message' => 'Email atau Password yang anda masukkan salah'
			], 404);
		} else {

			$cekLogin = $this->api->validasi_login($email);
			if($cekLogin->num_rows() != 0){
				$dataPass = $cekLogin->row()->password;
				if(password_verify($password,$dataPass)){
					$idUser = $cekLogin->row()->id_user;
					$toko = $this->toko->get_data_toko($idUser)->row()->id;
					$dataSession = [
						'status' => true,
						'id_user' => $idUser,
						'id_toko' => $toko,
						'token' => $cekLogin->row()->remember_token,
						'message' => 'Anda berhasil login',
					];
					$this->response($dataSession,200);
				} else {
					$this->response([
						'status' => false,
						'message' => 'Email atau Password yang anda masukkan salah'
					], 404);
				}
			} else {
				$this->response([
					'status' => false,
					'message' => 'Email belum terdaftar'
				], 404);
			}
		}
	}
}
