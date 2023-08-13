<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\DataFileController as AdminDataFileController;
use App\Http\Controllers\Admin\DataUsersController as AdminDataUsersController;
use App\Http\Controllers\DatatablesController;

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

// Route::get('/', function () {
//     return view('welcome');
// });


Route::group(['middleware' => 'is.login'], function() {
	Route::get('/',[AuthController::class, 'index']);
	Route::post('/login',[AuthController::class, 'login']);
});
Route::get('/logout',[AuthController::class, 'logout']);

Route::group(['prefix' => 'datatables'], function() {
	Route::get('/data-file',[DatatablesController::class, 'dataFile']);
	Route::get('/data-users',[DatatablesController::class, 'dataUsers']);
});

Route::group(['middleware' => 'is.admin','prefix' => 'admin'], function(){
	Route::get('/dashboard',[AdminDashboardController::class, 'index']);

	// CRUD DATA FILE //
	Route::get('/data-file',[AdminDataFileController::class, 'index']);
	Route::get('/data-file/tambah',[AdminDataFileController::class, 'tambah']);
	Route::post('/data-file/save',[AdminDataFileController::class, 'save']);
	Route::get('/data-file/dekripsi/{id}',[AdminDataFileController::class, 'formDekripsi']);
    Route::get('/data-file/enkripsi-ulang/{id}',[AdminDataFileController::class, 'formEnkripsiUlang']);
	Route::put('/data-file/dekripsi/proses/{id}',[AdminDataFileController::class, 'prosesDekripsi']);
    Route::put('/data-file/enkripsi-ulang/proses/{id}',[AdminDataFileController::class, 'prosesEnkripsiUlang']);
	Route::get('/data-file/download/{id}',[AdminDataFileController::class, 'download']);
	// Route::get('/data-file/enkripsi/{id}',[AdminDataFileController::class, 'prosesEnkripsi']);
	Route::delete('/data-file/delete/{id}',[AdminDataFileController::class, 'delete']);
	// END CRUD DATA FILE //

	// CRUD DATA USERS //
	Route::get('/data-users',[AdminDataUsersController::class, 'index']);
	Route::get('/data-users/tambah',[AdminDataUsersController::class, 'tambah']);
	Route::post('/data-users/save',[AdminDataUsersController::class, 'save']);
	Route::get('/data-users/edit/{id}',[AdminDataUsersController::class, 'edit']);
	Route::put('/data-users/update/{id}',[AdminDataUsersController::class, 'update']);
	Route::delete('/data-users/delete/{id}',[AdminDataUsersController::class, 'delete']);
	Route::get('/data-users/status-user/{id}',[AdminDataUsersController::class, 'statusUser']);
	// END CRUD DATA USERS //
});