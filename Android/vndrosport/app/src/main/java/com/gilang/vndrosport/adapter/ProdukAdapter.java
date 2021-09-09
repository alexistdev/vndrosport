package com.gilang.vndrosport.adapter;

import android.annotation.SuppressLint;
import android.content.Context;
import android.content.Intent;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.Button;
import android.widget.ImageView;
import android.widget.TextView;
import android.widget.Toast;
import androidx.annotation.NonNull;
import androidx.recyclerview.widget.RecyclerView;

import com.bumptech.glide.Glide;
import com.bumptech.glide.Priority;
import com.bumptech.glide.load.engine.DiskCacheStrategy;
import com.bumptech.glide.request.RequestOptions;
import com.gilang.vndrosport.R;
import com.gilang.vndrosport.config.Constants;
import com.gilang.vndrosport.model.ProdukModel;
import com.gilang.vndrosport.page.Detailproduk;

import java.text.NumberFormat;
import java.util.List;
import java.util.Locale;

public class ProdukAdapter extends RecyclerView.Adapter<ProdukAdapter.MyProdukHolder>{
	public List<ProdukModel> mProdukList;
	private final Context context;

	public ProdukAdapter(List<ProdukModel> mProdukList, Context context) {
		this.mProdukList = mProdukList;
		this.context = context;
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
		Glide.with(context).clear(holder.mGambar);
		holder.mGambar.setImageBitmap(null);

		RequestOptions options = new RequestOptions()
				.placeholder(R.drawable.no_image)
				.priority(Priority.HIGH);
		Glide.with(context)

				.load(Constants.IMAGES_URL + mProdukList.get(position).getGambarProduk())
				.placeholder(R.drawable.no_image)
				.apply(options)
				.into(MyProdukHolder.mGambar);
		Locale localeID = new Locale("in", "ID");
		int harga = Integer.parseInt(mProdukList.get(position).getHargaProduk());
		String eHarga = NumberFormat.getNumberInstance(localeID).format(harga);
		holder.mJudul.setText(mProdukList.get(position).getNamaProduk());
//		holder.mJudul.setText(mProdukList.get(position).getGambarProduk());
		holder.mHarga.setText(String.format("%s%s",holder.itemView.getContext().getString(R.string.cart16),eHarga));
		holder.mBeli.setOnClickListener(v -> Toast.makeText(v.getContext(),"test",Toast.LENGTH_LONG).show());
		holder.itemView.setOnClickListener(view -> {
			Intent mIntent = new Intent(view.getContext(), Detailproduk.class);
			mIntent.putExtra("idProduk",mProdukList.get(position).getIdProduk());
			view.getContext().startActivity(mIntent);
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
		public static ImageView mGambar;
		private final TextView mJudul;
		private final TextView mHarga;
		private final Button mBeli;



		MyProdukHolder(@NonNull View itemView) {
			super(itemView);
			mJudul = itemView.findViewById(R.id.txt_judul);
			mHarga = itemView.findViewById(R.id.txt_harga);
			mBeli = itemView.findViewById(R.id.tbl_beli);
			mGambar = itemView.findViewById(R.id.gbr_product);
		}
	}
}
