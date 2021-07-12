package com.gilang.vndrosport.adapter;

import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.TextView;

import androidx.annotation.NonNull;
import androidx.recyclerview.widget.RecyclerView;

import com.gilang.vndrosport.R;
import com.gilang.vndrosport.model.SpesialModel;

import java.util.List;

public class SpesialAdapter extends RecyclerView.Adapter<SpesialAdapter.MySpesialHolder> {
	public List<SpesialModel> mSpesialList;

	public SpesialAdapter(List<SpesialModel> mSpesialList) {
		this.mSpesialList = mSpesialList;
	}

	@NonNull
	@Override
	public SpesialAdapter.MySpesialHolder onCreateViewHolder(@NonNull ViewGroup parent, int viewType) {
		View mView = LayoutInflater.from(parent.getContext()).inflate(R.layout.single_list_spesial, parent, false);
		SpesialAdapter.MySpesialHolder holder;
		holder = new SpesialAdapter.MySpesialHolder(mView);
		return holder;
	}

	@Override
	public void onBindViewHolder (@NonNull SpesialAdapter.MySpesialHolder holder, final int position){
		holder.mJudul.setText(mSpesialList.get(position).getNamaProduk());
	}

	@Override
	public int getItemCount () {
		return mSpesialList.size();
	}

	public void replaceData(List<SpesialModel> dataSpesial) {
		this.mSpesialList = dataSpesial;
		notifyDataSetChanged();
	}

	public static class MySpesialHolder extends RecyclerView.ViewHolder {
		private final TextView mJudul;
//		private final TextView mTanggal;


		MySpesialHolder(@NonNull View itemView) {
			super(itemView);
			mJudul = itemView.findViewById(R.id.txt_judul);
//			mTanggal = itemView.findViewById(R.id.txt_tanggal);
		}
	}

}
