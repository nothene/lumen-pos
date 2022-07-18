<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Production;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Http;

class ProductionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'company_id' => 1,
                //'recipe_id' => 1,
                'product_id' => 20,
                'production_date' => Carbon::now()->subDays(13),            
                'qty_produced' => 3,
            ],      
            [
                'company_id' => 2,
                //'recipe_id' => 1,
                'product_id' => 21,
                'production_date' => Carbon::now()->subDays(20),     
                'qty_produced' => 3       
            ],                  
            [
                'company_id' => 1,
                //'recipe_id' => 2,
                'product_id' => 22,
                'production_date' => Carbon::now()->subDays(5),            
                'qty_produced' => 3,
            ]
        ];

        Production::truncate();
        
        foreach($data as $d){
            $http = Http::post('http://localhost:8000/productions', $d);
            echo $http;
        }        

        // foreach($data as $i){
        //     Production::create($i);
        // }
    }
}
