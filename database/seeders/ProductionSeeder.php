<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Production;

use Illuminate\Support\Carbon;

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
                'recipe_id' => 1,
                'product_id' => 1,
                'production_date' => Carbon::now()->subDays(13),            
                'qty_produced' => 5,
            ],      
            [
                'company_id' => 2,
                'recipe_id' => 1,
                'product_id' => 1,
                'production_date' => Carbon::now()->subDays(20),     
                'qty_produced' => 10,       
            ],                  
            [
                'company_id' => 1,
                'recipe_id' => 2,
                'product_id' => 1,
                'production_date' => Carbon::now()->subDays(5),            
                'qty_produced' => 7,
            ]
        ];

        Production::truncate();

        foreach($data as $i){
            Production::create($i);
        }
    }
}
