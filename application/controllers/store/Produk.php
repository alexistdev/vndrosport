<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produk extends CI_Controller
{
	public $session;
	public $toko;
	public $form_validation;
	public $input;
	public $upload;


	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_toko', 'toko');
		if ($this->session->userdata('is_login_toko') !== TRUE) {
			redirect('Login');
		}
	}

	private function _layout($data, $view)
	{
		$this->load->view('toko/view/' . $view, $data);
	}

	public function index()
	{
		$data['title'] = _store();
		$idUser = $this->session->userdata('id_user');
		$idToko = $this->toko->get_data_toko($idUser)->row()->id;
		$data['dataProduk'] = $this->toko->get_data_produk($idToko)->result_array();
		$view ='v_produk';
		$this->_layout($data,$view);
	}

	public function add()
	{
		$this->form_validation->set_rules(
			'namaKategori',
			'Provinsi',
			'trim|max_length[11]|required',
			[
				'max_length' => 'Anda harus memilih Kategori terlebih dahulu!',
				'required' => 'Anda harus memilih Kategori terlebih dahulu!'
			]
		);
		$this->form_validation->set_rules(
			'namaMerek',
			'Merek',
			'trim|max_length[11]|required',
			[
				'max_length' => 'Anda harus memilih Merek terlebih dahulu!',
				'required' => 'Anda harus memilih Merek terlebih dahulu!'
			]
		);
		$this->form_validation->set_rules(
			'namaProduk',
			'Nama Produk',
			'trim|max_length[80]|required',
			[
				'max_length' => 'Panjang karakter nama produk adalah 80 karakter!',
				'required' => 'Anda harus mengisi Nama Produk terlebih dahulu!'
			]
		);
		$this->form_validation->set_rules(
			'warna',
			'Warna Produk',
			'trim|max_length[20]|required',
			[
				'max_length' => 'Panjang karakter warna produk adalah 20 karakter!',
				'required' => 'Anda harus mengisi warna Produk terlebih dahulu!'
			]
		);
		$this->form_validation->set_rules(
			'ukuran',
			'Ukuran Produk',
			'trim|max_length[10]|required',
			[
				'max_length' => 'Panjang karakter ukuran produk adalah 20 karakter!',
				'required' => 'Anda harus mengisi ukuran Produk terlebih dahulu!'
			]
		);
		$this->form_validation->set_rules(
			'harga',
			'Harga Produk',
			'trim|numeric|required',
			[
				'numeric' => 'Anda harus memasukkan format angka!',
				'required' => 'Anda harus mengisi harga Produk terlebih dahulu!'
			]
		);
		$this->form_validation->set_rules(
			'stok',
			'Stok Produk',
			'trim|numeric|required',
			[
				'numeric' => 'Anda harus memasukkan format angka!',
				'required' => 'Anda harus mengisi stok Produk terlebih dahulu!'
			]
		);
		$this->form_validation->set_rules(
			'deskripsi',
			'Deskripsi',
			'trim|max_length[1000]',
			[
				'max_length' => 'Panjang karakter ukuran produk adalah 1000 karakter!'
			]
		);
		$this->form_validation->set_error_delimiters('<span class="text-danger text-sm" >', '</span>');
		if ($this->form_validation->run() === false) {
			$data['title'] = _store();
			$data['selectMerek'] = $this->toko->get_data_merek();
			$data['selectKategori'] = $this->toko->get_data_kategori();
			$view = 'v_tambahproduk';
			$this->_layout($data, $view);
		} else {
			$idUser = $this->session->userdata('id_user');
			$idToko = $this->toko->get_data_toko($idUser)->row()->id;
			$namaKategori = $this->input->post('namaKategori', TRUE);
			$namaMerek = $this->input->post('namaMerek', TRUE);
			$namaProduk = $this->input->post('namaProduk', TRUE);
			$warna = $this->input->post('warna', TRUE);
			$ukuran= $this->input->post('ukuran', TRUE);
			$harga = $this->input->post('harga', TRUE);
			$deskripsi= $this->input->post('deskripsi', TRUE);
			$stok= $this->input->post('stok', TRUE);

			$namaFile = angkaUnik();

			/** upload file */
			$config['upload_path']          = './gambar/produk';
			$config['allowed_types']        = 'jpg|png|jpeg';
			$config['max_size']             = 2024;
			$config['file_name']            = $namaFile;
			$this->load->library('upload', $config);
			if (!$this->upload->do_upload('gambar')){
				$error = array('error' => $this->upload->display_errors());
				$this->session->set_flashdata('pesan2', '<div class="alert alert-danger" role="alert">'.$error['error'].'</div>');
				redirect('store/produk/add');
			}else {
				/** Menyimpan ke dalam tabel produk */
				$dataProduk = [
					'id_kategori' => $namaKategori,
					'id_merek' => $namaMerek,
					'nama_produk' => $namaProduk,
					'warna' => $warna,
					'ukuran' => $ukuran,
					'harga' => $harga,
					'stok' => $stok,
					'deskripsi' => $deskripsi,
					'gambar' => $this->upload->data('file_name'),
					'id_toko' => $idToko,
					'created_at' => time(),
					'updated_at' => time(),
					'status' => 1,
				];
				$this->toko->simpan_produk($dataProduk);
				$this->session->set_flashdata('pesan1', '<div class="alert alert-success" role="alert">Data produk berhasil ditambahkan!</div>');
				redirect('store/produk');
			}
		}
	}

	public function detail($idx=null)
	{
		$id = decrypt_url($idx);
		if(in_array($id,[null,""])){
			redirect('store/produk');
		} else {
			$getData = $this->toko->get_produk($id);
			if($getData->num_rows() != 0){
				$data['title'] = _store();
				$view ='v_detail_produk';
				$this->_layout($data,$view);
			} else {
				redirect('store/produk');
			}
		}
	}

	private function _dataprepare($id)
	{
		$data = [];

	}

}
