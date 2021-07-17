<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/RestController.php';
use chriskacerguis\RestServer\RestController;

class Keranjang extends RestController
{

	public $api;

	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_api', 'api');
	}

	public function index_post()
	{
		$idUser = $this->post('id_user');
		$myToken = $this->post('token');
		$idProduk = $this->post('idProduk');
		$jumlah = $this->post('jumlah');
		$biayaAntar = 20000;
		//cek apakah memiliki token
		$cekUser = $this->api->cek_user($idUser,$myToken);
		if($cekUser != 0){
			//cek apakah idProduk Ada
			$getProduk = $this->api->get_data_produk($idProduk);
			if($getProduk->num_rows() != 0){
				$hargaProduk = $getProduk->row()->harga;
				//cek apakah user keranjangnya kosong atau tidak
				$getKeranjang = $this->api->get_data_keranjang($idUser);
				if($getKeranjang->num_rows() != 0){
//					//jika keranjang ada isinya, maka dicek id produk sudah ada belum?
					$getIdProduk = $this->api->get_detail_keranjang($idProduk);
					$msubTotal = $hargaProduk * $jumlah;
					$idKeranjang = $getKeranjang->row()->id;
					if($getIdProduk->num_rows() != 0){
						//produk akan diperbaharui jumlahnya
						$jumlahOld = $getIdProduk->row()->jumlah;
						$dataDetail = [
							'jumlah' => $jumlah + $jumlahOld,
							'm_sub_total' =>  ($jumlah + $jumlahOld) * $hargaProduk,
						];
						$this->api->update_detail_keranjang($dataDetail,$idProduk,$idKeranjang);
						$subTotal = $this->api->get_sub_total($idKeranjang);
						$dataKeranjang = [
							'sub_total' => $subTotal,
							'biaya_antar' => $biayaAntar,
							'total_biaya' => $subTotal + $biayaAntar,
						];
						$this->api->update_data_keranjang($dataKeranjang,$idKeranjang);
						$dataResponse = [
							'status' => true,
							'message' => 'Data berhasil disimpan !',
						];
						$this->response($dataResponse, 200);
					}else{
						//produk akan ditambahkan

						$dataDetail = [
							'id_keranjang' => $idKeranjang,
							'id_produk' => $idProduk,
							'jumlah' => $jumlah,
							'm_sub_total' => $msubTotal
						];
						$this->api->simpan_detail_keranjang($dataDetail);
						$subTotal = $this->api->get_sub_total($idKeranjang);
						$dataKeranjang = [
							'sub_total' => $subTotal,
							'biaya_antar' => $biayaAntar,
							'total_biaya' => $subTotal + $biayaAntar,
						];
						$this->api->update_data_keranjang($dataKeranjang,$idKeranjang);
						$dataResponse = [
							'status' => true,
							'message' => 'Data berhasil disimpan !',
						];
						$this->response($dataResponse, 200);
					}
				}else {
					// ditambahkan produk baru di dalam keranjang
					$subTotal = $hargaProduk * (($jumlah !=null)?$jumlah:1);
					$dataKeranjang = [
						'id_user' => $idUser,
						'sub_total' => $subTotal,
						'biaya_antar' => $biayaAntar,
						'total_biaya' => $subTotal+$biayaAntar
					];
					$idKeranjang = $this->api->simpan_keranjang($dataKeranjang);
					$dataDetail = [
						'id_keranjang' => $idKeranjang,
						'id_produk' => $idProduk,
						'jumlah' => $jumlah,
						'm_sub_total' => $subTotal
					];
					$this->api->simpan_detail_keranjang($dataDetail);
					$dataResponse = [
						'status' => true,
						'message' => 'Data berhasil disimpan !',
					];
					$this->response($dataResponse, 200);
				}
			} else {
				$this->response( [
					'status' => false,
					'message' => 'No data found'
				], 404 );
			}
		} else {
			$this->response( [
				'status' => false,
				'message' => 'Not Authorized'
			], 404 );
		}
 	}

	public function index_get()
	{
		$idUser = $this->get('id_user');
		$myToken = $this->get('token');
		$cekUser = $this->api->cek_user($idUser,$myToken);
		if($cekUser!= 0){
			$idKeranjang = $this->api->get_data_keranjang($idUser)->row()->id;
			$getData = $this->api->get_detail_keranjang_byid($idKeranjang);
			if($getData->num_rows() != 0){
				$dataResponse = [
					'status' => true,
					'result' => $getData->result_array(),
					'message' => 'Data berhasil didapatkan !',
				];
				$this->response($dataResponse, 200);
			}else{
				$this->response( [
					'status' => false,
					'message' => 'No data found'
				], 404 );
			}
		} else {
			$this->response( [
				'status' => false,
				'message' => 'Not Authorized'
			], 404 );
		}
	}

	public function total_get()
	{
		$idUser = $this->get('id_user');
		$myToken = $this->get('token');
		$cekUser = $this->api->cek_user($idUser,$myToken);
		if($cekUser!= 0){
			$getDataTotal = $this->api->get_total_keranjang($idUser);
			if($getDataTotal->num_rows()!= 0){
				foreach ($getDataTotal->result_array() as $row){
					$data['status'] = true;
					$data['nama_lengkap'] = ucwords($row['nama_lengkap']);
					$data['notelp'] =$row['notelp'];
					$data['alamat'] = ucfirst($row['alamat']);
					$data['sub_total'] =$row['sub_total'];
					$data['biaya_antar'] =$row['biaya_antar'];
					$data['total_biaya'] =$row['total_biaya'];
				}
				$this->response($data, 200);
			}else{
				$this->response( [
					'status' => false,
					'message' => 'No data found'
				], 404 );
			}
		} else {
			$this->response( [
				'status' => false,
				'message' => 'Not Authorized'
			], 404 );
		}
	}
}
