<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_admin extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->tbadmin = 'admin';
		$this->tbusers = 'users';
		$this->tbdetailuser = 'detailuser';
//		$this->tbberita = 'berita';
//		$this->tbdetailberita = 'detailberita';
//		$this->tbjeniskendaraan = 'jenis_kendaraan';
//		$this->tbtipekendaraan = 'tipe_kendaraan';
//		$this->tbkendaraan = 'kendaraan';
//		$this->tbinbox = 'inbox';
	}

	#########################################################################################
	#                                   tabel admin                     					#
	#########################################################################################

	public function validasi_login($username)
	{
		$this->db->where('username', $username);
		return $this->db->get($this->tbadmin);
	}

	#########################################################################################
	#                          tabel user dan detailuser                   					#
	#########################################################################################


	public function get_detail_data_user()
	{
		$this->db->join($this->tbdetailuser,"$this->tbdetailuser.id_user = $this->tbusers.id_user");
		return $this->db->get($this->tbusers);
	}
	public function simpan_user($data)
	{
		$this->db->insert($this->tbusers,$data);
		return $this->db->insert_id();
	}

	public function simpan_detail_user($data)
	{
		$this->db->insert($this->tbdetailuser,$data);
	}

}
