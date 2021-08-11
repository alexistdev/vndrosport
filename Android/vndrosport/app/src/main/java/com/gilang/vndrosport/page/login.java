package com.gilang.vndrosport.page;

import androidx.appcompat.app.AppCompatActivity;

import android.app.ProgressDialog;
import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.EditText;
import android.widget.ImageView;
import android.widget.TextView;
import android.widget.Toast;
import com.gilang.vndrosport.API.APIService;
import com.gilang.vndrosport.MainActivity;
import com.gilang.vndrosport.R;
import com.gilang.vndrosport.model.APIError;
import com.gilang.vndrosport.model.LoginModel;
import com.gilang.vndrosport.utils.ErrorUtils;
import com.gilang.vndrosport.utils.SessionHandle;
import java.util.regex.Pattern;
import okhttp3.internal.annotations.EverythingIsNonNull;
import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;

public class login extends AppCompatActivity {
	private EditText mEmail, mPassword;
	private ImageView btnLogin;
	private ProgressDialog pDialog;
	private TextView mDaftar;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_login);
		init();
		//cek login
		if(SessionHandle.isLoggedIn(this)){
			Intent intent = new Intent(login.this, MainActivity.class);
			startActivity(intent);
			finish();
		}
		btnLogin.setOnClickListener(v -> {
			String email = mEmail.getText().toString();
			String password = mPassword.getText().toString();
			if(email.trim().length()> 0 && password.trim().length() >0){
				if(cekEmail(email)){
					checkLogin(email,password);
				}else{
					pesan("Masukkan email yang valid !");
				}
			} else {
				pesan("Semua kolom harus diisi!");
			}
		});

		mDaftar.setOnClickListener(v -> {
			Intent intent = new Intent(login.this, Daftar.class);
			startActivity(intent);
		});
    }

	private void checkLogin(final String email, final String password){
		tampilkanDialog();
		try{
			Call<LoginModel> login = APIService.Factory.create(getApplicationContext()).loginUser(email,password);
			login.enqueue(new Callback<LoginModel>() {
				@EverythingIsNonNull
				@Override
				public void onResponse(Call<LoginModel> call, Response<LoginModel> response) {
					if(response.isSuccessful()) {
						if (response.body() != null) {
							if (SessionHandle.login(login.this, response.body().getIdUser(), response.body().getToken())){
								Intent intent = new Intent(login.this, MainActivity.class);
								startActivity(intent);
								finish();
								pesan(response.body().getToken());
							}
						}
					} else {
						sembunyikanDialog();
						APIError error = ErrorUtils.parseError(response);
						pesan(error.message());
					}
				}
				@EverythingIsNonNull
				@Override
				public void onFailure(Call<LoginModel> call, Throwable t) {
					sembunyikanDialog();
					pesan(t.getMessage());
				}
			});
		} catch (Exception e){
			sembunyikanDialog();
			e.printStackTrace();
			pesan(e.getMessage());
		}
	}

	private boolean cekEmail(String email){
		return Pattern.compile("^(([\\w-]+\\.)+[\\w-]+|([a-zA-Z]{1}|[\\w-]{2,}))@"
				+ "((([0-1]?[0-9]{1,2}|25[0-5]|2[0-4][0-9])\\.([0-1]?"
				+ "[0-9]{1,2}|25[0-5]|2[0-4][0-9])\\."
				+ "([0-1]?[0-9]{1,2}|25[0-5]|2[0-4][0-9])\\.([0-1]?"
				+ "[0-9]{1,2}|25[0-5]|2[0-4][0-9])){1}|"
				+ "([a-zA-Z]+[\\w-]+\\.)+[a-zA-Z]{2,4})$").matcher(email).matches();
	}

	public void init() {
		btnLogin = findViewById(R.id.btn_login);
		mDaftar = findViewById(R.id.txt_daftar);
		mEmail = findViewById(R.id.txt_email);
		mPassword = findViewById(R.id.txt_password);
		pDialog = new ProgressDialog(this);
		pDialog.setCancelable(false);
		pDialog.setMessage("Loading.....");
	}

	private void tampilkanDialog(){
		if(!pDialog.isShowing()){
			pDialog.show();
		}
	}

	private void sembunyikanDialog(){
		if(pDialog.isShowing()){
			pDialog.dismiss();
		}
	}

	public void pesan(String msg)
	{
		Toast.makeText(getApplicationContext(), msg, Toast.LENGTH_LONG).show();
	}
}


