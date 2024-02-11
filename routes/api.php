<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\PackageController;
use App\Http\Controllers\Api\CustomerController;

use App\Http\Controllers\Api\ImageController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/login', App\Http\Controllers\Api\LoginController::class)->name('login');
Route::post('/logout', App\Http\Controllers\Api\LogoutController::class)->name('logout');

Route::post('/register', App\Http\Controllers\Api\RegisterController::class)->name('register');


Route::group(['middleware' => ['auth:api', 'role:admin']], function () {
    Route::get('users', [UserController::class, 'index']);
    Route::get('users/{id}', [UserController::class, 'show']);

    Route::post('users/create', [UserController::class, 'create']);
    Route::post('users/update/{id}', [UserController::class, 'update']);

    Route::delete('users/delete/{id}',[UserController::class, 'delete']);

    // < ========================== >

    Route::post('package/create', [PackageController::class, 'create']);
    Route::post('package/update/{id}', [PackageController::class, 'update']);

    Route::delete('package/delete/{id}',[PackageController::class, 'delete']);
    
    // < ========================== >

    Route::post('customer/updatestatus/{id}', [CustomerController::class, 'updatestatus']);
});


Route::group(['middleware' => ['auth:api']], function () {
    Route::get('package', [PackageController::class, 'index']);
    Route::get('package/{id}', [PackageController::class, 'show']);

    // < ========================== >

    Route::get('customer', [CustomerController::class, 'index']);
    Route::get('customer/{id}', [CustomerController::class, 'show']);

    Route::post('customer/create', [CustomerController::class, 'create']);
    Route::post('customer/update/{id}', [CustomerController::class, 'update']);

    Route::delete('customer/delete/{id}',[CustomerController::class, 'delete']);

    // < ========================== >

    Route::post('uploadImage', [ImageController::class, 'uploadImage']);
});
