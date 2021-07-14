package com.gilang.vndrosport.page;

import androidx.appcompat.app.AppCompatActivity;
import androidx.appcompat.widget.Toolbar;

import android.content.Intent;
import android.os.Bundle;
import android.widget.Toast;

import com.gilang.vndrosport.R;

public class Detailproduk extends AppCompatActivity {
	private Toolbar toolbar;

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
			pesan(idProduct);
		}
	}

	private void init(){
		toolbar = findViewById(R.id.toolbar);

	}

	private void pesan(String msg)
	{
		Toast.makeText(getApplicationContext(), msg, Toast.LENGTH_LONG).show();
	}
}
