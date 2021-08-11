package com.gilang.vndrosport.page;

import android.app.ProgressDialog;
import android.content.Intent;
import android.os.Bundle;
import android.widget.EditText;
import android.widget.ImageView;
import android.widget.TextView;
import android.widget.Toast;
import androidx.appcompat.app.AppCompatActivity;
import com.gilang.vndrosport.API.APIService;
import com.gilang.vndrosport.MainActivity;
import com.gilang.vndrosport.R;
import com.gilang.vndrosport.model.APIError;
import com.gilang.vndrosport.model.AkunModel;
import com.gilang.vndrosport.utils.ErrorUtils;
import com.gilang.vndrosport.utils.SessionHandle;
import java.util.regex.Pattern;
import okhttp3.internal.annotations.EverythingIsNonNull;
import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;

public class Daftar extends AppCompatActivity {
	private EditText mEmail, mPassword, mNamaLengkap,mNomorTelepon;
	private ImageView mDaftar;
	private ProgressDialog pDialog;
	private TextView mLogin;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_daftar);
		init();
		if(SessionHandle.isLoggedIn(this)){
			Intent intent = new Intent(Daftar.this, MainActivity.class);
			startActivity(intent);
			finish();
		}
		mDaftar.setOnClickListener(v -> prosesSimpan());
		mLogin.setOnClickListener(v -> {
			Intent intent = new Intent(Daftar.this, login.class);
			startActivity(intent);
		});
    }

	private void prosesSimpan() {
		tampilkanDialog();
		String namaLengkap = mNamaLengkap.getText().toString();
		String alamatEmail = mEmail.getText().toString();
		String password = mPassword.getText().toString();
		String phone = mNomorTelepon.getText().toString();
		if (namaLengkap.length() == 0 || alamatEmail.length() == 0 || password.length() == 0 || phone.length() == 0) {
			sembunyikanDialog();
			pesan("Semua kolom harus diisi!");
		} else {
			if(cekEmail(alamatEmail)){
				try{
					Call<AkunModel> call = APIService.Factory.create(getApplicationContext()).tambahUser(namaLengkap,alamatEmail,password,phone);
					call.enqueue(new Callback<AkunModel>() {
						@EverythingIsNonNull
						@Override
						public void onResponse(Call<AkunModel> call, Response<AkunModel> response) {
							sembunyikanDialog();
							if(response.isSuccessful()) {
								Intent intent = new Intent(Daftar.this, login.class);
								startActivity(intent);
								finish();
								pesan("Akun Berhasil dibuat!");
							} else {
								sembunyikanDialog();
								APIError error = ErrorUtils.parseError(response);
								pesan(error.message());
							}
						}
						@EverythingIsNonNull
						@Override
						public void onFailure(Call<AkunModel> call, Throwable t) {
							sembunyikanDialog();
							pesan(t.getMessage());
						}
					});
				} catch (Exception e){
					sembunyikanDialog();
					e.printStackTrace();
					pesan(e.getMessage());
				}
			} else {
				sembunyikanDialog();
				pesan("Masukkan email yang valid!");
			}
		}
	}


	public void init() {
		mNamaLengkap = findViewById(R.id.txt_nama);
		mLogin = findViewById(R.id.txt_login);
		mNomorTelepon = findViewById(R.id.txt_telp);
		mEmail = findViewById(R.id.txt_email);
		mPassword = findViewById(R.id.txt_password);
		mDaftar = findViewById(R.id.btn_daftar);
		pDialog = new ProgressDialog(this);
		pDialog.setCancelable(false);
		pDialog.setMessage("Loading.....");
	}

	private boolean cekEmail(String email){
		return Pattern.compile("^(([\\w-]+\\.)+[\\w-]+|([a-zA-Z]{1}|[\\w-]{2,}))@"
				+ "((([0-1]?[0-9]{1,2}|25[0-5]|2[0-4][0-9])\\.([0-1]?"
				+ "[0-9]{1,2}|25[0-5]|2[0-4][0-9])\\."
				+ "([0-1]?[0-9]{1,2}|25[0-5]|2[0-4][0-9])\\.([0-1]?"
				+ "[0-9]{1,2}|25[0-5]|2[0-4][0-9])){1}|"
				+ "([a-zA-Z]+[\\w-]+\\.)+[a-zA-Z]{2,4})$").matcher(email).matches();
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
