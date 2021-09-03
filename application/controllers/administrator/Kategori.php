<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori extends CI_Controller
{
	public $session;
	public $admin;
	public $form_validation;
	public $input;

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_admin', 'admin');
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
		$data['dataKategori'] = $this->admin->get_data_kategori()->result_array();
		$view ='v_kategori';
		$this->_layout($data,$view);
	}

	public function add()
	{
		$this->form_validation->set_rules(
			'nmKategori',
			'Nama Kategori',
			'trim|required|max_length[128]|min_length[3]',
			[
				'required' => 'Nama Kategori wajib untuk diisi!',
				'max_length' => 'Panjang karakter maksimal 128 karakter!',
				'min_length' => 'Panjang karakter  minimal 3 karakter!'
			]
		);
		$this->form_validation->set_error_delimiters('<span class="text-danger text-sm" >', '</span>');
		if ($this->form_validation->run() === false) {
			$data['title'] = _myJudul();
			$data['tag'] = 'add';
			$view = 'v_tambahkategori';
			$this->_layout($data, $view);
		}else{
			$namaKategori = $this->input->post('nmKategori', TRUE);
			$dataKategori = [
				'nama_kategori' => $namaKategori,
			];
			$this->admin->simpan_kategori($dataKategori);
			$this->session->set_flashdata('pesan1', '<div class="alert alert-success" role="alert">Data kategori berhasil ditambahkan!</div>');
			redirect('admin/kategori');
		}
	}

	public function hapus($idx=null)
	{
		$id = decrypt_url($idx);
		if (in_array($id,["",null]) || $id == '') {
			redirect('admin/kategori');
		} else {
			$this->admin->hapus_kategori($id);
			$this->session->set_flashdata('pesan1', '<div class="alert alert-danger" role="alert">Data kategori berhasil dihapus!</div>');
			redirect('admin/kategori');
		}
	}

	public function edit($idx=null)
	{
		$id = decrypt_url($idx);
		if ($idx == '' || $idx == null || $id == '') {
			redirect('admin/kategori');
		} else {
			$getData = $this->admin->get_data_kategori($id);
			$this->form_validation->set_rules(
				'nmKategori',
				'Nama Kategori',
				'trim|required|max_length[128]|min_length[3]',
				[
					'required' => 'Nama Kategori wajib untuk diisi!',
					'max_length' => 'Panjang karakter maksimal 128 karakter!',
					'min_length' => 'Panjang karakter  minimal 3 karakter!'
				]
			);
			$this->form_validation->set_error_delimiters('<span class="text-danger text-sm" >', '</span>');
			if ($this->form_validation->run() === false) {
					$data['title'] = _myJudul();
					$data['tag'] = 'edit';
					$data['id'] = encrypt_url($id);

					$data['namaKategori'] = $getData->row()->nama_kategori;
					$view = 'v_tambahkategori';
					$this->_layout($data, $view);
			} else {
					$namaKategori = $this->input->post('nmKategori', TRUE);
					$dataKategori = [
						'nama_kategori' => $namaKategori,
					];
					$this->admin->update_data_kategori($dataKategori,$id);
					$this->session->set_flashdata('pesan1', '<div class="alert alert-success" role="alert">Data kategori berhasil diperbaharui!</div>');
					redirect('admin/kategori/edit/'.encrypt_url($id));
			}
		}
	}
}
