package com.gilang.vndrosport.model;

import com.google.gson.annotations.SerializedName;

public class SpesialModel {
	@SerializedName("id")
	private final String idSpesial;
	@SerializedName("nama_produk")
	private final String namaProduk;
	@SerializedName("harga_asli")
	private final String hargaAsli;
	@SerializedName("harga_diskon")
	private final String hargaDiskon;

	public SpesialModel(String idSpesial, String namaProduk, String hargaAsli, String hargaDiskon) {
		this.idSpesial = idSpesial;
		this.namaProduk = namaProduk;
		this.hargaAsli = hargaAsli;
		this.hargaDiskon = hargaDiskon;
	}

	public String getIdSpesial() {
		return idSpesial;
	}

	public String getNamaProduk() {
		return namaProduk;
	}

	public String getHargaAsli() {
		return hargaAsli;
	}

	public String getHargaDiskon() {
		return hargaDiskon;
	}
}
