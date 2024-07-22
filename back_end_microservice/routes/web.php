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

Route::get('/api/validate-phone-numbers/{country_code_number}/{country_code_string}/{quantity}', [App\Http\Controllers\PhoneNumberController::class, 'validateAndStore']);

Route::get('/api/get-all-numbers', [App\Http\Controllers\PhoneNumberController::class, 'getAllNumbers']);

Route::get('/api/confirm-delete-number/{mongoDBID}', [App\Http\Controllers\PhoneNumberController::class, 'confirmDeleteNumber']);