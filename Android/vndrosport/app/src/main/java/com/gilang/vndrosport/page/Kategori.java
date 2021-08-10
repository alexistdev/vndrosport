package com.gilang.vndrosport.page;

import androidx.appcompat.app.AppCompatActivity;
import androidx.appcompat.widget.Toolbar;
import androidx.recyclerview.widget.LinearLayoutManager;
import androidx.recyclerview.widget.RecyclerView;
import android.app.ProgressDialog;
import android.content.Context;
import android.content.SharedPreferences;
import android.os.Bundle;
import android.view.ViewGroup;
import android.widget.Toast;
import com.gilang.vndrosport.API.APIService;
import com.gilang.vndrosport.API.NoConnectivityException;
import com.gilang.vndrosport.R;
import com.gilang.vndrosport.adapter.KategoriAdapter;
import com.gilang.vndrosport.config.Constants;
import com.gilang.vndrosport.model.KategoriModel;
import com.gilang.vndrosport.response.ResponseKategori;
import java.util.ArrayList;
import java.util.List;
import okhttp3.internal.annotations.EverythingIsNonNull;
import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;

public class Kategori extends AppCompatActivity {
	private RecyclerView gridView;
	private KategoriAdapter kategoriAdapter;
	private List<KategoriModel> daftarKategori;
	private ProgressDialog progressDialog;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_kategori);
		Toolbar toolbar = findViewById(R.id.tbtoolbar);
		setSupportActionBar(toolbar);
		if (getSupportActionBar() != null) {
			setTitle("Kategori");
			getSupportActionBar().setDisplayHomeAsUpEnabled(true);
			getSupportActionBar().setDisplayShowTitleEnabled(true);
		}
		SharedPreferences sharedPreferences = getApplicationContext().getSharedPreferences(
				Constants.KEY_USER_SESSION, Context.MODE_PRIVATE);
		String token = sharedPreferences.getString("token", "");
		String idUser = sharedPreferences.getString("idUser", "");
		initData();
		setupRecyclerView();
		setData(getApplicationContext(),token,idUser);
    }

	private void initData(){
		progressDialog = ProgressDialog.show(this, "", "Loading.....", true, false);
		gridView = findViewById(R.id.rcKategori);
	}

	private void setupRecyclerView() {
		LinearLayoutManager linearLayoutManager = new LinearLayoutManager(getApplicationContext()){
			@Override
			public RecyclerView.LayoutParams generateDefaultLayoutParams() {
				return new RecyclerView.LayoutParams(ViewGroup.LayoutParams.MATCH_PARENT, ViewGroup.LayoutParams.WRAP_CONTENT);
			}
		};
		kategoriAdapter = new KategoriAdapter(new ArrayList<>());
		gridView.setLayoutManager(linearLayoutManager);
		gridView.setAdapter(kategoriAdapter);
	}

	public void setData(Context mContext,String token,String idUser) {
		try{
			Call<ResponseKategori> call = APIService.Factory.create(mContext).dapatKategori(idUser,token);
			call.enqueue(new Callback<ResponseKategori>() {
				@EverythingIsNonNull
				@Override
				public void onResponse(Call<ResponseKategori> call, Response<ResponseKategori> response) {
					progressDialog.dismiss();
					if(response.isSuccessful()){
						if(response.body() != null){
							daftarKategori = response.body().getDaftarKategori();
							kategoriAdapter.replaceData(daftarKategori);
						}
					}
				}
				@EverythingIsNonNull
				@Override
				public void onFailure(Call<ResponseKategori> call, Throwable t) {
					if(t instanceof NoConnectivityException) {
						progressDialog.dismiss();
						pesan("Offline, cek koneksi internet anda!");
					}
				}
			});
		} catch (Exception e){
			progressDialog.dismiss();
			e.printStackTrace();
		}
	}
	public void pesan(String msg)
	{
		Toast.makeText(this, msg, Toast.LENGTH_LONG).show();
	}
}
