package com.gilang.vndrosport.model;

import com.google.gson.annotations.SerializedName;

public class PesananModel {
	@SerializedName("id")
	private final String idPesanan;
	@SerializedName("judul")
	private final String judul;
	@SerializedName("tanggal")
	private final String tanggal;
	@SerializedName("sub_total")
	private final String sub_total;
	@SerializedName("biaya_antar")
	private final String biaya_antar;
	@SerializedName("total_jumlah")
	private final String total_jumlah;
	@SerializedName("status")
	private final String status;

	public PesananModel(String idPesanan, String judul, String tanggal, String sub_total, String biaya_antar, String total_jumlah, String status) {
		this.idPesanan = idPesanan;
		this.judul = judul;
		this.tanggal = tanggal;
		this.sub_total = sub_total;
		this.biaya_antar = biaya_antar;
		this.total_jumlah = total_jumlah;
		this.status = status;
	}

	public String getIdPesanan() {
		return idPesanan;
	}

	public String getJudul() {
		return judul;
	}

	public String getTanggal() {
		return tanggal;
	}

	public String getSub_total() {
		return sub_total;
	}

	public String getBiaya_antar() {
		return biaya_antar;
	}

	public String getTotal_jumlah() {
		return total_jumlah;
	}

	public String getStatus() {
		return status;
	}
}
