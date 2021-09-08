<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Client extends CI_Controller
{
	public $session;
	public $admin;
	public $form_validation;
	public $input;
	public $toko;

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_admin', 'admin');
		$this->load->model('M_toko', 'toko');
		$this->load->helper('email');
		if ($this->session->userdata('is_login_admin') !== TRUE) {
			redirect('admin/login');
		}
	}

	private function _layout($data, $view)
	{
		$this->load->view('admin/view/' . $view, $data);
	}

	public function index()
	{
		$data['title'] = _myJudul();
		$data['dataClient'] = $this->admin->get_detail_data_user()->result_array();
		$view ='v_client';
		$this->_layout($data,$view);
	}

	public function detail($idx=null)
	{
		$id = decrypt_url($idx);
		$getData = $this->admin->get_detail_data_user($id);
		if($idx == '' || $idx == null || $getData->num_rows() == 0) {
			redirect('admin/client');
		} else {
			$data = $this->_dataClient($id);
			$view ='v_detailclient';
			$this->_layout($data,$view);
		}
	}

	public function _dataClient($id)
	{
		$data=[];
		$data['title'] = _myJudul();
		$data['idStaff'] = $id;
		$getData = $this->admin->get_detail_data_user($id)->row();
		$data['namaLengkap'] = $getData->nama_lengkap;
		$data['dataEmail'] = $getData->email;
		$data['dataTelp'] = $getData->notelp;
		$data['dataAlamat'] = $getData->alamat;
		return $data;
	}

	public function add()
	{
		$this->form_validation->set_rules(
			'email',
			'Email',
			'trim|required|max_length[255]|valid_email',
			[
				'required' => 'Email harus diisi terlebih dahulu!',
				'max_length' => 'Panjang karakter maksimal 255 karakter!',
				'valid_email' => 'Email tidak valid silahkan gunakan email yang valid!'
			]
		);
		$this->form_validation->set_rules(
			'password',
			'Password',
			'trim|required|max_length[16]|min_length[6]',
			[
				'required' => 'Password harus diisi terlebih dahulu!',
				'max_length' => 'Panjang password maksimal 16 karakter!',
				'min_length' => 'Panjang password  minimal 6 karakter!'
			]
		);
		$this->form_validation->set_rules(
			'namaLengkap',
			'namaLengkap',
			'trim|max_length[100]',
			[
				'max_length' => 'Panjang karakter maksimal 255 karakter!'
			]
		);
		$this->form_validation->set_rules(
			'noTelp',
			'Nomor Telepon',
			'trim|max_length[30]',
			[
				'max_length' => 'Panjang karakter maksimal 30 karakter!'
			]
		);
		$this->form_validation->set_error_delimiters('<span class="text-danger text-sm" >', '</span>');
		if ($this->form_validation->run() === false) {
			$data['title'] = _myJudul();
			$view = 'v_tambahclient';
			$this->_layout($data, $view);
		}else{
			$email = $this->input->post('email', TRUE);
			$password = password_hash($this->input->post('password', TRUE),PASSWORD_BCRYPT);
			$namaLengkap = $this->input->post('namaLengkap', TRUE);
			$noTelp = $this->input->post('noTelp', TRUE);
			// tambah di tabel user
			$dataUser = [
				'email' => $email,
				'password' => $password,
				'remember_token' => angkaUnik(10),
				'created_at' => time(),
				'updated_at' => time()
			];
			$idUser = $this->admin->simpan_user($dataUser);
			// tambah di tabel detail user
			$dataDetail = [
				'nama_lengkap' => $namaLengkap,
				'notelp' => $noTelp,
				'id_user' => $idUser
			];
			$this->admin->simpan_detail_user($dataDetail);
			//tambah di tabel  toko.
			$dataToko = [
				'nama_toko' => $namaLengkap,
				'email' => $email,
				'telp' => $noTelp,
				'id_user' => $idUser,
				'last_online' => time(),
			];
			$this->toko->simpan_toko($dataToko);
			$this->session->set_flashdata('pesan1', '<div class="alert alert-success" role="alert">Data client berhasil ditambahkan!</div>');
			redirect('admin/client');
		}
	}

	public function hapus($idx=null)
	{
		$id = decrypt_url($idx);
		if (in_array($id,["",null]) || $id == '') {
			redirect('admin/client');
		} else {
			$this->admin->hapus_client($id);
			$this->session->set_flashdata('pesan1', '<div class="alert alert-danger" role="alert">Data client berhasil dihapus!</div>');
			redirect('admin/client');
		}
	}
}
