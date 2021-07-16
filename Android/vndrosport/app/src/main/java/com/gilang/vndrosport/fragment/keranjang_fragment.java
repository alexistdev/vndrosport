package com.gilang.vndrosport.fragment;

import android.content.Context;
import android.os.Bundle;

import androidx.fragment.app.Fragment;
import androidx.recyclerview.widget.LinearLayoutManager;
import androidx.recyclerview.widget.RecyclerView;

import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.Toast;

import com.gilang.vndrosport.API.APIService;
import com.gilang.vndrosport.API.NoConnectivityException;
import com.gilang.vndrosport.R;
import com.gilang.vndrosport.adapter.KeranjangAdapter;
import com.gilang.vndrosport.model.KeranjangModel;
import com.gilang.vndrosport.response.ResponseKeranjang;

import java.util.ArrayList;
import java.util.List;

import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;
import retrofit2.internal.EverythingIsNonNull;


public class keranjang_fragment extends Fragment {
	private RecyclerView gridView;
	private KeranjangAdapter keranjangAdapter;
	private List<KeranjangModel> daftarKeranjang;



	@Override
	public View onCreateView(LayoutInflater inflater, ViewGroup container,
							 Bundle savedInstanceState) {
		View mview = inflater.inflate(R.layout.fragment_keranjang, container, false);
		dataInit(mview);
		setupRecyclerView();
		setData(getContext());
		return mview;
	}

	public void setData(Context mContext)
	{
		try {
			Call<ResponseKeranjang> call = APIService.Factory.create(mContext).dapatKeranjang("1", "XiTYHklpnU");
			call.enqueue(new Callback<ResponseKeranjang>() {
				@EverythingIsNonNull
				@Override
				public void onResponse(Call<ResponseKeranjang> call, Response<ResponseKeranjang> response) {
					if(response.isSuccessful()){
						if(response.body() != null){
							daftarKeranjang = response.body().getDaftarKeranjang();
							keranjangAdapter.replaceData(daftarKeranjang);
						}
					}
				}
				@EverythingIsNonNull
				@Override
				public void onFailure(Call<ResponseKeranjang> call, Throwable t) {
					if(t instanceof NoConnectivityException) {
						pesan("Internet Offline!");
					}
				}
			});
		} catch (Exception e){
			e.printStackTrace();
			pesan(e.getMessage());
		}
	}


	private void dataInit(View mview){
		gridView = mview.findViewById(R.id.rcCart);
	}

	private void setupRecyclerView() {
		LinearLayoutManager linearLayoutManager = new LinearLayoutManager(getContext()){
			@Override
			public RecyclerView.LayoutParams generateDefaultLayoutParams() {
				return new RecyclerView.LayoutParams(ViewGroup.LayoutParams.MATCH_PARENT, ViewGroup.LayoutParams.WRAP_CONTENT);
			}
		};
		if(this.getContext() != null){
			keranjangAdapter = new KeranjangAdapter(new ArrayList<>(),getContext());
			gridView.setLayoutManager(linearLayoutManager);
			gridView.setAdapter(keranjangAdapter);
		}
	}

	private void pesan(String msg)
	{
		Toast.makeText(getContext(), msg, Toast.LENGTH_LONG).show();
	}
}
