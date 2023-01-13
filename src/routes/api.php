<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ZipCodeController;
use App\Models\ZipCode;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


//Api For Validation and Data Return
Route::get('/distances', function (Request $request) {
    $errors = [];
    $results = [];
    $originZip = $request->input('originzipcode');
    $destinationZipCodeCSV = $request->input('destinationzipcode');

    //Check Input Request For Starting Point Otherwise Error
    if($originZip === null || $originZip === "" )
    {
      //Return Starting Zip Code Error
      $errors = ['originzipcodeid' => "Invalid Input For `Origin Zip Code`"];
    }
    else if(!ZipCodeController::validateZip($originZip))
    {
      //Return Starting Zip Code Error
      $errors = ['originzipcodeid' => "Unable To Find `Origin Zip Code` '" . $originZip."'"];
    }
    else
    {
      //Append Validated Starting Zip to List For Data Retrieval    
      $allZips = $originZip . ",".$destinationZipCodeCSV;

      //Get Lat/Long & Calculated Distance Results For All Zip Codes
      $results = ZipCodeController::show($allZips);

    }

    return view('zips.zipcodes')
    ->withErrors($errors)
    ->with('originzipcode',$originZip)
    ->with('results',$results)
    ->with('destinationzipcode',$destinationZipCodeCSV);     
});

 
