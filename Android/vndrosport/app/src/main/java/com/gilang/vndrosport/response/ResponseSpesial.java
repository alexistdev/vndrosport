package com.gilang.vndrosport.response;

import com.gilang.vndrosport.model.SpesialModel;
import com.google.gson.annotations.SerializedName;

import java.util.List;

public class ResponseSpesial {
	@SerializedName("status")
	private final String status;
	@SerializedName("result")
	final private List<SpesialModel> daftarSpesial;
	@SerializedName("message")
	private final String message;

	public ResponseSpesial(String status, List<SpesialModel> daftarSpesial, String message) {
		this.status = status;
		this.daftarSpesial = daftarSpesial;
		this.message = message;
	}

	public String getStatus() {
		return status;
	}

	public List<SpesialModel> getDaftarSpesial() {
		return daftarSpesial;
	}

	public String getMessage() {
		return message;
	}
}
