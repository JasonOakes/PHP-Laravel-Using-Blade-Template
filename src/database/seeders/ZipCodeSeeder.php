<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ZipCode;

class ZipCodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ZipCode::truncate();
  
        $csvFile = fopen(base_path("database/data/zipcodes.csv"), "r");
  
        $firstline = true;
        while (($data = fgetcsv($csvFile, 2000, ",")) !== FALSE) {
            if (!$firstline) {
                ZipCode::create([
                    "zip" => $data['0'],
                    "latitude" => $data['1'],
                    "longitude" => $data['2']
                ]);    
            }
            $firstline = false;
        }
   
        fclose($csvFile);
    }
}
