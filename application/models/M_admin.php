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
		$this->tbnegara = 'negara';
		$this->tbprovinsi = 'provinsi';
		$this->tbkabupaten = 'kabupaten';
		$this->tbtoko = 'toko';
		$this->tbkategori = 'kategori';
		$this->tbmerek = 'merek';
//		$this->tbtipekendaraan = 'tipe_kendaraan';
//		$this->tbkendaraan = 'kendaraan';
//		$this->tbinbox = 'inbox';
	}

	#########################################################################################
	#                                   tabel merek                     					#
	#########################################################################################
	public function get_data_merek($id=null)
	{
		if($id !=null){
			$this->db->where("$this->tbmerek.id",$id);
		}
		$this->db->order_by("$this->tbmerek.id", "DESC");
		return $this->db->get($this->tbmerek);
	}

	public function simpan_merek($data)
	{
		$this->db->insert($this->tbmerek,$data);
	}

	public function update_data_merek($dataMerek,$id)
	{
		$this->db->where('id',$id);
		$this->db->update($this->tbmerek,$dataMerek);
	}

	public function hapus_merek($id)
	{
		$this->db->where('id', $id);
		$this->db->delete($this->tbmerek);
	}



	#########################################################################################
	#                                   tabel kategori                    					#
	#########################################################################################

	public function get_data_kategori($id=null)
	{
		if($id !=null){
			$this->db->where("$this->tbkategori.id",$id);
		}
		$this->db->order_by("$this->tbkategori.id", "DESC");
		return $this->db->get($this->tbkategori);
	}

	public function simpan_kategori($data)
	{
		$this->db->insert($this->tbkategori,$data);
	}

	public function update_data_kategori($dataKategori,$id)
	{
		$this->db->where('id',$id);
		$this->db->update($this->tbkategori,$dataKategori);
	}

	public function hapus_kategori($id)
	{
		$this->db->where('id', $id);
		$this->db->delete($this->tbkategori);
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

	public function hapus_client($id)
	{
		$this->db->where('id_user', $id);
		$this->db->delete($this->tbusers);
	}


	#########################################################################################
	#                              tabel provinsi & negara                              	#
	#########################################################################################

	public function get_data_provinsi($id=null)
	{
		if($id != null){
			$this->db->where("$this->tbprovinsi.id",$id);
		}
		$this->db->select("$this->tbnegara.id AS id_negara , $this->tbnegara.iso,$this->tbnegara.code,$this->tbnegara.nama_negara,$this->tbprovinsi.id AS id_provinsi,$this->tbprovinsi.nama_provinsi,$this->tbprovinsi.created_at,$this->tbprovinsi.updated_at");
		$this->db->join($this->tbnegara,"$this->tbnegara.id = $this->tbprovinsi.id_negara");
		return $this->db->get($this->tbprovinsi);
	}

	public function get_data_negara()
	{
		return $this->db->get($this->tbnegara);
	}

	public function simpan_provinsi($data)
	{
		$this->db->insert($this->tbprovinsi,$data);
	}

	public function update_data_provinsi($data,$id)
	{
		$this->db->where('id',$id);
		$this->db->update($this->tbprovinsi,$data);
	}

	public function hapus_provinsi($id)
	{
		$this->db->where('id', $id);
		$this->db->delete($this->tbprovinsi);
	}
	#########################################################################################
	#                              tabel kabupaten                                      	#
	#########################################################################################

	public function get_data_kabupaten($id=null)
	{
		if($id != null){
			$this->db->where("$this->tbkabupaten.id",$id);
		}
		$this->db->select("$this->tbprovinsi.id AS id_provinsi,$this->tbprovinsi.nama_provinsi , $this->tbkabupaten.id AS id_kabupaten,$this->tbkabupaten.nama_kabupaten,$this->tbkabupaten.created_at,$this->tbkabupaten.updated_at");
		$this->db->join($this->tbprovinsi,"$this->tbprovinsi.id = $this->tbkabupaten.id_provinsi");
		$this->db->order_by("$this->tbprovinsi.nama_provinsi", "ASC");
		$this->db->order_by("$this->tbkabupaten.nama_kabupaten", "ASC");
		return $this->db->get($this->tbkabupaten);
	}

	public function simpan_kabupaten($data)
	{
		$this->db->insert($this->tbkabupaten,$data);
	}

	public function update_data_kabupaten($data,$id)
	{
		$this->db->where('id',$id);
		$this->db->update($this->tbkabupaten,$data);
	}

	public function hapus_kabupaten($id)
	{
		$this->db->where('id', $id);
		$this->db->delete($this->tbkabupaten);
	}
}
