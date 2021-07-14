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
		$this->db->select("$this->tbkategori.nama_kategori,$this->tbmerek.nama_merek, $this->tbproduk.id,$this->tbproduk.nama_produk, $this->tbproduk.harga,$this->tbproduk.gambar,$this->tbproduk.ukuran,$this->tbproduk.warna");
		$this->db->join($this->tbkategori,"$this->tbkategori.id = $this->tbproduk.id_kategori");
		$this->db->join($this->tbmerek,"$this->tbmerek.id = $this->tbproduk.id_merek");
		$this->db->order_by("$this->tbproduk.id", "DESC");
		return $this->db->get($this->tbproduk);
	}
}
