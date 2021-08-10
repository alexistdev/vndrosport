package com.gilang.vndrosport.fragment;

import android.content.Context;
import android.content.SharedPreferences;
import android.os.Bundle;

import androidx.fragment.app.Fragment;
import androidx.recyclerview.widget.LinearLayoutManager;
import androidx.recyclerview.widget.RecyclerView;

import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ProgressBar;
import android.widget.RelativeLayout;
import android.widget.Toast;

import com.gilang.vndrosport.API.APIService;
import com.gilang.vndrosport.API.NoConnectivityException;
import com.gilang.vndrosport.R;
import com.gilang.vndrosport.adapter.PesananAdapter;
import com.gilang.vndrosport.config.Constants;
import com.gilang.vndrosport.model.PesananModel;
import com.gilang.vndrosport.response.ResponsePesanan;

import java.util.ArrayList;
import java.util.List;

import okhttp3.internal.annotations.EverythingIsNonNull;
import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;


public class order_fragment extends Fragment {
	private RecyclerView gridPesanan;
	private PesananAdapter pesananAdapter;
	private List<PesananModel> daftarPesanan;
	private ProgressBar progressBar;


	@Override
	public void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
	}

	@Override
	public View onCreateView(LayoutInflater inflater, ViewGroup container,
							 Bundle savedInstanceState) {

		View view = inflater.inflate(R.layout.fragment_order, container, false);
		SharedPreferences sharedPreferences = requireContext().getSharedPreferences(
				Constants.KEY_USER_SESSION, Context.MODE_PRIVATE);
		String token = sharedPreferences.getString("token", "");
		String idUser = sharedPreferences.getString("idUser", "");
		dataInit(view);
		setupRecyclerView();
		setData(getContext(),idUser,token);
		return view;
	}

	@Override
	public void onResume() {
		super.onResume();
		//setupRecyclerView();
	}

	private void setData(Context context,String idUser, String token){
		try {
			Call<ResponsePesanan> pesanan = APIService.Factory.create(context).tampilPesanan(idUser,token);
			pesanan.enqueue(new Callback<ResponsePesanan>() {
				@EverythingIsNonNull
				@Override
				public void onResponse(Call<ResponsePesanan> call, Response<ResponsePesanan> response) {
					progressBar.setVisibility(View.GONE);
					if(response.isSuccessful()){
						if(response.body() != null){
							daftarPesanan = response.body().getDaftarPesanan();
							pesananAdapter.replaceData(daftarPesanan);
						}
					}
				}
				@EverythingIsNonNull
				@Override
				public void onFailure(Call<ResponsePesanan> call, Throwable t) {
					progressBar.setVisibility(View.GONE);
					if(t instanceof NoConnectivityException) {
						pesan("Internet Offline!");
					}
				}
			});
		} catch (Exception e){
			progressBar.setVisibility(View.GONE);
			e.printStackTrace();
			pesan(e.getMessage());
		}
	}

	private void dataInit(View mView){
		gridPesanan = mView.findViewById(R.id.rcPesanan);
		RelativeLayout pLayout = mView.findViewById(R.id.layout_utama);
		progressBar = new ProgressBar(getContext(), null, android.R.attr.progressBarStyleLarge);
		progressBar.getIndeterminateDrawable().setColorFilter(0xFFFF0000, android.graphics.PorterDuff.Mode.MULTIPLY);
		progressBar.setVisibility(View.VISIBLE);
		RelativeLayout.LayoutParams params = new RelativeLayout.LayoutParams(200, 200);
		params.addRule(RelativeLayout.CENTER_IN_PARENT);
		pLayout.addView(progressBar, params);
	}

	private void setupRecyclerView() {
		LinearLayoutManager linearLayoutManager = new LinearLayoutManager(getContext()){
			@Override
			public RecyclerView.LayoutParams generateDefaultLayoutParams() {
				return new RecyclerView.LayoutParams(ViewGroup.LayoutParams.MATCH_PARENT, ViewGroup.LayoutParams.WRAP_CONTENT);
			}
		};

		pesananAdapter = new PesananAdapter(new ArrayList<>());
		gridPesanan.setLayoutManager(linearLayoutManager);
		gridPesanan.setAdapter(pesananAdapter);
	}

	private void pesan(String msg)
	{
		Toast.makeText(getContext(), msg, Toast.LENGTH_LONG).show();
	}
}
