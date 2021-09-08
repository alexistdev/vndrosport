<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_transaksi_toko extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->pesanan = 'detail_pesanan';
		$this->pesananutama = 'pesanan';
		$this->produk = 'produk';
	}

	public function get_data_pesanan($idToko)
	{
		$this->db->select("$this->pesanan.id,$this->pesanan.id_pesanan,$this->produk.nama_produk,$this->pesanan.sub_total,$this->pesanan.jumlah,$this->produk.gambar,$this->pesanan.status");
		$this->db->join($this->produk, "$this->produk.id = $this->pesanan.id_produk");
		$this->db->where("$this->produk.id_toko", $idToko);
		$this->db->where("$this->pesanan.status !=", 1);
		return $this->db->get($this->pesanan);
	}

	public function get_data_pesanan3($idPesanan)
	{
		$this->db->where("$this->pesanan.id_pesanan", $idPesanan);
		return $this->db->get($this->pesanan);
	}

	public function get_data_pesanan2($idPesanan)
	{
		$this->db->where("$this->pesanan.id_pesanan", $idPesanan);
		$this->db->where("$this->pesanan.status", 3);
		return $this->db->get($this->pesanan);
	}

	public function perbaharui_status_pesanan($data,$id)
	{
		$this->db->where("$this->pesanan.id", $id);
		$this->db->update($this->pesanan,$data);
	}

	public function perbaharui_pesanan($data,$idPesanan)
	{
		$this->db->where("$this->pesananutama.id", $idPesanan);
		$this->db->update($this->pesananutama,$data);
	}
}
