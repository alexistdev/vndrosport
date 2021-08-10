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

import com.gilang.vndrosport.R;
import com.gilang.vndrosport.model.KategoriModel;
import com.gilang.vndrosport.model.KeranjangModel;

import java.util.List;

public class KategoriAdapter extends RecyclerView.Adapter<KategoriAdapter.MyKategoriHolder>{
	public List<KategoriModel> mKategoriList;

	public KategoriAdapter(List<KategoriModel> mKategoriList) {
		this.mKategoriList = mKategoriList;
	}

	@NonNull
	@Override
	public KategoriAdapter.MyKategoriHolder onCreateViewHolder(@NonNull ViewGroup parent, int viewType) {
		View mView = LayoutInflater.from(parent.getContext()).inflate(R.layout.single_list_kategori, parent, false);
		KategoriAdapter.MyKategoriHolder holder;
		holder = new KategoriAdapter.MyKategoriHolder(mView);
		return holder;
	}

	@Override
	public void onBindViewHolder (@NonNull KategoriAdapter.MyKategoriHolder holder, final int position){
		holder.mJudul.setText(mKategoriList.get(position).getNamaKategori());
	}
	@Override

	public int getItemCount () {
		return mKategoriList.size();
	}

	public void replaceData(List<KategoriModel> dataKategori) {
		this.mKategoriList = dataKategori;
		notifyDataSetChanged();
	}

	public static class MyKategoriHolder extends RecyclerView.ViewHolder {
		private final TextView mJudul;

		MyKategoriHolder(@NonNull View itemView) {
			super(itemView);
			mJudul = itemView.findViewById(R.id.txtNamaKategori);
		}
	}


}
