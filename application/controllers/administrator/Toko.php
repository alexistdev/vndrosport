<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Toko extends CI_Controller
{
	public $session;
	public $admin;
	public $form_validation;
	public $input;

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_toko', 'admin');
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
		$data['dataToko'] = $this->admin->get_data_toko()->result_array();
		$view ='v_toko';
		$this->_layout($data,$view);
	}

	public function edit($idx=null)
	{
		$id = decrypt_url($idx);
		$getData = $this->admin->get_detail_toko($id);
		if($idx == '' || $idx == null || $getData->num_rows() == 0) {
			redirect('admin/client');
		} else {
			$this->form_validation->set_rules(
				'namaToko',
				'Nama Toko',
				'trim|required|min_length[3]|max_length[80]',
				[
					'required' => 'Anda harus mengisi nama toko terlebih dahulu!',
					'max_length' => 'Panjang karakter maksimal 80 karakter',
					'min_length' => 'Panjang karakter minimal 3 karakter',
				]
			);
			$this->form_validation->set_rules(
				'emailToko',
				'Email Toko',
				'trim|required|valid_email|max_length[80]',
				[
					'required' => 'Anda harus mengisi nama toko terlebih dahulu!',
					'max_length' => 'Panjang karakter maksimal 80 karakter',
					'valid_email' => 'Gunakan Email yang valid!',
				]
			);
			$this->form_validation->set_rules(
				'telpToko',
				'Telepon Toko',
				'trim|required|min_length[3]|max_length[30]',
				[
					'required' => 'Anda harus mengisi nama toko terlebih dahulu!',
					'max_length' => 'Panjang karakter maksimal 30 karakter',
					'min_length' => 'Panjang karakter minimal 3 karakter',
				]
			);
			$this->form_validation->set_rules(
				'alamatToko',
				'Alamat',
				'trim|required',
				[
					'required' => 'Anda harus mengisi alamat terlebih dahulu!'
				]
			);
			$this->form_validation->set_error_delimiters('<span class="text-danger text-sm" >', '</span>');
			if ($this->form_validation->run() === false) {
				$data = $this->_dataClient($idx, $getData);
				$view = 'v_edittoko';
				$this->_layout($data, $view);
			} else {
				$namaToko = $this->input->post('namaToko', TRUE);
				$emailToko = $this->input->post('emailToko', TRUE);
				$telpToko = $this->input->post('telpToko', TRUE);
				$alamatToko = $this->input->post('alamatToko', TRUE);
				$dataToko = [
					'nama_toko' => $namaToko,
					'email' => $emailToko,
					'telp' => $telpToko,
					'alamat' => $alamatToko,
				];
				$this->admin->perbaharui_toko($dataToko,$id);
				$this->session->set_flashdata('pesan1', '<div class="alert alert-success" role="alert">Data toko berhasil diperbaharui!</div>');
				redirect('admin/toko/edit/'.$idx);
			}
		}

	}

	public function _dataClient($idx,$getData)
	{
		$data=[];
		$data['title'] = _myJudul();
		$data['idToko'] = $idx;
		$data['namaToko'] = $getData->row()->nama_toko;
		$data['emailToko'] = $getData->row()->email;
		$data['telpToko'] = $getData->row()->telp;
		$data['alamatToko'] = $getData->row()->alamat;
		return $data;
	}
}
