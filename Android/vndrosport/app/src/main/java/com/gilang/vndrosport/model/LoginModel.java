package com.gilang.vndrosport.model;

import com.google.gson.annotations.SerializedName;

public class LoginModel {
	@SerializedName("status")
	private final Boolean status;
	@SerializedName("id_user")
	private final String idUser;
	@SerializedName("id_toko")
	private final String idToko;
	@SerializedName("token")
	private final String token;
	@SerializedName("message")
	private final String message;

	public LoginModel(Boolean status, String idUser, String idToko, String token, String message) {
		this.status = status;
		this.idUser = idUser;
		this.idToko = idToko;
		this.token = token;
		this.message = message;
	}

	public Boolean getStatus() {
		return status;
	}

	public String getIdUser() {
		return idUser;
	}

	public String getIdToko() {
		return idToko;
	}

	public String getToken() {
		return token;
	}

	public String getMessage() {
		return message;
	}
}
