<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\ProductOnhand;
use App\Models\Company;
use App\Models\Product;

class ProductOnhandSeeder extends Seeder
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

        ProductOnhand::truncate();
        
        // factory random is unstable
        //$data =  ProductOnhand::factory()->count(100)->make();
        
        // foreach($data as $i){
        //     //echo $i . PHP_EOL;
        //     $a = ProductOnhand::updateOrCreate(
        //         [
        //             'company_id' => $i->company_id,
        //             'product_id' => $i->product_id
        //         ], 
        //         ['qty' => $i->qty]
        //     );
        // }
        
        // using create adds the timestamp
        // foreach($data as $i){
        //     ProductOnhand::insert($i);
        // }

        $company = Company::get();
        $product = Product::get();        

        echo $company;
        echo $product;

        foreach($company as $i){
            foreach($product as $j){
                $a = ProductOnhand::create(
                    [
                        'company_id' => $i->ID,
                        'product_id' => $j->ID,
                        'qty' => rand(100, 1000),
                    ],                     
                );             
            }
        }
    }
}
