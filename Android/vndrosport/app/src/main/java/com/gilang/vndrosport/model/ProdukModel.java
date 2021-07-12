package com.gilang.vndrosport.model;

import com.google.gson.annotations.SerializedName;

public class ProdukModel {
	@SerializedName("id")
	private final String idProduk;
	@SerializedName("nama_produk")
	private final String namaProduk;
	@SerializedName("harga")
	private final String hargaProduk;

	public ProdukModel(String idProduk, String namaProduk, String hargaProduk) {
		this.idProduk = idProduk;
		this.namaProduk = namaProduk;
		this.hargaProduk = hargaProduk;
	}

	public String getIdProduk() {
		return idProduk;
	}

	public String getNamaProduk() {
		return namaProduk;
	}

	public String getHargaProduk() {
		return hargaProduk;
	}
}
