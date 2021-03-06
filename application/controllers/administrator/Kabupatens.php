<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kabupatens extends CI_Controller
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
		$data['dataKabupaten'] = $this->admin->get_data_kabupaten()->result_array();
		$view ='v_kabupaten';
		$this->_layout($data,$view);

	}

	public function add()
	{
		$this->form_validation->set_rules(
			'namaProvinsi',
			'Provinsi',
			'trim|required',
			[
				'required' => 'Anda harus memilih provinsi terlebih dahulu!'
			]
		);
		$this->form_validation->set_rules(
			'namaKabupaten',
			'Provinsi',
			'trim|required|max_length[80]|min_length[3]',
			[
				'required' => 'Nama Kabupaten wajib untuk diisi!',
				'max_length' => 'Panjang karakter maksimal 80 karakter!',
				'min_length' => 'Panjang karakter  minimal 3 karakter!'
			]
		);
		$this->form_validation->set_error_delimiters('<span class="text-danger text-sm" >', '</span>');
		if ($this->form_validation->run() === false) {
			$data['title'] = _myJudul();
			$data['tag'] = 'add';
			$data['optDataProvinsi'] = "";
			$data['dataProvinsi'] = $this->admin->get_data_provinsi()->result_array();
			$view = 'v_tambahkabupaten';
			$this->_layout($data, $view);
		}else{
			$idProvinsi = $this->input->post('namaProvinsi', TRUE);
			$namaKabupaten = strtolower($this->input->post('namaKabupaten', TRUE));
			$dataKabupaten = [
				'id_provinsi' => $idProvinsi,
				'nama_kabupaten' => $namaKabupaten,
				'created_at' => time(),
				'updated_at' => time()
			];
			$this->admin->simpan_kabupaten($dataKabupaten);
			$this->session->set_flashdata('pesan1', '<div class="alert alert-success" role="alert">Data kabupaten berhasil ditambahkan!</div>');
			redirect('admin/kabupaten');
		}
	}

	public function hapus($idx=null)
	{
		$id = decrypt_url($idx);
		if ($idx == '' || $idx == null || $id == '') {
			redirect('admin/kabupaten');
		} else {
			$getData = $this->admin->get_data_kabupaten($id);
			if($getData->num_rows() != 0 ){
				$this->admin->hapus_kabupaten($id);
				$this->session->set_flashdata('pesan1', '<div class="alert alert-danger" role="alert">Data kabupaten berhasil dihapus!</div>');
				redirect('admin/kabupaten');
			} else {
				redirect('admin/kabupaten');
			}
		}
	}

	public function edit($idx=null)
	{
		$id = decrypt_url($idx);
		if ($idx == '' || $idx == null || $id == '') {
			redirect('admin/kabupaten');
		} else {
			$getData = $this->admin->get_data_kabupaten($id);
			if($getData->num_rows() != 0 ){
				$this->form_validation->set_rules(
					'namaProvinsi',
					'Provinsi',
					'trim|required',
					[
						'required' => 'Anda harus memilih provinsi terlebih dahulu!'
					]
				);
				$this->form_validation->set_rules(
					'namaKabupaten',
					'Provinsi',
					'trim|required|max_length[80]|min_length[3]',
					[
						'required' => 'Nama Kabupaten wajib untuk diisi!',
						'max_length' => 'Panjang karakter maksimal 80 karakter!',
						'min_length' => 'Panjang karakter  minimal 3 karakter!'
					]
				);
				$this->form_validation->set_error_delimiters('<span class="text-danger text-sm" >', '</span>');
				if ($this->form_validation->run() === false) {
					$data['title'] = _myJudul();
					$data['tag'] = 'edit';
					$data['idKabupaten'] = encrypt_url($id);
					$data['optDataProvinsi'] = $getData->row()->id_provinsi;
					$data['dataKabupaten'] = $getData->row()->nama_kabupaten;
					$data['dataProvinsi'] = $this->admin->get_data_provinsi()->result_array();
					$view = 'v_tambahkabupaten';
					$this->_layout($data, $view);
				}else{
					$idProvinsi = $this->input->post('namaProvinsi', TRUE);
					$namaKabupaten = strtolower($this->input->post('namaKabupaten', TRUE));
					$dataKabupaten = [
						'id_provinsi' => $idProvinsi,
						'nama_kabupaten' => $namaKabupaten,
						'updated_at' => time()
					];
					$this->admin->update_data_kabupaten($dataKabupaten,$id);
					$this->session->set_flashdata('pesan1', '<div class="alert alert-success" role="alert">Data kabupaten berhasil diperbaharui!</div>');
					redirect('admin/kabupaten/edit/'.encrypt_url($id));
				}

			} else {
				redirect('admin/kabupaten');
			}
		}
	}
}
