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
	}

	public function validasi_login($username)
	{
		$this->db->where('email', $username);
		return $this->db->get($this->user);
	}

	#########################################################################################
	#                                   tabel toko                       					#
	#########################################################################################

	public function simpan_toko($data)
	{
		$this->db->insert($this->tbtoko,$data);
	}


}
