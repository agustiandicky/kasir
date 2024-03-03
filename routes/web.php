<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\JenisBarangController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

//Route::get('/', [HomeController::class, 'index']);

Route::get('/', [AuthController::class, 'index']);
Route::post('/cek_login', [AuthController::class, 'cek_login']);
Route::get('/logout', [AuthController::class, 'logout']);

Route::group(['middleware' => ['auth', 'checkrole:admin']], function () {

  //CRUD Data User
  Route::get('/user', [UserController::class, 'index']);
  Route::post('/user/store', [UserController::class, 'store']);
  Route::post('/user/update/{id}', [UserController::class, 'update']);
  Route::get('/user/destroy/{id}', [UserController::class, 'destroy']);

   //CRUD Data Jenis Barang
   Route::get('/jenisbarang', [JenisBarangController::class, 'index']);
   Route::post('/jenisbarang/store', [JenisBarangController::class, 'store']);
   Route::post('/jenisbarang/update/{id}', [JenisBarangController::class, 'update']);
   Route::get('/jenisbarang/destroy/{id}', [JenisBarangController::class, 'destroy']);

   //CRUD Data Barang
   Route::get('/barang', [BarangController::class, 'index']);
   Route::post('/barang/store', [BarangController::class, 'store']);
   Route::post('/barang/update/{id}', [BarangController::class, 'update']);
   Route::get('/barang/destroy/{id}', [BarangController::class, 'destroy']);
});

Route::group(['middleware' => ['auth', 'checkrole:admin,kasir']], function() {

  Route::get('/home', [HomeController::class, 'index']);
  
});