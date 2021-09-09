package com.gilang.vndrosport.fragment;

import android.content.Context;
import android.content.Intent;
import android.content.SharedPreferences;
import android.graphics.Color;
import android.os.Bundle;
import androidx.fragment.app.Fragment;
import androidx.recyclerview.widget.LinearLayoutManager;
import androidx.recyclerview.widget.RecyclerView;

import android.util.Log;
import android.view.Gravity;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.Button;
import android.widget.LinearLayout;
import android.widget.TextView;
import android.widget.Toast;
import com.gilang.vndrosport.API.APIService;
import com.gilang.vndrosport.API.NoConnectivityException;
import com.gilang.vndrosport.MainActivity;
import com.gilang.vndrosport.R;
import com.gilang.vndrosport.adapter.KeranjangAdapter;
import com.gilang.vndrosport.config.Constants;
import com.gilang.vndrosport.model.CheckoutModel;
import com.gilang.vndrosport.model.KeranjangModel;
import com.gilang.vndrosport.model.TotalModel;
import com.gilang.vndrosport.page.login;
import com.gilang.vndrosport.response.ResponseKeranjang;
import java.text.NumberFormat;
import java.util.ArrayList;
import java.util.List;
import java.util.Locale;
import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;
import retrofit2.internal.EverythingIsNonNull;


public class keranjang_fragment extends Fragment implements KeranjangAdapter.ClickListener{

	private RecyclerView gridView;
	private KeranjangAdapter keranjangAdapter;
	private List<KeranjangModel> daftarKeranjang;
	private LinearLayout layoutpesankosong,mLayoutTotal,mlayoutAlamat,mlayouttombol;
	private TextView mSubTotal,mBiayaAntar,mTotalBiaya,mNamaLengkap,mNoTelp,mAlamat;
	private Button mCheckout;


	@Override
	public View onCreateView(LayoutInflater inflater, ViewGroup container,
							 Bundle savedInstanceState) {
		View mview = inflater.inflate(R.layout.fragment_keranjang, container, false);
		dataInit(mview);
		SharedPreferences sharedPreferences = requireContext().getSharedPreferences(
				Constants.KEY_USER_SESSION, Context.MODE_PRIVATE);
		String token = sharedPreferences.getString("token", "");
		String idUser = sharedPreferences.getString("idUser", "");

		setupRecyclerView();
		setData(getContext());
		setTotal(getContext());
		mCheckout.setOnClickListener(v -> checkout(getContext(),idUser,token));
		return mview;
	}

