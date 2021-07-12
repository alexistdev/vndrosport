package com.gilang.vndrosport.API;

import android.content.Context;
import android.net.ConnectivityManager;
import android.net.NetworkInfo;
import androidx.annotation.NonNull;
import java.io.IOException;
import okhttp3.Interceptor;
import okhttp3.Request;
import okhttp3.Response;

public class NetworkConnectionInterceptor implements Interceptor {
	private final Context mContext;

	public NetworkConnectionInterceptor(Context context) {
		mContext = context;
	}

	@NonNull
	@Override
	public Response intercept(@NonNull Chain chain) throws IOException {
		if (!isConnected()) {
			throw new NoConnectivityException();
			// ini untuk custom exception 'NoConnectivityException'
		}
		Request.Builder builder = chain.request().newBuilder();
		return chain.proceed(builder.build());
	}
	@SuppressWarnings("DEPRECATION")
	public boolean isConnected(){
		ConnectivityManager connectivityManager = (ConnectivityManager) mContext.getSystemService(Context.CONNECTIVITY_SERVICE);
		NetworkInfo netInfo = connectivityManager.getActiveNetworkInfo();
		return (netInfo != null && netInfo.isConnected());
	}
}
