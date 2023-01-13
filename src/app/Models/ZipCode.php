<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class ZipCode extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'zip', 'latitude', 'longitude'
    ];   

    protected $hidden = [
        'id'
    ]; 



    /*
      Signature: zipLookup($zipcode)
      Function Takes In Zip Code and Returns Zip, Lat and Long Else Null
    */
    public static function zipLookup($zipcode)
    {
      $zipCodesLatLongArray = null;

        //Get Data
        $zipCodesLatLong = ZipCode::select('zip','latitude','longitude')->where('zip', $zipcode)->first();

        //Validate if null
        if ($zipCodesLatLong)
            $zipCodesLatLongArray = $zipCodesLatLong->toArray();
        
            
        return $zipCodesLatLongArray;
    }


}
