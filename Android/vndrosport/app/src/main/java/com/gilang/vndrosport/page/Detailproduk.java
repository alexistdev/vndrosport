package com.gilang.vndrosport.page;

import androidx.appcompat.app.AppCompatActivity;
import androidx.appcompat.widget.Toolbar;

import android.app.AlertDialog;
import android.app.Dialog;
import android.content.Context;
import android.content.DialogInterface;
import android.content.Intent;
import android.content.SharedPreferences;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.ImageView;
import android.widget.TextView;
import android.widget.Toast;
import com.bumptech.glide.Glide;
import com.bumptech.glide.request.RequestOptions;
import com.gilang.vndrosport.API.APIService;
import com.gilang.vndrosport.API.NoConnectivityException;
import com.gilang.vndrosport.MainActivity;
import com.gilang.vndrosport.R;
import com.gilang.vndrosport.config.Constants;
import com.gilang.vndrosport.model.KeranjangModel;
import com.gilang.vndrosport.model.ProdukModel;

import java.text.NumberFormat;
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
	private Button mBeli;


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
			mBeli.setOnClickListener(new View.OnClickListener() {
				@Override
				public void onClick(View v) {
					tambah(getApplicationContext(),idProduct);
				}
			});
		}

	}

	private void tambah(Context mContext, String idProduk)
	{
		try {
			SharedPreferences sharedPreferences = getApplicationContext().getSharedPreferences(
					Constants.KEY_USER_SESSION, Context.MODE_PRIVATE);
			String token = sharedPreferences.getString("token", "");
			String idUser = sharedPreferences.getString("idUser", "");
			Call<KeranjangModel> call = APIService.Factory.create(mContext).tambahKeranjang(idUser,token,idProduk,"1");
			call.enqueue(new Callback<KeranjangModel>() {
				@EverythingIsNonNull
				@Override
				public void onResponse(Call<KeranjangModel> call, Response<KeranjangModel> response) {
					if(response.isSuccessful()) {
						if (response.body() != null) {
							kotakPesan("Produk Berhasil ditambahkan!");
						}
					}
				}
				@EverythingIsNonNull
				@Override
				public void onFailure(Call<KeranjangModel> call, Throwable t) {
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

	private void init(){
		mBeli = findViewById(R.id.btn_beli);
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
							Locale localeID = new Locale("in", "ID");
							int harga = Integer.parseInt(response.body().getHargaProduk());
							String eHarga = NumberFormat.getNumberInstance(localeID).format(harga);

							mNamaToko.setText(response.body().getNamaToko());
							mHarga.setText(String.format("%-10s",mContext.getString(R.string.produk15) + eHarga));
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

	private void kotakPesan(String msg){
		AlertDialog alert = new AlertDialog.Builder(this).create();
		alert.setTitle("Berhasil");
		alert.setMessage(msg);
		alert.setButton(Dialog.BUTTON_POSITIVE,"OK", (dialog, which) -> {
			Intent intent = new Intent(getApplicationContext(), MainActivity.class);
			intent.putExtra("bukaKeranjang",true);
			startActivity(intent);
			finish();
		});

		alert.show();
	}

	private void pesan(String msg)
	{
		Toast.makeText(getApplicationContext(), msg, Toast.LENGTH_LONG).show();
	}


}
