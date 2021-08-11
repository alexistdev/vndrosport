<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/RestController.php';
use chriskacerguis\RestServer\RestController;

class Daftar extends RestController
{

	public $form_validation;
	public $api;

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_api', 'api');
	}

	public function index_post()
	{
		$this->form_validation->set_rules(
			'email',
			'Email',
			'trim|required|max_length[255]|valid_email',
		);
		$this->form_validation->set_rules(
			'password',
			'Password',
			'trim|max_length[255]|required',
		);
		$this->form_validation->set_rules(
			'nama_lengkap',
			'Nama Lengkap',
			'trim|max_length[100]|required',
		);
		$this->form_validation->set_rules(
			'no_telp',
			'Nomor Telepon',
			'trim|max_length[30]|required',
		);
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger" role="alert">', '</div>');
		if ($this->form_validation->run() === false) {
			$this->response( [
				'status' => false,
				'message' => 'Data tidak lengkap',
			], 404 );
		} else {
			$email = $this->post('email');
			$cekEmail = $this->api->cek_email($email);
			if($cekEmail->num_rows() != 0){
				$this->response( [
					'status' => false,
					'message' => 'Email sudah terdaftar!',
				], 404 );
			} else {
				$password = $this->post('password');
				$namaLengkap = $this->post('nama_lengkap');
				$noTelp = $this->post('no_telp');
				$dataAkun = array(
					'email' => $email,
					'password' => password_hash($password,PASSWORD_BCRYPT),
					'remember_token' => angkaUnik(),
					'created_at' => time(),
					'updated_at' => time(),
				);
				$idUser  = $this->api->simpan_user($dataAkun);
				$dataDetail = array(
					'id_user' => $idUser,
					'nama_lengkap' => $namaLengkap,
					'notelp' => $noTelp,
					'alamat' => null,
					'desa' => null,
					'kecamatan' => null,
					'kabupaten' => null,
					'provinsi' => null,
				);
				$this->api->simpan_detail_user($dataDetail);
				$this->response( [
					'status' => true,
					'message' => 'Data berhasil disimpan',
				], 200 );
			}
		}
	}

}
