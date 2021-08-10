package com.gilang.vndrosport.model;

import com.google.gson.annotations.SerializedName;

public class AkunModel {
	@SerializedName("status")
	private final Boolean status;
	@SerializedName("email")
	private final String email;
	@SerializedName("nama_lengkap")
	private final String nama_lengkap;
	@SerializedName("alamat")
	private final String alamat;
	@SerializedName("no_telp")
	private final String no_telp;
	@SerializedName("message")
	private final String message;

	public AkunModel(Boolean status, String email, String nama_lengkap, String alamat, String no_telp, String message) {
		this.status = status;
		this.email = email;
		this.nama_lengkap = nama_lengkap;
		this.alamat = alamat;
		this.no_telp = no_telp;
		this.message = message;
	}

	public Boolean getStatus() {
		return status;
	}

	public String getEmail() {
		return email;
	}

	public String getNama_lengkap() {
		return nama_lengkap;
	}

	public String getAlamat() {
		return alamat;
	}

	public String getNo_telp() {
		return no_telp;
	}

	public String getMessage() {
		return message;
	}
}
