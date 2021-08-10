package com.gilang.vndrosport.response;

import com.gilang.vndrosport.model.PesananModel;
import com.google.gson.annotations.SerializedName;

import java.util.List;

public class ResponsePesanan {
	@SerializedName("status")
	private final String status;
	@SerializedName("result")
	private final List<PesananModel> daftarPesanan;
	@SerializedName("message")
	private final String message;

	public ResponsePesanan(String status, List<PesananModel> daftarPesanan, String message) {
		this.status = status;
		this.daftarPesanan = daftarPesanan;
		this.message = message;
	}

	public String getStatus() {
		return status;
	}

	public List<PesananModel> getDaftarPesanan() {
		return daftarPesanan;
	}

	public String getMessage() {
		return message;
	}
}
