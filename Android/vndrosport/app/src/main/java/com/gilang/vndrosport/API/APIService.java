package com.gilang.vndrosport.API;

import android.content.Context;
import com.gilang.vndrosport.BuildConfig;
import com.gilang.vndrosport.config.Constants;
import com.gilang.vndrosport.model.AkunModel;
import com.gilang.vndrosport.model.CheckoutModel;
import com.gilang.vndrosport.model.KeranjangModel;
import com.gilang.vndrosport.model.LoginModel;
import com.gilang.vndrosport.model.PesananModel;
import com.gilang.vndrosport.model.ProdukModel;
import com.gilang.vndrosport.model.TotalModel;
import com.gilang.vndrosport.response.ResponseKategori;
import com.gilang.vndrosport.response.ResponseKeranjang;
import com.gilang.vndrosport.response.ResponsePesanan;
import com.gilang.vndrosport.response.ResponseProduk;
import com.gilang.vndrosport.response.ResponseSpesial;

import java.util.concurrent.TimeUnit;
import okhttp3.OkHttpClient;
import okhttp3.logging.HttpLoggingInterceptor;
import retrofit2.Call;
import retrofit2.Retrofit;
import retrofit2.converter.gson.GsonConverterFactory;
import retrofit2.http.Field;
import retrofit2.http.FormUrlEncoded;
import retrofit2.http.GET;
import retrofit2.http.Headers;
import retrofit2.http.POST;
import retrofit2.http.PUT;
import retrofit2.http.Query;

public interface APIService {
	//API untuk Daftar
	@Headers({"x-api-key: 92K5wAWs7MPqY54St72HB3ETEqjvRP22"})
	@FormUrlEncoded
	@POST("api/daftar")
	Call<AkunModel> tambahUser(@Field("nama_lengkap") String namaLengkap,
							   @Field("email") String email,
							   @Field("password") String password,
							   @Field("no_telp") String noTelp);


	//API untuk kategori
	@Headers({"x-api-key: 92K5wAWs7MPqY54St72HB3ETEqjvRP22"})
	@GET("api/kategori")
	Call<ResponseKategori> dapatKategori(@Query("id_user") String idUser,
										 @Query("token") String token);

	//API untuk getAkun
	@Headers({"x-api-key: 92K5wAWs7MPqY54St72HB3ETEqjvRP22"})
	@FormUrlEncoded
	@PUT("api/akun")
	Call<AkunModel> perbaharuiAkun(@Field("id_user") String idUser,
								   @Field("token") String token,
									@Field("nama_lengkap") String nama_lengkap,
									@Field("alamat") String alamat,
									@Field("password") String password,
									@Field("no_telp") String no_telp);

	//API untuk getAkun
	@Headers({"x-api-key: 92K5wAWs7MPqY54St72HB3ETEqjvRP22"})
	@GET("api/akun")
	Call<AkunModel> tampilAkun(@Query("id_user") String idUser,
							   @Query("token") String token);

	//API untuk Checkout
	@Headers({"x-api-key: 92K5wAWs7MPqY54St72HB3ETEqjvRP22"})
	@GET("api/pesanan")
	Call<ResponsePesanan> tampilPesanan(@Query("id_user") String idUser,
										@Query("token") String token);


	//API untuk Checkout
	@Headers({"x-api-key: 92K5wAWs7MPqY54St72HB3ETEqjvRP22"})
	@FormUrlEncoded
	@POST("api/checkout")
	Call<CheckoutModel> simpanPesanan(@Field("id_user") String idUser,
									  @Field("token") String token);

	//API untuk login
	@Headers({"x-api-key: 92K5wAWs7MPqY54St72HB3ETEqjvRP22"})
	@FormUrlEncoded
	@POST("api/Auth")
	Call<LoginModel> loginUser(@Field("email") String email,
							   @Field("password") String password);

	/* Mendapatkan API Semua produk */
	@Headers({"x-api-key: 92K5wAWs7MPqY54St72HB3ETEqjvRP22"})
	@GET("api/produk")
	Call<ResponseProduk> produkHome(@Query("id_toko") String idToko);

	/* Mendapatkan API Produk per kategori */
	@Headers({"x-api-key: 92K5wAWs7MPqY54St72HB3ETEqjvRP22"})
	@GET("api/kategori/q")
	Call<ResponseProduk> produkKategori(@Query("id_user") String idUser,
										@Query("token") String token,
										@Query("id_kategori") String idKategori);

	/* Mendapatkan API Berita */
	@Headers({"x-api-key: 92K5wAWs7MPqY54St72HB3ETEqjvRP22"})
	@GET("api/spesial")
	Call<ResponseSpesial> tampilSpesial();

	/* Mendapatkan API Berita */
	@Headers({"x-api-key: 92K5wAWs7MPqY54St72HB3ETEqjvRP22"})
	@GET("api/produk/detail")
	Call<ProdukModel> tampilDetail(@Query("id") String idProduk);


	/* Mendapatkan Keranjang */
	@Headers({"x-api-key: 92K5wAWs7MPqY54St72HB3ETEqjvRP22"})
	@GET("api/keranjang")
	Call<ResponseKeranjang> dapatKeranjang(@Query("id_user") String idUser,
										   @Query("token") String token);

	/* Mendapatkan Total Keranjang */
	@Headers({"x-api-key: 92K5wAWs7MPqY54St72HB3ETEqjvRP22"})
	@GET("api/keranjang/total")
	Call<TotalModel> dataTotal(@Query("id_user") String idUser,
									@Query("token") String token);

	/* Menambah Produk */
	@FormUrlEncoded
	@Headers({"x-api-key: 92K5wAWs7MPqY54St72HB3ETEqjvRP22"})
	@POST("api/keranjang")
	Call<KeranjangModel> tambahKeranjang(@Field("id_user") String idUser,
									@Field("token") String mytoken,
									@Field("idProduk") String idProduk,
									@Field("jumlah") String jumlah);

	/* Menambah Produk */
	@FormUrlEncoded
	@Headers({"x-api-key: 92K5wAWs7MPqY54St72HB3ETEqjvRP22"})
	@PUT("api/keranjang")
	Call<KeranjangModel> updateKeranjang(@Field("id_user") String idUser,
										 @Field("token") String token,
										 @Field("idProduk") String idProduk,
										 @Field("opsi") String opsi);


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
