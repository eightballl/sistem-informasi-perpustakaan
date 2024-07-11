<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\PinjamanController;
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

//LOGIN
Route::get('/', [LoginController::class, 'login'])->name('login');
Route::post('actionlogin', [LoginController::class, 'actionlogin'])->name('actionlogin');
//REGISTER
Route::get('/accounts', [RegisterController::class, 'register'])->name('register')->middleware('auth');
Route::post('/register/action', [RegisterController::class, 'actionregister'])->name('actionregister')->middleware('auth');
Route::get('/hapusakun/{id}', [RegisterController::class, 'hapusAkun'])->name('hapusAkun')->middleware('auth');
Route::get('/editakun/{id}', [RegisterController::class, 'editAkun'])->name('editAkun')->middleware('auth');
Route::post('/updateakun', [RegisterController::class, 'updateAkun'])->name('updateAkun')->middleware('auth');
//LOGOUT
Route::get('actionlogout', [LoginController::class, 'actionlogout'])->name('actionlogout')->middleware('auth');
//DASHBOARD
Route::get('dashboard', [DashboardController::class, 'index'])->name('index')->middleware('auth');
//DATA BUKU
Route::get('/data-buku', [BukuController::class, 'index'])->name('index')->middleware('auth');
Route::POST('/savebuku', [BukuController::class, 'saveBuku'])->name('saveBuku')->middleware('auth');
Route::get('/hapusbuku/{id}', [BukuController::class, 'hapusBuku'])->name('hapusBuku')->middleware('auth');
Route::get('/editbuku/{id}', [BukuController::class, 'editBuku'])->name('editBuku')->middleware('auth');
Route::post('/updatebuku', [BukuController::class, 'updateBuku'])->name('updateBuku')->middleware('auth');
//DATA PINJAMAN
Route::get('/data-pinjaman', [PinjamanController::class, 'index'])->name('index')->middleware('auth');
Route::get('/riwayat-pinjaman', [PinjamanController::class, 'riwayat'])->name('riwayat')->middleware('auth');
Route::POST('/savepinjaman', [PinjamanController::class, 'savePinjaman'])->name('savePinjaman')->middleware('auth');
Route::get('/editkembali/{id}', [PinjamanController::class, 'editKembali'])->name('editKembali')->middleware('auth');
Route::post('/updatekembali', [PinjamanController::class, 'updateKembali'])->name('updateKembali')->middleware('auth');
//MEMBER
Route::get('/member', [MemberController::class, 'index'])->name('index')->middleware('auth');
Route::POST('/savemember', [MemberController::class, 'saveMember'])->name('saveMember')->middleware('auth');
Route::get('/hapusmember/{id}', [MemberController::class, 'hapusMember'])->name('hapusMember')->middleware('auth');
Route::get('/editmember/{id}', [MemberController::class, 'editMember'])->name('editMember')->middleware('auth');
Route::post('/updatemember', [MemberController::class, 'updateMember'])->name('updateMember')->middleware('auth');