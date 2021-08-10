<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_api extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->tbspesial = 'spesial';
		$this->tbproduk = 'produk';
		$this->tbmerek = 'merek';
		$this->tbkategori = 'kategori';
		$this->tbtoko = 'toko';
		$this->tbusers = 'users';
		$this->tbdetailuser = 'detailuser';
		$this->tbkeranjang = 'keranjang';
		$this->tbdetailkeranjang = 'detailkeranjang';
		$this->tbpesanan = 'pesanan';
	}

	#########################################################################################
	#                          Akun                                     					#
	#########################################################################################

	public function update_akun($data,$id)
	{
		$this->db->where("$this->tbusers.id_user",$id);
		$this->db->update($this->tbusers,$data);
	}

	public function update_detail_akun($data,$id)
	{
		$this->db->where("$this->tbdetailuser.id_user",$id);
		$this->db->update($this->tbdetailuser,$data);
	}


	public function get_data_akun($idUser)
	{
		$this->db->where("$this->tbusers.id_user",$idUser);
		$this->db->join($this->tbdetailuser,"$this->tbdetailuser.id = $this->tbusers.id_user");
		return $this->db->get($this->tbusers);

	}
	public function validasi_login($email)
	{
		$this->db->where('email', $email);
		return $this->db->get($this->tbusers);
	}


	public function get_data_spesial($single=false)
	{
		$this->db->select("$this->tbproduk.nama_produk, $this->tbspesial.id, $this->tbproduk.harga AS harga_asli,$this->tbspesial.harga AS harga_diskon");
		$this->db->join($this->tbproduk,"$this->tbproduk.id = $this->tbspesial.id_produk");
		$this->db->order_by("$this->tbspesial.id", "DESC");
		if($single){
			$this->db->limit(1);
		}
		return $this->db->get($this->tbspesial);
	}

	public function get_data_produk($id=null)
	{
		if($id != null){
			$this->db->where("$this->tbproduk.id", $id);
		}
		$this->db->select("$this->tbtoko.nama_toko,$this->tbtoko.last_online,$this->tbkategori.nama_kategori,$this->tbmerek.nama_merek, $this->tbproduk.id,$this->tbproduk.nama_produk, $this->tbproduk.harga,$this->tbproduk.gambar,$this->tbproduk.ukuran,$this->tbproduk.warna,$this->tbproduk.deskripsi");
		$this->db->join($this->tbkategori,"$this->tbkategori.id = $this->tbproduk.id_kategori");
		$this->db->join($this->tbtoko,"$this->tbtoko.id = $this->tbproduk.id_toko");
		$this->db->join($this->tbmerek,"$this->tbmerek.id = $this->tbproduk.id_merek");
		$this->db->order_by("$this->tbproduk.id", "DESC");
		return $this->db->get($this->tbproduk);
	}

	public function cek_user($id, $token)
	{
		$this->db->where('id_user' ,$id);
		$this->db->where('remember_token', $token);
		return $this->db->get($this->tbusers)->num_rows();
	}

	#########################################################################################
	#                          keranjang & detailkeranjang                 					#
	#########################################################################################

	public function get_data_keranjang($idUser=null)
	{
		if($idUser){
			$this->db->where('id_user',$idUser);
		}
		return $this->db->get($this->tbkeranjang);
	}

	public function get_judul_keranjang($idKeranjang)
	{
		$this->db->limit(1);
		$this->db->join($this->tbproduk,"$this->tbproduk.id = $this->tbdetailkeranjang.id_produk");
		return $this->db->get($this->tbdetailkeranjang);
	}

	public function simpan_keranjang($data)
	{
		$this->db->insert($this->tbkeranjang,$data);
		return $this->db->insert_id();
	}

	public function simpan_detail_keranjang($data)
	{
		$this->db->insert($this->tbdetailkeranjang,$data);
	}

	public function get_detail_keranjang($idProduk=null)
	{
		if($idProduk){
			$this->db->where('id_produk',$idProduk);
		}
		return $this->db->get($this->tbdetailkeranjang);
	}
	public function get_detail_keranjang_byid($idKeranjang=null)
	{
		$this->db->where('id_keranjang',$idKeranjang);
		$this->db->select("$this->tbdetailkeranjang.id_produk,$this->tbproduk.nama_produk,$this->tbproduk.gambar,$this->tbdetailkeranjang.id_keranjang,$this->tbdetailkeranjang.jumlah,$this->tbdetailkeranjang.m_sub_total,$this->tbdetailkeranjang.id");
		$this->db->join($this->tbproduk,"$this->tbproduk.id = $this->tbdetailkeranjang.id_produk");
		return $this->db->get($this->tbdetailkeranjang);
	}

	public function get_sub_total($idKeranjang)
	{
		$this->db->select_sum('m_sub_total');
		$this->db->where('id_keranjang', $idKeranjang);
		$result = $this->db->get($this->tbdetailkeranjang)->row();
		return $result->m_sub_total;
	}

	public function update_data_keranjang($data,$id)
	{
		$this->db->where('id',$id);
		$this->db->update($this->tbkeranjang,$data);
	}

	public function update_detail_keranjang($dataDetail,$idProduk,$idKeranjang)
	{
		$this->db->where('id_produk',$idProduk);
		$this->db->where('id_keranjang',$idKeranjang);
		$this->db->update($this->tbdetailkeranjang,$dataDetail);
	}

	public function get_total_keranjang($idUser)
	{
		$this->db->select("$this->tbdetailuser.nama_lengkap,$this->tbdetailuser.notelp,$this->tbdetailuser.alamat,$this->tbkeranjang.sub_total,$this->tbkeranjang.biaya_antar,$this->tbkeranjang.total_biaya");
		$this->db->join($this->tbdetailuser,"$this->tbdetailuser.id_user = $this->tbkeranjang.id_user");
		$this->db->where("$this->tbkeranjang.id_user",$idUser);
		return $this->db->get($this->tbkeranjang);
	}

	public function hapus_totalkeranjang($idUser)
	{
		$this->db->where('id_user',$idUser);
		$this->db->delete($this->tbkeranjang);
	}

	public function hapus_keranjang($idKeranjang)
	{
		$this->db->where('id_keranjang',$idKeranjang);
		$this->db->delete($this->tbdetailkeranjang);
	}



	#########################################################################################
	#                          pesanan & detail_pesanan                 					#
	#########################################################################################

	public function simpan_pesanan($dataPesanan)
	{
		$this->db->insert($this->tbpesanan,$dataPesanan);
		return $this->db->insert_id();
	}

	public function get_data_detailpesanan($id)
	{
		$this->db->where("$this->tbdetailkeranjang.id_keranjang",$id);
		return $this->db->get($this->tbdetailkeranjang);
	}

	public function simpan_detailpesanan($data)
	{
		$this->db->insert("detail_pesanan",$data);
	}

	public function get_data_pesanan($idUser)
	{
		$this->db->where("$this->tbpesanan.id_user",$idUser);
		return $this->db->get($this->tbpesanan);
	}

}
