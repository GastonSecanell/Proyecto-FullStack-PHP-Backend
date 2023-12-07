<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register-user', [UserController::class, 'createUser']);

Route::middleware('custom.token')->group(function () {

    Route::post('/logout', [AuthController::class, 'logout']);
    Route::group(['controller' => CustomerController::class], function () {
        Route::post('/register-customer', 'createCustomer');
        Route::delete('/delete-customer', 'deleteCustomer');
        Route::get('/customer-info', 'customerInfo');
    });
});