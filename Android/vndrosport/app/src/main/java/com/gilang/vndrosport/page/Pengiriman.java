package com.gilang.vndrosport.page;

import androidx.appcompat.app.AppCompatActivity;
import androidx.appcompat.widget.Toolbar;

import android.os.Bundle;

import com.gilang.vndrosport.R;

public class Pengiriman extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_pengiriman);
		Toolbar toolbar = findViewById(R.id.tbtoolbar);
		setSupportActionBar(toolbar);
		if (getSupportActionBar() != null) {
			setTitle("Detail Pengiriman");
			getSupportActionBar().setDisplayHomeAsUpEnabled(true);
			getSupportActionBar().setDisplayShowTitleEnabled(true);
		}
    }
}
