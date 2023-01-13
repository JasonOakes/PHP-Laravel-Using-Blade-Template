<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ZipCode;

class ZipCodeController extends Controller
{
    public function index()
    {
        return ZipCode::all()->take(10);
    }
 


    /*
      Signature: calculateDistance($latitude1, $longitude1, $latitude2, $longitude2)
      Function takes in lat/long of origin and destination
      Returns distance from point to point using Haversine Returning In Miles
    */
    private static function calculateDistance($latitude1, $longitude1, $latitude2, $longitude2)
    {
        $earth_radius = 3959;

        $dLat = deg2rad($latitude2 - $latitude1);
        $dLon = deg2rad($longitude2 - $longitude1);

        $a = sin($dLat/2) * sin($dLat/2) + cos(deg2rad($latitude1)) * cos(deg2rad($latitude2)) * sin($dLon/2) * sin($dLon/2);
        $c = 2 * asin(sqrt($a));
        $d = $earth_radius * $c;

        return $d;
        
    }


    public static function show($allZips)
    {
      //Set Local Vars
      $zipCodeResults = [];
      $allZipsArray = str_getcsv($allZips);
      $pointInList = 1;

      //Loop THrough Each CSV Value To Retrieve Lat/Long and Calculate Distance
      foreach($allZipsArray as $zip)
      {
          //Retrieve Zip Code Data
          $zipCodesLatLong = ZipCode::zipLookup($zip);  

          //Check ResultSet
          if($zipCodesLatLong != null  )
          {
            
              //Current Values
              $currentZip = $zipCodesLatLong['zip'];
              $currentLat = $zipCodesLatLong['latitude'];
              $currentLong = $zipCodesLatLong['longitude'];

              //Validates Not First Iteration and on Origin Zip
              if(isset($distance))
              {
                  $distance = ZipCodeController::calculateDistance($previousLat, $previousLong, $currentLat,$currentLong);
              }
              else
              {
                //If first iteration we set values;
                $distance = 0;
                $currentDistance = 0;
              }

              //Format Distance 
              $distance = round((float)$distance,2);
              $currentDistance += round((float)$distance,2);
              
              //Set Previous Variables
              $previousLat = $currentLat;
              $previousLong = $currentLong;        

              //Add To Return Data      
              array_push($zipCodeResults, array("Point"=>$pointInList,"Zip"=>$currentZip, "Lat"=>$currentLat, "Long"=>$currentLong, "Distance"=>$distance, "CurrentDistance"=>$currentDistance));             

          }    
          else
          {
            array_push($zipCodeResults, array("Point"=>$pointInList,"Zip"=>$zip, "Lat"=>0, "Long"=>0, "Distance"=>"Zip Code Not Found!", "CurrentDistance"=>0));                   
          }
          $pointInList++;//Increment
        }

            
        return $zipCodeResults;

    }//end show


    public static function validateZip($zipToValidate)
    {
      $result =  ZipCode::zipLookup($zipToValidate);

      if(!empty($result) && count($result)>0)
        return $result;
      else
        return false;
      
    }//end validateZip
}
