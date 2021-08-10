<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/RestController.php';
use chriskacerguis\RestServer\RestController;

class Akun extends RestController
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
			$getData = $this->api->get_data_akun($idUser);
			if($getData->num_rows() !=0 ){
				foreach($getData->result_array() as $row){
					$data['status'] = true;
					$data['email'] =$row['email'];
					$data['nama_lengkap'] =$row['nama_lengkap'];
					$data['alamat'] =$row['alamat'];
					$data['no_telp'] =$row['notelp'];
					$data['message'] = "Data berhasil didapatkan";
				};
				$this->response($data, 200);
			} else {
				$this->response( [
					'status' => false,
					'message' => 'Not Authorized'
				], 404 );
			}
		} else {
			$this->response( [
				'status' => false,
				'message' => 'Not Authorized'
			], 404 );
		}
	}

	public function index_put()
	{
		$idUser = $this->put('id_user');
		$token = $this->put('token');
		$cekUser = $this->api->cek_user($idUser,$token);
		if($cekUser!= 0){
			$namaLengkap= $this->put('nama_lengkap');
			$noTelp = $this->put('no_telp');
			$alamat = $this->put('alamat');
			$password = $this->put('password');
			if(!empty($password)){
				$dataAkun = [
					'password' => password_hash($password,PASSWORD_BCRYPT),
					'updated_at' => time()
				];
				$dataDetail = [
					'nama_lengkap' => $namaLengkap,
					'notelp' => $noTelp,
					'alamat' => $alamat,
				];
				$this->api->update_akun($dataAkun,$idUser);
				$this->api->update_detail_akun($dataDetail,$idUser);
				$this->response( [
					'status' => true,
					'message' => 'Data berhasil diperbaharui'
				], 200 );
			} else {
				$dataAkun = [
					'updated_at' => time()
				];
				$dataDetail = [
					'nama_lengkap' => $namaLengkap,
					'notelp' => $noTelp,
					'alamat' => $alamat,
				];
				$this->api->update_akun($dataAkun,$idUser);
				$this->api->update_detail_akun($dataDetail,$idUser);
				$this->response( [
					'status' => true,
					'message' => 'Data berhasil diperbaharui'
				], 200 );
			}

		} else {
			$this->response( [
				'status' => false,
				'message' => 'Not Authorized'
			], 404 );
		}
	}
}
