<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_produk extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->produk = 'produk';
		$this->toko = 'toko';
		$this->keranjang = 'keranjang';
		$this->detailkeranjang = 'detailkeranjang';
	}

	/** data produk semua kecuali yang punya toko */
	public function data_semua_produk($idToko)
	{
		$this->db->where("$this->produk.id_toko !=", $idToko);
		$this->db->select("$this->produk.id,$this->produk.harga,$this->produk.nama_produk,$this->produk.gambar");
		return $this->db->get($this->produk);
	}

	public function get_data_produk($id=null)
	{
		if($id != null){
			$this->db->where("$this->produk.id",$id);
		}
		$this->db->select("$this->produk.id,$this->produk.nama_produk,$this->produk.gambar,$this->toko.nama_toko,$this->produk.harga,$this->produk.ukuran");
		$this->db->join($this->toko,"$this->toko.id = $this->produk.id_toko");
		$this->db->order_by("$this->produk.id", "DESC");
		return $this->db->get($this->produk);
	}

	public function data_produk_byID($id)
	{
		$this->db->where("$this->produk.id",$id);
		return $this->db->get($this->produk);
	}

	/** Detail keranjang */
	public function get_detail_byproduk($idProduk)
	{
		$this->db->where("$this->detailkeranjang.id_produk",$idProduk);
		return $this->db->get($this->detailkeranjang);
	}

	public function get_detail_byidkeranjang($idKeranjang)
	{
		$this->db->where("$this->detailkeranjang.id_keranjang",$idKeranjang);
		return $this->db->get($this->detailkeranjang);
	}

	public function hapus_item_detailkeranjang($idProduk,$idKeranjang)
	{
		$this->db->where("$this->detailkeranjang.id_keranjang",$idKeranjang);
		$this->db->where("$this->detailkeranjang.id_produk",$idProduk);
		$this->db->delete($this->detailkeranjang);
	}

	/**  keranjang */
	public function get_keranjang_byuser($idUser)
	{
		$this->db->where("$this->keranjang.id_user",$idUser);
		return $this->db->get($this->keranjang);
	}

	public function hapus_keranjang_byUser($idUser)
	{
		$this->db->where("$this->keranjang.id_user",$idUser);
		$this->db->delete($this->keranjang);
	}

	public function perbaharui_keranjang($dataKeranjang,$idKeranjang)
	{
		$this->db->where("$this->keranjang.id",$idKeranjang);
		$this->db->update($this->keranjang,$dataKeranjang);
	}

}
