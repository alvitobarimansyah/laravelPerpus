<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', function () {
    return view('welcome');
});

Route::get('/clear-cache', function () {
    Artisan::call('cache:clear');
    return "Cache is cleared";
});

//Route::get('/','BukuController@index')->middleware('auth');
Route::get('/','BukuController@koleksiBuku')->middleware('auth');

Route::get('/hello', function () {
    return view('halo');
});

Route::get('/nilai', function () {
    return view('nilai_siswa');
});

Route::get('/nilai_siswa', function () {
    return view('nilai');
});

Route::get('/salam', function () {
    return 'Selamat Pagi';
});

Route::get('user/{id}', function ($id) {
    return 'ID User'.$id;
});

Route::get('user/{nama}/{pekerjaan}',
function ($nama, $pekerjaan) {
    return $nama.' pekerjaannya adalah '.$pekerjaan;
});

Route::get('/siswa', 'SiswaController@dataSiswa');

Route::get('/belanja', function () {
    return view('pembelian');
});

// routing aplikasi
Route::resource('penerbit', 'PenerbitController')->middleware('auth');
Route::get('pdf', 'PenerbitController@generatePDF')->middleware('auth');
Route::get('penerbitpdf', 'PenerbitController@penerbitPDF')->middleware('auth');
Route::get('exportpenerbit', 'PenerbitController@penerbitExcel')->middleware('auth'); 

Route::resource('pengarang', 'PengarangController')->middleware('auth');
Route::get('pdf', 'PengarangController@generatePDF')->middleware('auth');
Route::get('pengarangpdf', 'PengarangController@pengarangPDF')->middleware('auth');
Route::get('exportanggota', 'AnggotaController@anggotaExcel')->middleware('auth'); 

Route::resource('kategori', 'KategoriController')->middleware('auth');
Route::get('pdf', 'KategoriController@generatePDF')->middleware('auth');
Route::get('kategoripdf', 'KategoriController@kategoriPDF')->middleware('auth');
Route::get('exportkategori', 'KategoriController@kategoriExcel')->middleware('auth'); 

Route::resource('buku', 'BukuController')->middleware('auth');
Route::get('pdf', 'BukuController@generatePDF')->middleware('auth');
Route::get('bukupdf', 'BukuController@bukuPDF')->middleware('auth');
Route::get('exportbuku', 'BukuController@bukuExcel')->middleware('auth');
Route::get('koleksi', 'BukuController@KoleksiBuku')->middleware('auth');
Route::get('/afterregister', function () {
    return view('afterregister');
});

Route::resource('anggota', 'AnggotaController')->middleware('auth');
Route::get('pdf', 'AnggotaController@generatePDF')->middleware('auth');
Route::get('anggotapdf', 'AnggotaController@anggotaPDF')->middleware('auth');
Route::get('exportanggota', 'AnggotaController@anggotaExcel')->middleware('auth'); 

Route::resource('member', 'MemberController')->middleware('auth');

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');