	private void checkout(Context mContext, String idUser, String token) {
		try {
			Call<CheckoutModel> check = APIService.Factory.create(mContext).simpanPesanan(idUser,token);
			check.enqueue(new Callback<CheckoutModel>() {
				@EverythingIsNonNull
				@Override
				public void onResponse(Call<CheckoutModel> call, Response<CheckoutModel> response) {
					if(response.isSuccessful()) {
						if (response.body() != null) {
							Intent intent = new Intent(getContext(), MainActivity.class);
							intent.putExtra("bukaOrder",true);
							startActivity(intent);
							pesan2("Anda berhasil checkout");
						}
					}
				}
				@EverythingIsNonNull
				@Override
				public void onFailure(Call<CheckoutModel> call, Throwable t) {
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

	@Override
	public void onResume() {
		super.onResume();
		setupRecyclerView();
		setData(getContext());
		setTotal(getContext());
		keranjangAdapter.notifyDataSetChanged();
	}

	private void tidakTampil(){
		mLayoutTotal.setVisibility(View.GONE);
		mlayoutAlamat.setVisibility(View.GONE);
		mlayouttombol.setVisibility(View.GONE);
		layoutpesankosong.setVisibility(View.VISIBLE);
	}
	private void tampilKotak(){
		mLayoutTotal.setVisibility(View.VISIBLE);
		mlayoutAlamat.setVisibility(View.VISIBLE);
		mlayouttombol.setVisibility(View.VISIBLE);
		layoutpesankosong.setVisibility(View.INVISIBLE);
	}

	private void setTotal(Context mContext){
		try{
			SharedPreferences sharedPreferences = requireContext().getSharedPreferences(
					Constants.KEY_USER_SESSION, Context.MODE_PRIVATE);
			String token = sharedPreferences.getString("token", "");
			String idUser = sharedPreferences.getString("idUser", "");
			Call<TotalModel> call = APIService.Factory.create(mContext).dataTotal(idUser, token);
			call.enqueue(new Callback<TotalModel>() {
				@EverythingIsNonNull
				@Override
				public void onResponse(Call<TotalModel> call, Response<TotalModel> response) {
					if(response.isSuccessful()){
						if(response.body() != null){
							Locale localeID = new Locale("in", "ID");
							String eSubTotal = NumberFormat.getNumberInstance(localeID).format(Integer.parseInt(response.body().getSubTotal()));
							String eBiayaAntar = NumberFormat.getNumberInstance(localeID).format(Integer.parseInt(response.body().getBiayaAntar()));
							String eTotalBiaya = NumberFormat.getNumberInstance(localeID).format(Integer.parseInt(response.body().getTotalBiaya()));
							mSubTotal.setText(String.format("%s%s",getResources().getString(R.string.cart16),eSubTotal));
							mBiayaAntar.setText(String.format("%s%s",getResources().getString(R.string.cart16),eBiayaAntar));
							mTotalBiaya.setText(String.format("%s%s",getResources().getString(R.string.cart16),eTotalBiaya));
							mNamaLengkap.setText(response.body().getNamaLengkap());
							mNoTelp.setText(response.body().getNoTelp());
							mAlamat.setText(response.body().getAlamat());

						}
					}
				}
				@EverythingIsNonNull
				@Override
				public void onFailure(Call<TotalModel> call, Throwable t) {
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

	public void setData(Context mContext)
	{
		try {
			SharedPreferences sharedPreferences = requireContext().getSharedPreferences(
					Constants.KEY_USER_SESSION, Context.MODE_PRIVATE);
			String token = sharedPreferences.getString("token", "");
			String idUser = sharedPreferences.getString("idUser", "");
			Call<ResponseKeranjang> call = APIService.Factory.create(mContext).dapatKeranjang(idUser, token);
			call.enqueue(new Callback<ResponseKeranjang>() {
				@EverythingIsNonNull
				@Override
				public void onResponse(Call<ResponseKeranjang> call, Response<ResponseKeranjang> response) {
					if(response.isSuccessful()){
						if(response.body() != null){
							daftarKeranjang = response.body().getDaftarKeranjang();
							keranjangAdapter.replaceData(daftarKeranjang);
							tampilKotak();
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
		mCheckout = mview.findViewById(R.id.btnCheckout);
		mAlamat = mview.findViewById(R.id.tvAlamat);
		mNoTelp = mview.findViewById(R.id.tvTelepon);
		mNamaLengkap = mview.findViewById(R.id.tvNamaPengguna);
		mTotalBiaya = mview.findViewById(R.id.tvTotalBiaya);
		mBiayaAntar = mview.findViewById(R.id.tvBiayaAntar);
		mSubTotal = mview.findViewById(R.id.tvSubTotal);
		mlayouttombol = mview.findViewById(R.id.layoutTombolCheckout);
		mlayoutAlamat =  mview.findViewById(R.id.layoutAlamat);
		mLayoutTotal = mview.findViewById(R.id.layoutTotal);
		layoutpesankosong = mview.findViewById(R.id.layoutkeranjang);
		gridView = mview.findViewById(R.id.rcCart);
		tidakTampil();
	}

	private void setupRecyclerView() {
		LinearLayoutManager linearLayoutManager = new LinearLayoutManager(getContext()){
			@Override
			public RecyclerView.LayoutParams generateDefaultLayoutParams() {
				return new RecyclerView.LayoutParams(ViewGroup.LayoutParams.MATCH_PARENT, ViewGroup.LayoutParams.WRAP_CONTENT);
			}
		};
		if(this.getContext() != null){
			keranjangAdapter = new KeranjangAdapter(getContext(),new ArrayList<>(),this::dataItemKeranjang);
			gridView.setLayoutManager(linearLayoutManager);
			gridView.setAdapter(keranjangAdapter);
		}
	}

	@Override
	public void dataItemKeranjang(String idProduk, String Opsi, String msg) {
		if(!Opsi.equals("3")){
			memperbaharuiKeranjang(idProduk,Opsi, msg);
		} else{
			menghapusProduk(idProduk,msg);
		}

	}

	public void menghapusProduk(String idProduk, String msg)
	{
		SharedPreferences sharedPreferences = requireContext().getSharedPreferences(
				Constants.KEY_USER_SESSION, Context.MODE_PRIVATE);
		String token = sharedPreferences.getString("token", "");
		String idUser = sharedPreferences.getString("idUser", "");
		Call<KeranjangModel> call = APIService.Factory.create(getContext()).hapusProduk(idUser,token,idProduk);
		call.enqueue(new Callback<KeranjangModel>() {
			@EverythingIsNonNull
			@Override
			public void onResponse(Call<KeranjangModel> call, Response<KeranjangModel> response) {
				if(response.isSuccessful()) {
					if (response.body() != null) {
						if(response.body().getMessage().equals("Keranjang Kosong")){
							pesan(msg);
							setupRecyclerView();
							setData(getContext());
							tidakTampil();
						} else {
							pesan(msg);
							setupRecyclerView();
							setData(getContext());
							setTotal(getContext());
						}
					}
				}
			}
			@EverythingIsNonNull
			@Override
			public void onFailure(Call<KeranjangModel> call, Throwable t) {
				Log.e("Retrofit Get", t.toString());
			}
		});
	}


	public void memperbaharuiKeranjang(String idProduk, String Opsi, String msg)
	{
		SharedPreferences sharedPreferences = requireContext().getSharedPreferences(
				Constants.KEY_USER_SESSION, Context.MODE_PRIVATE);
		String token = sharedPreferences.getString("token", "");
		String idUser = sharedPreferences.getString("idUser", "");
		Call<KeranjangModel> call = APIService.Factory.create(getContext()).updateKeranjang(idUser,token,idProduk,Opsi);
		call.enqueue(new Callback<KeranjangModel>() {
			@EverythingIsNonNull
			@Override
			public void onResponse(Call<KeranjangModel> call, Response<KeranjangModel> response) {
				pesan(msg);
				setData(getContext());
				setTotal(getContext());
			}
			@EverythingIsNonNull
			@Override
			public void onFailure(Call<KeranjangModel> call, Throwable t) {
				Log.e("Retrofit Get", t.toString());
			}
		});
	}

	private void pesan(String msg){
		Toast toast = Toast.makeText(getActivity(), msg, Toast.LENGTH_SHORT);
		View view = toast.getView();
		TextView  view1=(TextView)view.findViewById(android.R.id.message);
		view1.setTextColor(Color.WHITE);
		view.setBackgroundResource(R.color.warnaPesanToast);
		toast.setGravity(Gravity.CENTER, 0,0);
		toast.show();
	}
	private void pesan2(String msg)
	{
		Toast.makeText(getContext(), msg, Toast.LENGTH_LONG).show();
	}
}
