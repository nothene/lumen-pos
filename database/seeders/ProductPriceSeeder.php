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
        // carbon::now uses utc+0
        // data inputted from client uses local time (+7)
        $data = [
            [
                'company_id' => 1,
                'product_id' => 20,
                'price' => 3000,
                'published_at' => Carbon::now()->subHours(20),            
            ],      
            [
                'company_id' => 1,
                'product_id' => 21,
                'price' => 5000,
                'published_at' => Carbon::now()->subHours(20),            
            ],                          
            [
                'company_id' => 1,
                'product_id' => 22,
                'price' => 10000,
                'published_at' => Carbon::now()->subHours(20),
            ],       
            [
                'company_id' => 1,
                'product_id' => 6,
                'price' => 16000,
                'published_at' => Carbon::now()->subHours(20),            
            ],
            [
                'company_id' => 1,
                'product_id' => 7,
                'price' => 16000,
                'published_at' => Carbon::now()->subHours(20),            
            ],
            [
                'company_id' => 1,
                'product_id' => 9,
                'price' => 6000,
                'published_at' => Carbon::now()->subHours(20),            
            ],
            [
                'company_id' => 1,
                'product_id' => 10,
                'price' => 10000,
                'published_at' => Carbon::now()->subHours(20),            
            ],
        ];

        ProductPrice::truncate();

        foreach($data as $i){
            ProductPrice::create($i);
        }
    }
}
