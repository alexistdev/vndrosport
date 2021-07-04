<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Aplikasi Daihatsu
 * Dikembangkan oleh: AlexistDev
 * web: www.alexistdev.com
 * contact: alexistdev@gmail.com
 * hp : 082371408678
 */

/**
 * Method untuk mengenerate string unik
 */
if ( ! function_exists('kodegenerator')) {
	function kodegenerator($length = 10)
	{
		return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
	}
}
/**
 * Method untuk mensanitasi output sebelum dikirimkan ke html
 */

if ( ! function_exists('sanitasi')) {
	function sanitasi($str)
	{
		return htmlentities($str, ENT_QUOTES, 'UTF-8');
	}
}

/**
 * Method untuk mengenkripsi id di url.
 */

if ( ! function_exists('encrypt_url')) {
	function encrypt_url($string)
	{

		$output = false;
		/*
		 * mengambil security.ini file dan mendapatkan chiper key nya.
		 */

		$security = parse_ini_file("security.ini");
		$secret_key = $security["encryption_key"];
		$secret_iv = $security["iv"];
		$encrypt_method = $security["encryption_mechanism"];

		// hash
		$key = hash("sha256", $secret_key);

		// iv – encrypt method AES-256-CBC expects 16 bytes – else you will get a warning
		$iv = substr(hash("sha256", $secret_iv), 0, 16);

		//do the encryption given text/string/number
		$result = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
		$output = base64_encode($result);
		return $output;
	}
}
/**
 * Method untuk mengembalikan id yang sebelumnya sudah dienkripsi di url.
 */

if ( ! function_exists('decrypt_url')) {
	function decrypt_url($string)
	{

		$output = false;

		/*
		 * mengambil security.ini file dan mendapatkan chiper key nya.
		 */


		$security = parse_ini_file("security.ini");
		$secret_key = $security["encryption_key"];
		$secret_iv = $security["iv"];
		$encrypt_method = $security["encryption_mechanism"];

		// hash
		$key = hash("sha256", $secret_key);

		// iv – encrypt method AES-256-CBC expects 16 bytes – else you will get a warning
		$iv = substr(hash("sha256", $secret_iv), 0, 16);

		//do the decryption given text/string/number

		$output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
		return $output;
	}
}

/** Function untuk pengaturan captcha */
function config_captcha()
{
	$config = [
		'img_url' => base_url() . 'captcha/',
		'img_path' => './captcha/',
		'img_height' => 50,
		'word_length' => 5,
		'img_width' => 150,
		'font_size' => 10,
		'expiration' => 300,
		'pool' => '123456789ABCDEFGHIJKLMNPQRSTUVWXYZ'
	];
	return $config;
}
/** Membatalkan session login */
function _unlogin(){
	$ci = get_instance();
	$ci->session->set_userdata('is_login_in', FALSE);
	redirect('Login');
}

/** untuk title */
if ( ! function_exists('_myJudul')) {
	function _myJudul()
	{
		return "Dashboard Administrator ThePioneerOne";
	}
}

/** untuk title pendek */
if ( ! function_exists('_judulPendek')) {
	function _judulPendek()
	{
		return "ThePioneerOne";
	}
}

/** untuk angka unik */
if(! function_exists('angkaUnik')){
	function angkaUnik($length = 10) {
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
	}
}

