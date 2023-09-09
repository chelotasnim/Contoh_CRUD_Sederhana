<?php

use App\Http\Controllers\Buku;
use App\Http\Controllers\Kategori;
use App\Http\Controllers\Users;
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

/*
|--------------------------------------------------------------------------
| Web Routes Dengan URI BUKAN URL
|--------------------------------------------------------------------------
|
| URI adalah Uniform Resource Identifier, jadi menggunakan identifikasi kata tertentu untuk melakukan fungsi
| URL adalah Uniform Resource Locator, jadi urutan URL mengikuti urutan letak file dan folder
|
*/

Route::middleware('guest')->group(function () {
    //Identifier / untuk menampilkan halaman login
    Route::get('/', function () {
        //Arahkan ke nama file dengan acuan folder view/
        return view('login');
    });

    Route::post('login', [Users::class, 'login']);
});

//Middleware atau Session untuk membatasi hak akses dengan autentikasi
//Middleware terfokus ke autentikasi, untuk otorisasi gunakan guard dan gate
//Semua yang berada dalam middleware auth harus diakses setelah autentikasi (login)
Route::middleware('auth')->group(function () {

    //Contoh Route menampilkan halaman dengan bantuan Controller
    Route::get('buku', [Buku::class, 'index']);

    //Jangan gunakan kata kerja untuk identifier jika memungkinkan
    //Gunakan kata kerja pada method controller agar code readable
    Route::post('buku', [Buku::class, 'add_buku']);

    //Edit Buku
    Route::get('buku/{id}', [Buku::class, 'edit_buku']);

    //Update Buku
    Route::post('buku/{id}', [Buku::class, 'update_buku']);

    Route::get('delete_buku/{id}', [Buku::class, 'delete_buku']);

    //Fitur Referensi Data Kategori
    Route::get('kategori', [Kategori::class, 'index']);

    Route::post('kategori', [Kategori::class, 'add_kategori']);

    Route::get('kategori/{id}', [Kategori::class, 'edit_kategori']);

    Route::post('kategori/{id}', [Kategori::class, 'update_kategori']);

    Route::get('logout', [Users::class, 'logout']);

    Route::get('delete_kategori/{id}', [Kategori::class, 'delete_kategori']);
});
