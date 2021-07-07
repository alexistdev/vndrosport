<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Provinsi extends CI_Controller
{
	public $session;
	public $admin;
	public $form_validation;
	public $input;

	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_admin', 'admin');
		if ($this->session->userdata('is_login_admin') !== TRUE) {
			redirect('Login');
		}
	}

	private function _layout($data, $view)
	{
		$this->load->view('admin/view/' . $view, $data);
	}

	public function index()
	{
		$data['title'] = _myJudul();
		$data['dataProvinsi'] = $this->admin->get_data_provinsi()->result_array();
		$view ='v_provinsi';
		$this->_layout($data,$view);
	}

	public function add()
	{
		$this->form_validation->set_rules(
			'namaNegara',
			'Negara',
			'trim|required',
			[
				'required' => 'Anda harus memilih negara terlebih dahulu!'
			]
		);
		$this->form_validation->set_rules(
			'namaProvinsi',
			'Provinsi',
			'trim|required|max_length[80]|min_length[3]',
			[
				'required' => 'Nama Provinsi wajib untuk diisi!',
				'max_length' => 'Panjang karakter maksimal 80 karakter!',
				'min_length' => 'Panjang karakter  minimal 3 karakter!'
			]
		);
		$this->form_validation->set_error_delimiters('<span class="text-danger text-sm" >', '</span>');
		if ($this->form_validation->run() === false) {
			$data['title'] = _myJudul();
			$data['tag'] = 'add';
			$data['optDataNegara'] = "";
			$data['dataNegara'] = $this->admin->get_data_negara()->result_array();
			$view = 'v_tambahprovinsi';
			$this->_layout($data, $view);
		}else{
			$idNegara = $this->input->post('namaNegara', TRUE);
			$namaProvinsi = strtolower($this->input->post('namaProvinsi', TRUE));
			$dataProvinsi = [
				'id_negara' => $idNegara,
				'nama_provinsi' => $namaProvinsi,
				'created_at' => time(),
				'updated_at' => time()
			];
			$this->admin->simpan_provinsi($dataProvinsi);
			$this->session->set_flashdata('pesan1', '<div class="alert alert-success" role="alert">Data provinsi berhasil ditambahkan!</div>');
			redirect('admin/provinsi');
		}
	}

	public function hapus($idx=null)
	{
		$id = decrypt_url($idx);
		if ($idx == '' || $idx == null || $id == '') {
			redirect('admin/provinsi');
		} else {
			$this->admin->hapus_provinsi($id);
			$this->session->set_flashdata('pesan1', '<div class="alert alert-danger" role="alert">Data provinsi berhasil dihapus!</div>');
			redirect('admin/provinsi');
		}
	}

	public function edit($idx=null)
	{
		$id = decrypt_url($idx);
		if ($idx == '' || $idx == null || $id == '') {
			redirect('admin/provinsi');
		} else {
			$getData = $this->admin->get_data_provinsi($id);
			if($getData->num_rows() != 0 ){
				$this->form_validation->set_rules(
					'namaNegara',
					'Negara',
					'trim|required',
					[
						'required' => 'Anda harus memilih negara terlebih dahulu!'
					]
				);
				$this->form_validation->set_rules(
					'namaProvinsi',
					'Provinsi',
					'trim|required|max_length[80]|min_length[3]',
					[
						'required' => 'Nama Provinsi wajib untuk diisi!',
						'max_length' => 'Panjang karakter maksimal 80 karakter!',
						'min_length' => 'Panjang karakter  minimal 3 karakter!'
					]
				);
				$this->form_validation->set_error_delimiters('<span class="text-danger text-sm" >', '</span>');
				if ($this->form_validation->run() === false) {
					$data['title'] = _myJudul();
					$data['tag'] = 'edit';
					$data['idProvinsi'] = encrypt_url($id);
					$data['optDataNegara'] = $getData->row()->id_negara;
					$data['dataNegara'] = $this->admin->get_data_negara()->result_array();
					$data['dataProvinsi'] = $getData->row()->nama_provinsi;
					$view = 'v_tambahprovinsi';
					$this->_layout($data, $view);
				} else {
					$idNegara = $this->input->post('namaNegara', TRUE);
					$namaProvinsi = strtolower($this->input->post('namaProvinsi', TRUE));
					$dataProvinsi = [
						'id_negara' => $idNegara,
						'nama_provinsi' => $namaProvinsi,
						'updated_at' => time()
					];
					$this->admin->update_data_provinsi($dataProvinsi,$id);
					$this->session->set_flashdata('pesan1', '<div class="alert alert-success" role="alert">Data provinsi berhasil diperbaharui!</div>');
					redirect('admin/provinsi/edit/'.encrypt_url($id));
				}
			} else {
				redirect('admin/provinsi');
			}
		}
	}
}
