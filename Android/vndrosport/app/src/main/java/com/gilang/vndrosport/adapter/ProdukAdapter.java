package com.gilang.vndrosport.adapter;

import android.content.Intent;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.Button;
import android.widget.TextView;
import android.widget.Toast;

import androidx.annotation.NonNull;
import androidx.recyclerview.widget.RecyclerView;

import com.gilang.vndrosport.R;
import com.gilang.vndrosport.model.ProdukModel;
import com.gilang.vndrosport.model.SpesialModel;
import com.gilang.vndrosport.page.Detailproduk;

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
		holder.mBeli.setOnClickListener(new View.OnClickListener() {
			@Override
			public void onClick(View v) {
				Toast.makeText(v.getContext(),"test",Toast.LENGTH_LONG).show();
			}
		});
		holder.itemView.setOnClickListener(new View.OnClickListener() {
			@Override
			public void onClick(View view) {
				Intent mIntent = new Intent(view.getContext(), Detailproduk.class);
				mIntent.putExtra("idProduk",mProdukList.get(position).getIdProduk());
				view.getContext().startActivity(mIntent);
			}
		});
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
		private final Button mBeli;


		MyProdukHolder(@NonNull View itemView) {
			super(itemView);
			mJudul = itemView.findViewById(R.id.txt_judul);
			mHarga = itemView.findViewById(R.id.txt_harga);
			mBeli = itemView.findViewById(R.id.tbl_beli);
		}
	}
}
