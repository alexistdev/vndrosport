<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_transaksi extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->pesanan = 'pesanan';
		$this->detail = 'detail_pesanan';
		$this->detailuser = 'detailuser';
	}

	public function get_data_transaksi($id=null)
	{
		if($id !=null){
			$this->db->where("$this->pesanan.id",$id);
		}
		$this->db->select("$this->pesanan.id,$this->pesanan.tanggal,$this->pesanan.sub_total,$this->pesanan.status,$this->detailuser.nama_lengkap,$this->pesanan.judul,$this->pesanan.biaya_antar,$this->pesanan.total_jumlah");
		$this->db->join($this->detailuser, "$this->detailuser.id_user = $this->pesanan.id_user");
		return $this->db->get("$this->pesanan");
	}

	public function perbaharui_status($dataStatus,$id)
	{
		$this->db->where("$this->pesanan.id",$id);
		$this->db->update($this->pesanan,$dataStatus);
	}

	public function perbaharui_status_detail($data,$id)
	{
		$this->db->where("$this->detail.id_pesanan",$id);
		$this->db->update($this->detail,$data);
	}

}
