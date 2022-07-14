<?php

namespace Database\Seeders;

use App\Models\ProductPrice;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Carbon;

class ProductPriceSeeder extends Seeder
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
                'product_id' => 1,
                'price' => 3000,
                'published_at' => Carbon::now()->subYears(20),            
            ],      
            [
                'company_id' => 1,
                'product_id' => 2,
                'price' => 5000,
                'published_at' => Carbon::now()->subYears(20),            
            ],                          
            [
                'company_id' => 1,
                'product_id' => 1,
                'price' => 4000,
                'published_at' => Carbon::now(),
            ],       
            [
                'company_id' => 1,
                'product_id' => 2,
                'price' => 6000,
                'published_at' => Carbon::now(),            
            ],
            [
                'company_id' => 1,
                'product_id' => 1,
                'price' => 6000,
                'published_at' => Carbon::now()->addHour(),            
            ]
        ];

        ProductPrice::truncate();

        foreach($data as $i){
            ProductPrice::create($i);
        }
    }
}
