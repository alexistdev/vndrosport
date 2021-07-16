package com.gilang.vndrosport.page;

import androidx.appcompat.app.AppCompatActivity;
import androidx.appcompat.widget.Toolbar;
import android.content.Context;
import android.content.Intent;
import android.os.Bundle;
import android.widget.ImageView;
import android.widget.TextView;
import android.widget.Toast;
import com.bumptech.glide.Glide;
import com.bumptech.glide.request.RequestOptions;
import com.gilang.vndrosport.API.APIService;
import com.gilang.vndrosport.API.NoConnectivityException;
import com.gilang.vndrosport.R;
import com.gilang.vndrosport.config.Constants;
import com.gilang.vndrosport.model.ProdukModel;
import java.text.SimpleDateFormat;
import java.util.Date;
import java.util.Locale;
import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;
import retrofit2.internal.EverythingIsNonNull;

public class Detailproduk extends AppCompatActivity {
	private Toolbar toolbar;
	private ImageView mGambar;
	private TextView mNamaToko, mOnline,mHarga,mMerek,mKategori,mUkuran,mWarna,mDeskripsi;

	@Override
	protected void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.activity_detailproduk);

		init();
		setSupportActionBar(toolbar);
		if (getSupportActionBar() != null) {
			getSupportActionBar().setTitle("Detail Produk");
			getSupportActionBar().setDisplayHomeAsUpEnabled(true);
			getSupportActionBar().setDisplayShowTitleEnabled(true);
		}

		Intent iin= getIntent();
		Bundle extra = iin.getExtras();
		if(extra != null){
			final String idProduct = extra.getString("idProduk","0");
			setData(getApplicationContext(),idProduct);
		}
	}

	private void init(){
		toolbar = findViewById(R.id.toolbar);
		mGambar = findViewById(R.id.gbr_product);
		mNamaToko = findViewById(R.id.txt_namaToko);
		mOnline = findViewById(R.id.txt_online);
		mHarga = findViewById(R.id.txt_harga);
		mMerek = findViewById(R.id.txt_merek);
		mKategori = findViewById(R.id.txt_kategori);
		mUkuran = findViewById(R.id.txt_ukuran);
		mWarna = findViewById(R.id.txt_warna);
		mDeskripsi = findViewById(R.id.txt_deskripsi);
	}

	private void setData(Context mContext, String idProduct){
		try{
			Call<ProdukModel> call= APIService.Factory.create(mContext).tampilDetail(idProduct);
			call.enqueue(new Callback<ProdukModel>() {

				@EverythingIsNonNull
				@Override
				public void onResponse(Call<ProdukModel> call, Response<ProdukModel> response) {
					if(response.isSuccessful()) {
						if (response.body() != null) {
							mNamaToko.setText(response.body().getNamaToko());
							mHarga.setText(String.format("%-10s",mContext.getString(R.string.produk15) +response.body().getHargaProduk()));
							mMerek.setText(String.format("%-10s",mContext.getString(R.string.produk10) +response.body().getNamaMerek()));
							mKategori.setText(String.format("%-10s",mContext.getString(R.string.produk11) +response.body().getNamaKategori()));
							mUkuran.setText(String.format("%-10s",mContext.getString(R.string.produk12) +response.body().getUkuranProduk()));
							mWarna.setText(String.format("%-10s",mContext.getString(R.string.produk13) +response.body().getWarnaProduk()));
							mDeskripsi.setText(response.body().getDeskripsiProduk());
							Glide.with(mContext)
									.load(Constants.IMAGES_URL+response.body().getGambarProduk())
									.apply(new RequestOptions().error(R.drawable.no_image))
									.into(mGambar);

							//last-online
							String lastOnline = response.body().getLastOnline();
							Date Dibuat = new Date(Long.parseLong(lastOnline) * 1000);
							SimpleDateFormat formatter = new SimpleDateFormat("EEE, d MMM yyyy HH:mm:ss", Locale.getDefault());
							String date = formatter.format(Dibuat);
							mOnline.setText(String.format("%-10s",mContext.getString(R.string.produk14) + date));
						}
					}
				}

				@EverythingIsNonNull
				@Override
				public void onFailure(Call<ProdukModel> call, Throwable t) {
					if(t instanceof NoConnectivityException) {
						pesan("Internet Offline!");
					}
				}
			});

		}catch (Exception e){
			e.printStackTrace();
			pesan(e.getMessage());
		}
	}

	private void pesan(String msg)
	{
		Toast.makeText(getApplicationContext(), msg, Toast.LENGTH_LONG).show();
	}


}
