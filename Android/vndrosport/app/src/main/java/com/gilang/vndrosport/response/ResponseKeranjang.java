package com.gilang.vndrosport.response;

import com.gilang.vndrosport.model.KeranjangModel;
import com.google.gson.annotations.SerializedName;

import java.util.List;

public class ResponseKeranjang {
	@SerializedName("status")
	private final String status;
	@SerializedName("result")
	private final List<KeranjangModel> daftarKeranjang;
	@SerializedName("message")
	private final String message;

	public ResponseKeranjang(String status, List<KeranjangModel> daftarKeranjang, String message) {
		this.status = status;
		this.daftarKeranjang = daftarKeranjang;
		this.message = message;
	}

	public String getStatus() {
		return status;
	}

	public List<KeranjangModel> getDaftarKeranjang() {
		return daftarKeranjang;
	}

	public String getMessage() {
		return message;
	}
}
