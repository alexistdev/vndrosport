package com.gilang.vndrosport.response;

import com.gilang.vndrosport.model.ProdukModel;
import com.google.gson.annotations.SerializedName;

import java.util.List;

public class ResponseProduk {
	@SerializedName("status")
	private final String status;
	@SerializedName("result")
	private final List<ProdukModel> daftarProduk;
	@SerializedName("message")
	private final String message;

	public ResponseProduk(String status, List<ProdukModel> daftarProduk, String message) {
		this.status = status;
		this.daftarProduk = daftarProduk;
		this.message = message;
	}

	public String getStatus() {
		return status;
	}

	public List<ProdukModel> getDaftarProduk() {
		return daftarProduk;
	}

	public String getMessage() {
		return message;
	}
}
