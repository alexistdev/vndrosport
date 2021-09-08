<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_transaksi extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->pesanan = 'pesanan';
		$this->detailuser = 'detailuser';
	}

	public function get_data_transaksi()
	{
		$this->db->join($this->detailuser, "$this->detailuser.id_user = $this->pesanan.id_user");
		return $this->db->get("$this->pesanan");
	}


}
