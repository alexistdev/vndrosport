package com.gilang.vndrosport.page;

import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;

import com.gilang.vndrosport.MainActivity;
import com.gilang.vndrosport.R;

public class Success extends AppCompatActivity {

	@Override
	protected void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.activity_success);
		Button mBack = findViewById(R.id.btn_kembali);

		mBack.setOnClickListener(v -> {
			Intent intent = new Intent(getApplicationContext(), MainActivity.class);
			intent.putExtra("bukOrder",true);
			startActivity(intent);
			finish();
		});
	}
}
