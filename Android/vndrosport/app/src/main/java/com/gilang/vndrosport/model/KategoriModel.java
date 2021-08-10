package com.gilang.vndrosport.model;

import com.google.gson.annotations.SerializedName;

public class KategoriModel {
	@SerializedName("id")
	private final String idKategori;
	@SerializedName("nama_kategori")
	private final String namaKategori;

	public KategoriModel(String idKategori, String namaKategori) {
		this.idKategori = idKategori;
		this.namaKategori = namaKategori;
	}

	public String getIdKategori() {
		return idKategori;
	}

	public String getNamaKategori() {
		return namaKategori;
	}
}
