package com.gilang.vndrosport.adapter;


import android.annotation.SuppressLint;
import android.content.Intent;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.TextView;
import androidx.annotation.NonNull;
import androidx.recyclerview.widget.RecyclerView;
import com.gilang.vndrosport.R;
import com.gilang.vndrosport.model.PesananModel;
import com.gilang.vndrosport.page.Allproduk;
import com.gilang.vndrosport.page.Payment;

import java.util.List;

public class PesananAdapter extends RecyclerView.Adapter<PesananAdapter.MyPesananHolder>{
	public List<PesananModel> mPesananList;

	public PesananAdapter(List<PesananModel> mPesananList) {
		this.mPesananList = mPesananList;
	}

	@NonNull
	@Override
	public PesananAdapter.MyPesananHolder onCreateViewHolder(@NonNull ViewGroup parent, int viewType) {
		View mView = LayoutInflater.from(parent.getContext()).inflate(R.layout.single_list_pesanan, parent, false);
		PesananAdapter.MyPesananHolder holder;
		holder = new PesananAdapter.MyPesananHolder(mView);
		return holder;
	}

	@Override
	public void onBindViewHolder (@NonNull PesananAdapter.MyPesananHolder holder, final int position){
		String pesanan = holder.itemView.getContext().getString(R.string.pesanan6);
		String proses = holder.itemView.getContext().getString(R.string.pesanan7);
		String kirim = holder.itemView.getContext().getString(R.string.pesanan8);
		String rupiah = holder.itemView.getContext().getString(R.string.pesanan9);
		holder.mOrder.setText(String.format("%-10s",pesanan +mPesananList.get(position).getIdPesanan()));
		holder.mProduk.setText(mPesananList.get(position).getJudul());
		holder.mTotal.setText(String.format("%-10s",rupiah +mPesananList.get(position).getTotal_jumlah()));
		String status = mPesananList.get(position).getStatus();
		if(status.equals("1")){
			holder.mStatus.setText(proses);
		} else {
			holder.mStatus.setText(kirim);
		}
		holder.itemView.setOnClickListener(view -> {
			Intent mIntent = new Intent(view.getContext(), Payment.class);
			view.getContext().startActivity(mIntent);
		});
	}
	@Override
	public int getItemCount () {
		return mPesananList.size();
	}

	@SuppressLint("NotifyDataSetChanged")
	public void replaceData(List<PesananModel> dataPesanan) {
		this.mPesananList = dataPesanan;
		notifyDataSetChanged();
	}

	public static class MyPesananHolder extends RecyclerView.ViewHolder {
		private final TextView mOrder,mProduk,mStatus,mTotal;



		MyPesananHolder(@NonNull View itemView) {
			super(itemView);
			mOrder = itemView.findViewById(R.id.txt_order);
			mProduk = itemView.findViewById(R.id.txt_namaProduk);
			mStatus = itemView.findViewById(R.id.txt_status);
			mTotal = itemView.findViewById(R.id.txt_total);
		}
	}
}
