<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\ZipCode;
use App\Http\Controllers\ZipCodeController;
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
    return view('zips.zipcodes');
});

Route::get('/welcome', function () {
    return view('welcome');
});




