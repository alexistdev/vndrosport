package com.gilang.vndrosport.adapter;

import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.TextView;

import androidx.annotation.NonNull;
import androidx.recyclerview.widget.RecyclerView;

import com.gilang.vndrosport.R;
import com.gilang.vndrosport.model.ProdukModel;
import com.gilang.vndrosport.model.SpesialModel;

import java.util.List;

public class ProdukAdapter extends RecyclerView.Adapter<ProdukAdapter.MyProdukHolder>{
	public List<ProdukModel> mProdukList;

	public ProdukAdapter(List<ProdukModel> mProdukList) {
		this.mProdukList = mProdukList;
	}

	@NonNull
	@Override
	public ProdukAdapter.MyProdukHolder onCreateViewHolder(@NonNull ViewGroup parent, int viewType) {
		View mView = LayoutInflater.from(parent.getContext()).inflate(R.layout.single_list_product, parent, false);
		ProdukAdapter.MyProdukHolder holder;
		holder = new ProdukAdapter.MyProdukHolder(mView);
		return holder;
	}

	@Override
	public void onBindViewHolder (@NonNull ProdukAdapter.MyProdukHolder holder, final int position){
		holder.mJudul.setText(mProdukList.get(position).getNamaProduk());
		holder.mHarga.setText("Rp " + mProdukList.get(position).getHargaProduk());
	}

	@Override
	public int getItemCount () {
		return mProdukList.size();
	}

	public void replaceData(List<ProdukModel> dataProduk) {
		this.mProdukList = dataProduk;
		notifyDataSetChanged();
	}

	public static class MyProdukHolder extends RecyclerView.ViewHolder {
		private final TextView mJudul;
		private final TextView mHarga;


		MyProdukHolder(@NonNull View itemView) {
			super(itemView);
			mJudul = itemView.findViewById(R.id.txt_judul);
			mHarga = itemView.findViewById(R.id.txt_harga);
		}
	}
}
