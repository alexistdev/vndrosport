package com.gilang.vndrosport.model;

import com.google.gson.annotations.SerializedName;

public class TotalModel {
	@SerializedName("nama_lengkap")
	private final String namaLengkap;
	@SerializedName("notelp")
	private final String noTelp;
	@SerializedName("alamat")
	private final String alamat;
	@SerializedName("sub_total")
	private final String SubTotal;
	@SerializedName("biaya_antar")
	private final String biayaAntar;
	@SerializedName("total_biaya")
	private final String totalBiaya;

	public TotalModel(String namaLengkap, String notelp, String alamat, String subTotal, String biayaAntar, String totalBiaya) {
		this.namaLengkap = namaLengkap;
		this.noTelp = notelp;
		this.alamat = alamat;
		this.SubTotal = subTotal;
		this.biayaAntar = biayaAntar;
		this.totalBiaya = totalBiaya;
	}

	public String getNamaLengkap() {
		return namaLengkap;
	}

	public String getNoTelp() {
		return noTelp;
	}

	public String getAlamat() {
		return alamat;
	}

	public String getSubTotal() {
		return SubTotal;
	}

	public String getBiayaAntar() {
		return biayaAntar;
	}

	public String getTotalBiaya() {
		return totalBiaya;
	}
}
