<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/RestController.php';
use chriskacerguis\RestServer\RestController;

class Keranjang extends RestController
{

	public $api;
	public $produk;

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_api', 'api');
		$this->load->model('M_produk', 'produk');
	}
	/* Start: Rest API untuk Menambah Keranjang Belanja*/
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
			$getProduk = $this->produk->data_produk_byID($idProduk);
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
			// End Cek produk sudah ada atau belum
		} else {
			$this->response( [
				'status' => false,
				'message' => 'Not Authorized'
			], 404 );
		}
		// End apakah token sudah benar
 	}
	/* End: Rest API untuk Menambah Keranjang Belanja*/

	/* Start: Rest API untuk Menampilkan Keranjang Belanja*/
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
	/* End: Rest API untuk Menampilkan Keranjang Belanja*/

	/* Start: Rest API untuk Menampilkan Total Keranjang Belanja*/
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
	/* End: Rest API untuk Menampilkan Total Keranjang Belanja*/

	/* Start: Rest API untuk Update barang Keranjang Belanja*/
	public function index_put()
	{
		$idUser = $this->put('id_user');
		$myToken = $this->put('token');
		$cekUser = $this->api->cek_user($idUser,$myToken);
		if($cekUser!= 0){
			$idProduk = $this->put('idProduk');
			$opsi = $this->put('opsi');
			//cek apakah idProduk Ada
			$getProduk = $this->produk->data_produk_byID($idProduk);
			if($getProduk->num_rows() != 0){
				$getDetailKeranjang = $this->api->get_detail_keranjang($idProduk);
				$idKeranjang = $getDetailKeranjang->row()->id_keranjang;
				$jumlah = $getDetailKeranjang->row()->jumlah;
				$hargaProduk = $getProduk->row()->harga;
				switch ($opsi) {
					case 1:
						$jumlah++;
						$dataDetailKeranjang = [
							'jumlah' => $jumlah,
							'm_sub_total' => $hargaProduk * $jumlah,
						];
						$this->api->update_detail_keranjang($dataDetailKeranjang,$idProduk,$idKeranjang);
						$subTotal = $this->api->get_sub_total($idKeranjang);
						$dataKeranjang = [
							'sub_total' => $subTotal,
							'total_biaya' => $subTotal+20000,
						];
						$this->api->update_data_keranjang($dataKeranjang,$idKeranjang);
						$dataResponse1 = [
							'status' => true,
							'message' => 'Produk ditambahkan !',
						];
						$this->response($dataResponse1, 200);
						break;
					case 2:
						$jumlah--;
						$dataDetailKeranjang = [
							'jumlah' => $jumlah,
							'm_sub_total' => $hargaProduk * $jumlah,
						];
						$this->api->update_detail_keranjang($dataDetailKeranjang,$idProduk,$idKeranjang);
						$subTotal = $this->api->get_sub_total($idKeranjang);
						$dataKeranjang = [
							'sub_total' => $subTotal,
							'total_biaya' => $subTotal+20000,
						];
						$this->api->update_data_keranjang($dataKeranjang,$idKeranjang);
						$dataResponse1 = [
							'status' => true,
							'message' => 'Produk dikurangi !',
						];
						$this->response($dataResponse1, 200);
						break;
						break;
					default:
						$dataResponse = [
							'status' => false,
							'message' => 'Gagal Mendapatkan Data !',
						];
						$this->response($dataResponse, 404);
						break;
				}
			} else {
				$this->response( [
					'status' => false,
					'message' => 'No data found'
				], 404 );
			}
		}else{
			$this->response( [
				'status' => false,
				'message' => 'Not Authorized'
			], 404 );
		}

	}
	/* End: Rest API untuk Update barang Keranjang Belanja*/

	/* Start: Rest API untuk Delete barang Keranjang Belanja*/
	public function index_delete()
	{
		$idUser = $this->delete('id_user');
		$myToken = $this->delete('token');
		$cekUser = $this->api->cek_user($idUser,$myToken);
		if($cekUser!= 0){
			/*
			Mengecek apakah ada id Keranjang
			Jika ada ===> dapatkan id keranjang kemudian hapus id produk
			*/
			$cekKeranjang = $this->produk->get_keranjang_byuser($idUser);
			if($cekKeranjang->num_rows() != 0){
				$idProduk = $this->delete('id_produk');
				$idKeranjang = $cekKeranjang->row()->id;
				$subTotalOld = $cekKeranjang->row()->sub_total;
				$biayaAntar = $cekKeranjang->row()->biaya_antar;


				$dataDetail = $this->produk->get_detail_byproduk($idProduk);
				/* Start: Cek jika ada produk maka langsung dihapus*/
				if($dataDetail->num_rows() != 0){
					/*
						Start: Mengecek apakah ini adalah produk satu2nya di keranjang
							Jika iya ===> hapus keranjang keseluruhan
							Jika tidak ===> total keranjang diupdate
					*/
					$jumlahItem = $this->produk->get_detail_byidkeranjang($idKeranjang)->num_rows();
					if($jumlahItem == 1){
						//hapus semua keranjang dan detail keranjang;
						$this->produk->hapus_keranjang_byUser($idUser);
						$this->response( [
							'status' => true,
							'message' => 'Keranjang Kosong'
						], 200 );
					} else {
						$mSubtotal = $dataDetail->row()->m_sub_total;
						$subTotalNew = $subTotalOld- $mSubtotal;
						$totalBiaya = $subTotalNew+$biayaAntar;
						//update dulu keranjangnya
						$dataKeranjang = [
							'sub_total' => $subTotalNew,
							'biaya_antar' => $biayaAntar,
							'total_biaya' => $totalBiaya,
						];
						$this->produk->perbaharui_keranjang($dataKeranjang,$idKeranjang);
						//hapus produknya
						$this->produk->hapus_item_detailkeranjang($idProduk,$idKeranjang);
						$this->response( [
							'status' => true,
							'message' => 'Keranjang berhasil dihapus'
						], 200 );
					}
					/* End: Mengecek apakah ini adalah produk satu2nya*/
				}
				/* End: Cek jika ada produk maka langsung dihapus*/

			}
			/* End: Cek id Keranjang by User */



		} else {
			$this->response( [
				'status' => false,
				'message' => 'Not Authorized'
			], 404 );
		}
	}

	/* End: Rest API untuk Delete barang Keranjang Belanja*/
}
