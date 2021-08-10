package com.gilang.vndrosport.fragment;

import android.content.Context;
import android.content.Intent;
import android.os.Bundle;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.LinearLayout;
import android.widget.Toast;
import androidx.annotation.NonNull;
import androidx.annotation.Nullable;
import androidx.fragment.app.Fragment;
import androidx.recyclerview.widget.GridLayoutManager;
import androidx.recyclerview.widget.LinearLayoutManager;
import androidx.recyclerview.widget.RecyclerView;
import com.gilang.vndrosport.API.APIService;
import com.gilang.vndrosport.API.NoConnectivityException;
import com.gilang.vndrosport.R;
import com.gilang.vndrosport.adapter.ProdukAdapter;
import com.gilang.vndrosport.adapter.SpesialAdapter;
import com.gilang.vndrosport.model.ProdukModel;
import com.gilang.vndrosport.model.SpesialModel;
import com.gilang.vndrosport.page.Allproduk;
import com.gilang.vndrosport.page.Kategori;
import com.gilang.vndrosport.page.Payment;
import com.gilang.vndrosport.page.Pengiriman;
import com.gilang.vndrosport.response.ResponseProduk;
import com.gilang.vndrosport.response.ResponseSpesial;
import java.util.ArrayList;
import java.util.List;
import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;
import retrofit2.internal.EverythingIsNonNull;


public class home_fragment extends Fragment {

	private RecyclerView gridSpesial,gridProduk;
	private SpesialAdapter spesialAdapter;
	private ProdukAdapter produkAdapter;
	private List<SpesialModel> daftarSpesial;
	private List<ProdukModel> daftarProduk;
	private LinearLayout mDelivery,mPayment,mKategori,mAll;



	@Override
	public View onCreateView(@NonNull LayoutInflater inflater, @Nullable ViewGroup container, @Nullable Bundle savedInstanceState) {
		View view = inflater.inflate(R.layout.fragment_home, container, false);
		dataInit(view);
		setupRecyclerView();
		setData(getContext());
		setProduk(getContext());
		mDelivery.setOnClickListener(v -> {
			Intent intent = new Intent(getContext(), Pengiriman.class);
			startActivity(intent);
		});
		mPayment.setOnClickListener(v -> {
			Intent intent = new Intent(getContext(), Payment.class);
			startActivity(intent);
		});
		mKategori.setOnClickListener(v -> {
			Intent intent = new Intent(getContext(), Kategori.class);
			startActivity(intent);
		});
		mAll.setOnClickListener(v -> {
			Intent intent = new Intent(getContext(), Allproduk.class);
			startActivity(intent);
		});


		return view;
	}

	private void dataInit(View mview){
		gridSpesial = mview.findViewById(R.id.rcSpesial);
		gridProduk = mview.findViewById(R.id.rcProduk);
		mDelivery = mview.findViewById(R.id.pengiriman);
		mPayment = mview.findViewById(R.id.pembayaran);
		mKategori = mview.findViewById(R.id.kategori);
		mAll = mview.findViewById(R.id.allproduk);

	}

	private void setProduk(Context mContext){
		try{
			Call<ResponseProduk> call = APIService.Factory.create(mContext).produkHome();
			call.enqueue(new Callback<ResponseProduk>() {
				@EverythingIsNonNull
				@Override
				public void onResponse(Call<ResponseProduk> call, Response<ResponseProduk> response) {
					if(response.isSuccessful()){
						if(response.body() != null){
							daftarProduk = response.body().getDaftarProduk();
							produkAdapter.replaceData(daftarProduk);
						}
					}
				}

				@EverythingIsNonNull
				@Override
				public void onFailure(Call<ResponseProduk> call, Throwable t) {
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


	private void setData(Context mContext) {
		try {
			Call<ResponseSpesial> call=  APIService.Factory.create(mContext).tampilSpesial();
			call.enqueue(new Callback<ResponseSpesial>() {
				@EverythingIsNonNull
				@Override
				public void onResponse(Call<ResponseSpesial> call, Response<ResponseSpesial> response) {
					if(response.isSuccessful()){
						if(response.body() != null){
							daftarSpesial = response.body().getDaftarSpesial();
							spesialAdapter.replaceData(daftarSpesial);
						}
					}
				}
				@EverythingIsNonNull
				@Override
				public void onFailure(Call<ResponseSpesial> call, Throwable t) {
					if(t instanceof NoConnectivityException) {
						pesan("Internet Offline!");
					}
				}
			});
		} catch (Exception e) {
			e.printStackTrace();
			pesan(e.getMessage());
		}
	}

	private void setupRecyclerView() {
		LinearLayoutManager linearLayoutManager = new LinearLayoutManager(getContext(),LinearLayoutManager.HORIZONTAL,false);
		spesialAdapter = new SpesialAdapter(new ArrayList<>());
		gridSpesial.setLayoutManager(linearLayoutManager);
		gridSpesial.setAdapter(spesialAdapter);

		produkAdapter = new ProdukAdapter(new ArrayList<>(),getContext());
		gridProduk.setHasFixedSize(false);
		gridProduk.setLayoutManager(new GridLayoutManager(getContext(),2));
		gridProduk.setAdapter(produkAdapter);
	}

	@Override
	public void onResume() {
		super.onResume();
		//setupRecyclerView();
	}

	private void pesan(String msg)
	{
		Toast.makeText(getContext(), msg, Toast.LENGTH_LONG).show();
	}
}
