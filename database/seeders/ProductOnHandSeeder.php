<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\ProductOnhand;

class ProductOnHandSeeder extends Seeder
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
                'qty' => 50,
            ],       
            [
                'company_id' => 1,
                'product_id' => 2,
                'qty' => 50,
            ],     
            [
                'company_id' => 1,
                'product_id' => 3,
                'qty' => 500,
            ],  
            [
                'company_id' => 1,
                'product_id' => 4,
                'qty' => 500,
            ],  
            [
                'company_id' => 1,
                'product_id' => 5,
                'qty' => 500,
            ],                                                  
            [
                'company_id' => 1,
                'product_id' => 6,
                'qty' => 25,
            ],
            [
                'company_id' => 1,
                'product_id' => 7,
                'qty' => 100,
            ],              
            [
                'company_id' => 2,
                'product_id' => 1,
                'qty' => 30,
            ],
            [
                'company_id' => 2,
                'product_id' => 2,
                'qty' => 10,
            ],            
        ];

        ProductOnHand::truncate();

        $data =  ProductOnhand::factory()->count(50)->make();
        
        foreach($data as $i){
            echo $i . PHP_EOL;
            $a = ProductOnhand::updateOrCreate(
                [
                    'company_id' => $i->company_id,
                    'product_id' => $i->product_id
                ], 
                ['qty' => $i->qty]
            );
        }

        // foreach($data as $i){
        //     ProductOnhand::insert($i);
        // }
    }
}
