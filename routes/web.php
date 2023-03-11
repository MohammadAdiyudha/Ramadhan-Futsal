<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReservasiController;
use App\Http\Controllers\PembayaranController;

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
    return redirect()->route('login');
});

Route::get('/login', function () {
    return view('login');
});

//Akses logout lewat url
Route::get('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout_url');

Auth::routes();

//verifikasi email user
Auth::routes(['verify' => true]);

Route::get('/home', \App\Http\Controllers\HomeController::class)->name('home');

// Route Admin Home & Cek Admin atau bukan
Route::group(['middleware' => 'is_admin'], function () {
    Route::get('admin/home', \App\Http\Controllers\HomeController::class)->name('admin.home');

    Route::get('admin', function () {
        return redirect()->route('admin.home');
    });

    // Menu Data User
    Route::get('admin/data-user', [App\Http\Controllers\UsersController::class, 'index']);

    // Mengubah Data User
    Route::get('admin/edit-user/{id}',  [App\Http\Controllers\UsersController::class, 'edit']); //route untuk ke halaman edit data
    Route::post('admin/update-user/{id}',  [App\Http\Controllers\UsersController::class, 'update']); //route untuk mengupdate data ke database

    // Menghapus Data User
    Route::delete('admin/hapus-user/{id}',  [App\Http\Controllers\UsersController::class, 'hapus'])->name('user.delete');

    // Tampilan data Reservasi - User
    Route::get('admin/data-reservasi', [ReservasiController::class, 'indexAdmin']);
});

// Menu Buat Reservasi
Route::get('buat-reservasi', [ReservasiController::class, 'create']);
Route::post('buat-reservasi', [ReservasiController::class, 'store']);

// Tampilan data Reservasi - User
Route::get('data-reservasi', [ReservasiController::class, 'indexUser']);

// Untuk menampilkan form password dan ganti password
Route::get('/changePassword', [App\Http\Controllers\UsersController::class, 'showChangePasswordGet'])->name('changePasswordGet');
Route::post('/changePassword', [App\Http\Controllers\UsersController::class, 'changePasswordPost'])->name('changePasswordPost');

// Menghapus Data Reservasi
Route::delete('hapus-reservasi/{reservasi_id}',  [ReservasiController::class, 'hapus'])->name('reservasi.delete');

// Mengubah Data Reservasi
Route::get('edit-reservasi/{id}',  [ReservasiController::class, 'edit']); //route untuk ke halaman edit data
Route::post('update-reservasi/{id}',  [ReservasiController::class, 'update']); //route untuk mengupdate data ke database

// Pembayaran
Route::post('pembayaran', [PembayaranController::class, 'store']);
?>
