package com.gilang.vndrosport.API;

import android.content.Context;
import com.gilang.vndrosport.BuildConfig;
import com.gilang.vndrosport.config.Constants;
import com.gilang.vndrosport.response.ResponseSpesial;

import java.util.concurrent.TimeUnit;
import okhttp3.OkHttpClient;
import okhttp3.logging.HttpLoggingInterceptor;
import retrofit2.Call;
import retrofit2.Retrofit;
import retrofit2.converter.gson.GsonConverterFactory;
import retrofit2.http.GET;
import retrofit2.http.Headers;

public interface APIService {

	/* Mendapatkan API Berita */
	@Headers({"x-api-key: 92K5wAWs7MPqY54St72HB3ETEqjvRP22"})
	@GET("api/spesial")
	Call<ResponseSpesial> tampilSpesial();

	class Factory{
		public static APIService create(Context mContext){
			OkHttpClient.Builder builder = new OkHttpClient.Builder();
			builder.readTimeout(20, TimeUnit.SECONDS);
			builder.connectTimeout(20, TimeUnit.SECONDS);
			builder.writeTimeout(20, TimeUnit.SECONDS);
			builder.addInterceptor(new NetworkConnectionInterceptor(mContext));
			HttpLoggingInterceptor logging = new HttpLoggingInterceptor();
			if(BuildConfig.DEBUG){
				logging.setLevel(HttpLoggingInterceptor.Level.BODY);
			}else {
				logging.setLevel(HttpLoggingInterceptor.Level.NONE);
			}
			OkHttpClient client = builder.addInterceptor(logging).build();

			Retrofit retrofit = new Retrofit.Builder()
					.baseUrl(Constants.URL)
					.client(client)
					.addConverterFactory(GsonConverterFactory.create())
					.build();

			return retrofit.create(APIService.class);
		}
	}
}
