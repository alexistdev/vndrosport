package com.gilang.vndrosport.fragment;

import android.content.Context;
import android.os.Bundle;

import androidx.annotation.NonNull;
import androidx.annotation.Nullable;
import androidx.fragment.app.Fragment;
import androidx.recyclerview.widget.LinearLayoutManager;
import androidx.recyclerview.widget.RecyclerView;

import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.Toast;

import com.gilang.vndrosport.API.APIService;
import com.gilang.vndrosport.API.NoConnectivityException;
import com.gilang.vndrosport.R;
import com.gilang.vndrosport.adapter.SpesialAdapter;
import com.gilang.vndrosport.model.SpesialModel;
import com.gilang.vndrosport.response.ResponseSpesial;

import java.util.ArrayList;
import java.util.List;

import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;


public class home_fragment extends Fragment {

	private RecyclerView gridSpesial;
	private SpesialAdapter spesialAdapter;
	private List<SpesialModel> daftarSpesial;

//    public static home_fragment newInstance(String param1, String param2) {
//        home_fragment fragment = new home_fragment();
//        Bundle args = new Bundle();
//        args.putString(ARG_PARAM1, param1);
//        args.putString(ARG_PARAM2, param2);
//        fragment.setArguments(args);
//        return fragment;
//    }
//
//    @Override
//    public void onCreate(Bundle savedInstanceState) {
//        super.onCreate(savedInstanceState);
//        if (getArguments() != null) {
//            mParam1 = getArguments().getString(ARG_PARAM1);
//            mParam2 = getArguments().getString(ARG_PARAM2);
//        }
//    }
//
//    @Override
//    public View onCreateView(LayoutInflater inflater, ViewGroup container,
//                             Bundle savedInstanceState) {
//        // Inflate the layout for this fragment
//        return inflater.inflate(R.layout.fragment_home, container, false);
//    }

	@Override
	public View onCreateView(@NonNull LayoutInflater inflater, @Nullable ViewGroup container, @Nullable Bundle savedInstanceState) {
		View view = inflater.inflate(R.layout.fragment_home, container, false);
		dataInit(view);
		setupRecyclerView();
		setData(getContext());
		return view;
	}

	private void dataInit(View mview){
		gridSpesial = mview.findViewById(R.id.rcSpesial);

	}

	private void setData(Context mContext) {
		try {
			Call<ResponseSpesial> call=  APIService.Factory.create(mContext).tampilSpesial();
			call.enqueue(new Callback<ResponseSpesial>() {
				@Override
				public void onResponse(Call<ResponseSpesial> call, Response<ResponseSpesial> response) {
					if(response.isSuccessful()){
						if(response.body() != null){
							daftarSpesial = response.body().getDaftarSpesial();
							spesialAdapter.replaceData(daftarSpesial);
						}
					}
				}

				@Override
				public void onFailure(Call<ResponseSpesial> call, Throwable t) {
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

	private void setupRecyclerView() {
		LinearLayoutManager linearLayoutManager = new LinearLayoutManager(getContext(),LinearLayoutManager.HORIZONTAL,false);
		spesialAdapter = new SpesialAdapter(new ArrayList<>());
		gridSpesial.setLayoutManager(linearLayoutManager);
		gridSpesial.setAdapter(spesialAdapter);
	}

	@Override
	public void onResume() {
		super.onResume();
		//setupRecyclerView();
	}

	private void pesan(String msg)
	{
		Toast.makeText(getContext(), msg, Toast.LENGTH_LONG).show();
	}
}
