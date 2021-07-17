package com.gilang.vndrosport;

import androidx.appcompat.app.AppCompatActivity;
import androidx.fragment.app.Fragment;

import android.os.Bundle;

import com.gilang.vndrosport.fragment.akun_fragment;
import com.gilang.vndrosport.fragment.home_fragment;
import com.gilang.vndrosport.fragment.keranjang_fragment;
import com.gilang.vndrosport.fragment.order_fragment;
import com.google.android.material.bottomnavigation.BottomNavigationView;

public class MainActivity extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);
		loadFragment(new home_fragment());
		/* Mengatur Menu bottom bar */
		BottomNavigationView bottomNavigationView = findViewById(R.id.bottomMenu);
		bottomNavigationView.setOnNavigationItemSelectedListener(item -> {
			Fragment fragment = null;
			switch (item.getItemId()){
				case R.id.home_menu:
					fragment = new home_fragment();
					break;
				case R.id.history_menu:
					fragment = new order_fragment();
					break;
				case R.id.keranjang_menu:
					fragment = new keranjang_fragment();
					break;
				default:
					fragment = new akun_fragment();
			}
			return loadFragment(fragment);
		});

		Bundle extras = getIntent().getExtras();
		if(extras!=null && extras.containsKey("bukaKeranjang")) {
			boolean bukaKeranjang = extras.getBoolean("bukaKeranjang");
			if(bukaKeranjang){
				Fragment fragment = null;
				fragment = new keranjang_fragment();
				loadFragment(fragment);
			}
		}
    }

	private boolean loadFragment(Fragment fragment) {
		if (fragment != null) {
			getSupportFragmentManager().beginTransaction()
					.replace(R.id.fl_container, fragment)
					.commit();
			return true;
		}
		return false;
	}


}
