package com.gilang.vndrosport.adapter;

import android.annotation.SuppressLint;
import android.content.Context;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ImageView;
import android.widget.TextView;
import android.widget.Toast;

import androidx.annotation.NonNull;
import androidx.recyclerview.widget.RecyclerView;

import com.bumptech.glide.Glide;
import com.bumptech.glide.request.RequestOptions;
import com.gilang.vndrosport.API.APIService;
import com.gilang.vndrosport.R;
import com.gilang.vndrosport.config.Constants;
import com.gilang.vndrosport.model.KeranjangModel;


import java.text.NumberFormat;
import java.util.List;
import java.util.Locale;

import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;
import retrofit2.internal.EverythingIsNonNull;

public class KeranjangAdapter extends RecyclerView.Adapter<KeranjangAdapter.MyKeranjangHolder> {
	public KeranjangAdapter.ClickListener clickListener;
	public List<KeranjangModel> mKeranjangList;
	private final Context context;

	public KeranjangAdapter(Context context, List<KeranjangModel> daftarKeranjang,ClickListener clickListener) {
		this.clickListener = clickListener;
		this.mKeranjangList = daftarKeranjang;
		this.context = context;
	}

	@NonNull
	@Override
	public KeranjangAdapter.MyKeranjangHolder onCreateViewHolder(@NonNull ViewGroup parent, int viewType) {
		View mView = LayoutInflater.from(parent.getContext()).inflate(R.layout.single_list_keranjang, parent, false);
		KeranjangAdapter.MyKeranjangHolder holder;
		holder = new KeranjangAdapter.MyKeranjangHolder(mView);
		return holder;
	}

	@Override
	public void onBindViewHolder (@NonNull KeranjangAdapter.MyKeranjangHolder holder, final int position){
		Glide.with(context)
				.load(Constants.IMAGES_URL+mKeranjangList.get(position).getGambarProduk())
				.apply(new RequestOptions().error(R.drawable.no_image))
				.into(MyKeranjangHolder.mGambar);
		Locale localeID = new Locale("in", "ID");
		int harga = Integer.parseInt(mKeranjangList.get(position).getSubTotal());
		String eHarga = NumberFormat.getNumberInstance(localeID).format(harga);
		holder.mJudul.setText(mKeranjangList.get(position).getNamaProduk());
		holder.mharga.setText(String.format("%s%s",holder.itemView.getContext().getString(R.string.cart16),eHarga));
		holder.mJumlah.setText(mKeranjangList.get(position).getJumlahProduk());
		MyKeranjangHolder.mAdd.setOnClickListener(v -> {
			String idpr= mKeranjangList.get(position).getIdProduk();
			Call<KeranjangModel> call = APIService.Factory.create(context).updateKeranjang("1","XiTYHklpnU",idpr,"1");
			call.enqueue(new Callback<KeranjangModel>() {
				@EverythingIsNonNull
				@Override
				public void onResponse(Call<KeranjangModel> call, Response<KeranjangModel> response) {
					try {
						clickListener.dataItemKeranjang("Produk berhasil ditambahkan !");
					} catch (Exception e){
						e.printStackTrace();
					}
				}
				@EverythingIsNonNull
				@Override
				public void onFailure(Call<KeranjangModel> call, Throwable t) {
					Log.e("Retrofit Get", t.toString());
				}
			});
		});
		MyKeranjangHolder.mMin.setOnClickListener(v -> {
			int dataJumlah = Integer.parseInt(mKeranjangList.get(position).getJumlahProduk());
			if(dataJumlah > 1) {
				String idpr = mKeranjangList.get(position).getIdProduk();
				Call<KeranjangModel> call = APIService.Factory.create(context).updateKeranjang("1", "XiTYHklpnU", idpr, "2");
				call.enqueue(new Callback<KeranjangModel>() {
					@EverythingIsNonNull
					@Override
					public void onResponse(Call<KeranjangModel> call, Response<KeranjangModel> response) {
						try {
							clickListener.dataItemKeranjang("Produk berhasil dikurangi !");
						} catch (Exception e) {
							e.printStackTrace();
						}
					}

					@EverythingIsNonNull
					@Override
					public void onFailure(Call<KeranjangModel> call, Throwable t) {
						Log.e("Retrofit Get", t.toString());
					}
				});
			}else{
				try {
					clickListener.dataItemKeranjang("Minimum pembelian adalah 1");
				} catch (Exception e){
					e.printStackTrace();
				}
			}
		});
	}

	@Override
	public int getItemCount () {
		return mKeranjangList.size();
	}

	public void replaceData(List<KeranjangModel> dataKeranjang) {
		this.mKeranjangList = dataKeranjang;
		notifyDataSetChanged();
	}

	public static class MyKeranjangHolder extends RecyclerView.ViewHolder {
		@SuppressLint("StaticFieldLeak")
		private static ImageView mGambar,mAdd,mMin;
		private final TextView mJudul,mharga,mJumlah;



		MyKeranjangHolder(@NonNull View itemView) {
			super(itemView);
			mGambar = itemView.findViewById(R.id.imgCart);
			mAdd = itemView.findViewById(R.id.addCart);
			mMin = itemView.findViewById(R.id.minCart);
			mJudul = itemView.findViewById(R.id.titleCart);
			mharga = itemView.findViewById(R.id.hargaCart);
			mJumlah = itemView.findViewById(R.id.qtyCart);

		}
	}

	public interface ClickListener{
		void dataItemKeranjang(String msg);
	}
}
