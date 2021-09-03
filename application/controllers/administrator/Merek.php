<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Merek extends CI_Controller
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
		$data['dataMerek'] = $this->admin->get_data_merek()->result_array();
		$view ='v_merek';
		$this->_layout($data,$view);
	}

	public function add()
	{
		$this->form_validation->set_rules(
			'nmMerek',
			'Nama Merek',
			'trim|required|max_length[255]|min_length[3]',
			[
				'required' => 'Nama Merek wajib untuk diisi!',
				'max_length' => 'Panjang karakter maksimal 255 karakter!',
				'min_length' => 'Panjang karakter  minimal 3 karakter!'
			]
		);
		$this->form_validation->set_error_delimiters('<span class="text-danger text-sm" >', '</span>');
		if ($this->form_validation->run() === false) {
			$data['title'] = _myJudul();
			$data['tag'] = 'add';
			$view = 'v_tambahmerek';
			$this->_layout($data, $view);
		}else{
			$namaMerek = $this->input->post('nmMerek', TRUE);
			$dataMerek = [
				'nama_merek' => $namaMerek,
			];
			$this->admin->simpan_merek($dataMerek);
			$this->session->set_flashdata('pesan1', '<div class="alert alert-success" role="alert">Data kategori berhasil ditambahkan!</div>');
			redirect('admin/merek');
		}
	}

	public function hapus($idx=null)
	{
		$id = decrypt_url($idx);
		if (in_array($id,["",null]) || $id == '') {
			redirect('admin/merek');
		} else {
			$this->admin->hapus_merek($id);
			$this->session->set_flashdata('pesan1', '<div class="alert alert-danger" role="alert">Data Merek berhasil dihapus!</div>');
			redirect('admin/merek');
		}
	}

	public function edit($idx=null)
	{
		$id = decrypt_url($idx);
		if ($idx == '' || $idx == null || $id == '') {
			redirect('admin/kategori');
		} else {
			$getData = $this->admin->get_data_merek($id);
			$this->form_validation->set_rules(
				'nmMerek',
				'Nama Merek',
				'trim|required|max_length[255]|min_length[3]',
				[
					'required' => 'Nama Merek wajib untuk diisi!',
					'max_length' => 'Panjang karakter maksimal 255 karakter!',
					'min_length' => 'Panjang karakter  minimal 3 karakter!'
				]
			);
			$this->form_validation->set_error_delimiters('<span class="text-danger text-sm" >', '</span>');
			if ($this->form_validation->run() === false) {
				$data['title'] = _myJudul();
				$data['tag'] = 'edit';
				$data['id'] = encrypt_url($id);
				$data['namaMerek'] = $getData->row()->nama_merek;
				$view = 'v_tambahmerek';
				$this->_layout($data, $view);
			} else {
				$namaMerek = $this->input->post('nmMerek', TRUE);
				$dataMerek = [
					'nama_merek' => $namaMerek,
				];
				$this->admin->update_data_merek($dataMerek,$id);
				$this->session->set_flashdata('pesan1', '<div class="alert alert-success" role="alert">Data merek berhasil diperbaharui!</div>');
				redirect('admin/merek/edit/'.encrypt_url($id));
			}
		}
	}
}
