package com.gilang.vndrosport.adapter;

import android.annotation.SuppressLint;
import android.content.Context;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ImageView;
import android.widget.TextView;
import androidx.annotation.NonNull;
import androidx.recyclerview.widget.RecyclerView;

import com.bumptech.glide.Glide;
import com.bumptech.glide.request.RequestOptions;
import com.gilang.vndrosport.R;
import com.gilang.vndrosport.config.Constants;
import com.gilang.vndrosport.model.KeranjangModel;


import java.util.List;

public class KeranjangAdapter extends RecyclerView.Adapter<KeranjangAdapter.MyKeranjangHolder> {
	public List<KeranjangModel> mKeranjangList;
	private final Context context;

	public KeranjangAdapter(List<KeranjangModel> mKeranjangList, Context context) {
		this.mKeranjangList = mKeranjangList;
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
		holder.mJudul.setText(mKeranjangList.get(position).getNamaProduk());
		holder.mharga.setText(mKeranjangList.get(position).getSubTotal());
		holder.mJumlah.setText(mKeranjangList.get(position).getJumlahProduk());
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
		private static ImageView mGambar;
		private final TextView mJudul,mharga,mJumlah;



		MyKeranjangHolder(@NonNull View itemView) {
			super(itemView);
			mGambar = itemView.findViewById(R.id.imgCart);
			mJudul = itemView.findViewById(R.id.titleCart);
			mharga = itemView.findViewById(R.id.hargaCart);
			mJumlah = itemView.findViewById(R.id.qtyCart);

		}
	}
}
