<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_toko extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->toko = 'toko';
		$this->user = 'users';
		$this->produk = 'produk';
		$this->merek = 'merek';
		$this->kategori = 'kategori';
		$this->sale = 'sale';
	}

	public function validasi_login($username)
	{
		$this->db->where('email', $username);
		return $this->db->get($this->user);
	}
	#########################################################################################
	#                                   tabel Penjualan                   					#
	#########################################################################################

	public function get_data_sale($id)
	{
		$this->db->where("$this->sale.id_produk",$id);
		return $this->db->get($this->sale);
	}


	#########################################################################################
	#                                   tabel kategori                     					#
	#########################################################################################

	public function get_data_kategori($id=null)
	{
		if($id != null){
			$this->db->where("$this->kategori.id",$id);
		}
		$this->db->order_by("$this->kategori.nama_kategori","ASC");
		return $this->db->get($this->kategori);
	}

	#########################################################################################
	#                                   tabel toko                       					#
	#########################################################################################

	public function get_data_toko($idUser=null)
	{
		if($idUser !=null){
			$this->db->where("$this->toko.id_user", $idUser);
		}
		return $this->db->get($this->toko);
	}


	public function simpan_toko($data)
	{
		$this->db->insert($this->tbtoko,$data);
	}

	#########################################################################################
	#                                   tabel produk                       					#
	#########################################################################################

	public function get_data_produk($idToko)
	{
		$this->db->where("$this->produk.id_toko",$idToko);
		return $this->db->get($this->produk);
	}

	public function get_produk($id=null)
	{
		if($id != null){
			$this->db->where("$this->produk.id",$id);
		}
		$this->db->join($this->merek,"$this->merek.id = $this->produk.id_merek");
		$this->db->join($this->kategori,"$this->kategori.id = $this->produk.id_kategori");
		$this->db->order_by("$this->produk.id", "DESC");
		return $this->db->get($this->produk);
	}

	public function simpan_produk($data)
	{
		$this->db->insert($this->produk,$data);
	}

	#########################################################################################
	#                                   tabel merek                       					#
	#########################################################################################
	public function get_data_merek($id=null)
	{
		if($id != null){
			$this->db->where("$this->merek.id",$id);
		}
		$this->db->order_by("$this->merek.nama_merek", "ASC");
		return $this->db->get($this->merek);
	}
}
