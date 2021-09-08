package com.gilang.vndrosport.page;

import androidx.appcompat.app.AppCompatActivity;
import androidx.appcompat.widget.Toolbar;

import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.Toast;

import com.gilang.vndrosport.API.APIService;
import com.gilang.vndrosport.API.NoConnectivityException;
import com.gilang.vndrosport.MainActivity;
import com.gilang.vndrosport.R;
import com.gilang.vndrosport.model.PesananModel;

import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;
import retrofit2.internal.EverythingIsNonNull;

public class Payment extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_payment);
        Button mBayar = findViewById(R.id.btn_bayar);
		Toolbar toolbar = findViewById(R.id.tbtoolbar);
		setSupportActionBar(toolbar);
		if (getSupportActionBar() != null) {
			setTitle("Informasi Pembayaran");
			getSupportActionBar().setDisplayHomeAsUpEnabled(true);
			getSupportActionBar().setDisplayShowTitleEnabled(true);
		}
		Intent iin= getIntent();
		Bundle extra = iin.getExtras();
		if(extra != null){
			final String idPesanan = extra.getString("idPesanan","0");
			if(idPesanan != null && !idPesanan.isEmpty()){
				mBayar.setVisibility(View.VISIBLE);
				mBayar.setOnClickListener(v -> {
					try{
						Call<PesananModel> call= APIService.Factory.create(getApplicationContext()).bayar(idPesanan);
						call.enqueue(new Callback<PesananModel>() {
							@EverythingIsNonNull
							@Override
							public void onResponse(Call<PesananModel> call, Response<PesananModel> response) {
								if(response.isSuccessful()) {
									if (response.body() != null) {
										Intent mIntent = new Intent(Payment.this, MainActivity.class);
										startActivity(mIntent);
										finish();
										pesan("Pesanan berhasil dikonfirmasi");
									}
								}
							}
							@EverythingIsNonNull
							@Override
							public void onFailure(Call<PesananModel> call, Throwable t) {
								if(t instanceof NoConnectivityException) {
									pesan("Internet Offline!");
								}
							}
						});
					}catch (Exception e){
						e.printStackTrace();
						pesan(e.getMessage());
					}
				});
			}
		}
    }

	private void pesan(String msg)
	{
		Toast.makeText(getApplicationContext(), msg, Toast.LENGTH_LONG).show();
	}
}
