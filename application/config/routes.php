<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'Login';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
/* Route Master Data */
$route['admin/provinsi'] = 'administrator/Provinsi/index';
$route['admin/provinsi/add'] = 'administrator/Provinsi/add';
$route['admin/provinsi/edit/(:any)'] = 'administrator/Provinsi/edit/$1';
$route['admin/provinsi/hapus/(:any)'] = 'administrator/Provinsi/hapus/$1';
$route['admin/kabupaten'] = 'administrator/Kabupatens/index';
$route['admin/kabupaten/add'] = 'administrator/Kabupatens/add';
$route['admin/kabupaten/edit/(:any)'] = 'administrator/Kabupatens/edit/$1';
$route['admin/kabupaten/hapus/(:any)'] = 'administrator/Kabupatens/hapus/$1';
$route['admin/kecamatan'] = 'administrator/Kecamatan/index';
$route['admin/kategori'] = 'administrator/Kategori/index';
$route['admin/kategori/add'] = 'administrator/Kategori/add';
$route['admin/kategori/edit/(:any)'] = 'administrator/Kategori/edit/$1';
$route['admin/kategori/hapus/(:any)'] = 'administrator/Kategori/hapus/$1';

$route['admin/merek'] = 'administrator/Merek/index';
$route['admin/merek/add'] = 'administrator/Merek/add';
$route['admin/merek/edit/(:any)'] = 'administrator/Merek/edit/$1';
$route['admin/merek/hapus/(:any)'] = 'administrator/Merek/hapus/$1';

/* Route Administrator */
$route['admin/login'] = 'administrator/Login/index';
$route['admin/dashboard'] = 'administrator/Member/index';
$route['admin/setting'] = 'administrator/Setting/index';
$route['admin/logout'] = 'administrator/Member/Logout';
$route['admin/toko'] = 'administrator/Toko/index';

/* Client */
$route['admin/client'] = 'administrator/Client';
$route['admin/client/add'] = 'administrator/Client/add';

/* Api */
$route['api/spesial'] = 'api/Spesial';
$route['api/produk'] = 'api/Produk';
$route['api/produk/detail'] = 'api/Produk/detail';
$route['api/keranjang'] = 'api/Keranjang';
$route['api/keranjang/total'] = 'api/Keranjang/total';
$route['api/checkout'] = 'api/Checkout/index';
$route['api/pesanan'] = 'api/Pesanan/index';
$route['api/auth'] = 'api/Auth/index';
$route['api/akun'] = 'api/Akun/index';
$route['api/kategori'] = 'api/Kategori/index';
$route['api/daftar'] = 'api/Daftar/index';

/* Route Toko */
$route['store/dashboard'] = 'store/Member/index';
$route['store/logout'] = 'store/Member/logout';
$route['store/produk'] = 'store/Produk/index';
$route['store/produk/detail/(:any)'] = 'store/Produk/detail/$1';


