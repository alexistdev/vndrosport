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
	}

	public function get_data_spesial()
	{
		$this->db->select("$this->tbproduk.nama_produk, $this->tbspesial.id, $this->tbproduk.harga AS harga_asli,$this->tbspesial.harga AS harga_diskon");
		$this->db->join($this->tbproduk,"$this->tbproduk.id = $this->tbspesial.id_produk");
		$this->db->order_by("$this->tbspesial.id", "DESC");
		$this->db->limit(1);
		return $this->db->get($this->tbspesial);
	}
}
