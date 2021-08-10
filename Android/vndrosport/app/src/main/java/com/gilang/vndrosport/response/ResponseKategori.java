package com.gilang.vndrosport.response;

import com.gilang.vndrosport.model.KategoriModel;
import com.google.gson.annotations.SerializedName;

import java.util.List;

public class ResponseKategori {
	@SerializedName("status")
	private final String status;
	@SerializedName("result")
	private final List<KategoriModel> daftarKategori;
	@SerializedName("message")
	private final String message;

	public ResponseKategori(String status, List<KategoriModel> daftarKategori, String message) {
		this.status = status;
		this.daftarKategori = daftarKategori;
		this.message = message;
	}

	public String getStatus() {
		return status;
	}

	public List<KategoriModel> getDaftarKategori() {
		return daftarKategori;
	}

	public String getMessage() {
		return message;
	}
}
