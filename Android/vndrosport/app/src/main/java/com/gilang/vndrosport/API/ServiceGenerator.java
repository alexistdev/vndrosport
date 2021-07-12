package com.gilang.vndrosport.API;

import com.gilang.vndrosport.config.Constants;

import okhttp3.OkHttpClient;
import retrofit2.Retrofit;
import retrofit2.converter.gson.GsonConverterFactory;

public class ServiceGenerator {
	public static Retrofit.Builder builder =
			new Retrofit.Builder()
					.baseUrl(Constants.URL)
					.addConverterFactory(GsonConverterFactory.create());

	public static Retrofit retrofit = builder.build();

	public static OkHttpClient.Builder httpClient =
			new OkHttpClient.Builder();

	public static <S> S createService(
			Class<S> serviceClass) {
		return retrofit.create(serviceClass);
	}
}
