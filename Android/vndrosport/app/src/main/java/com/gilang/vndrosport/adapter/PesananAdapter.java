package com.gilang.vndrosport.adapter;


import android.annotation.SuppressLint;
import android.content.Intent;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.TextView;
import android.widget.Toast;

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
		String pending = holder.itemView.getContext().getString(R.string.pesanan7);
		String bayar = holder.itemView.getContext().getString(R.string.pesanan10);
		String diproses = holder.itemView.getContext().getString(R.string.pesanan11);
		String kirim = holder.itemView.getContext().getString(R.string.pesanan8);
		String selesai = holder.itemView.getContext().getString(R.string.pesanan12);
		String batal = holder.itemView.getContext().getString(R.string.pesanan13);
		String rupiah = holder.itemView.getContext().getString(R.string.pesanan9);
		holder.mOrder.setText(String.format("%-10s",pesanan +mPesananList.get(position).getIdPesanan()));
		holder.mProduk.setText(mPesananList.get(position).getJudul());
		holder.mTotal.setText(String.format("%-10s",rupiah +mPesananList.get(position).getTotal_jumlah()));
		String status = mPesananList.get(position).getStatus();
		if(status.equals("1")){
			holder.mStatus.setText(pending);
			holder.itemView.setOnClickListener(view -> {
				Intent mIntent = new Intent(view.getContext(), Payment.class);
				mIntent.putExtra("idPesanan",mPesananList.get(position).getIdPesanan());
				view.getContext().startActivity(mIntent);
			});
		} else if(status.equals("2")) {
			holder.mStatus.setText(bayar);
			holder.itemView.setOnClickListener(v -> Toast.makeText(v.getContext(), "Sedang diproses Admin, mohon ditunggu", Toast.LENGTH_SHORT).show());

		} else if(status.equals("3")){
			holder.mStatus.setText(diproses);
			holder.itemView.setOnClickListener(v -> Toast.makeText(v.getContext(), "Sedang diproses toko untuk proses pengiriman, mohon ditunggu", Toast.LENGTH_SHORT).show());
		} else if(status.equals("4")){
			holder.mStatus.setText(kirim);
			holder.itemView.setOnClickListener(v -> Toast.makeText(v.getContext(), "Barang anda sudah dikirimkan, pastikan anda berada di lokasi pengantaran", Toast.LENGTH_SHORT).show());
		} else if(status.equals("5")){
			holder.mStatus.setText(selesai);
		}else{
			holder.mStatus.setText(batal);
		}
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
