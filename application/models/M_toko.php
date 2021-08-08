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
	}

	public function validasi_login($username)
	{
		$this->db->where('email', $username);
		return $this->db->get($this->user);
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


}
