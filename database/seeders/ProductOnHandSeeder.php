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
                'qty' => 25,
            ],
            [
                'company_id' => 2,
                'product_id' => 1,
                'qty' => 30,
            ],
        ];

        ProductOnHand::truncate();

        foreach($data as $i){
            ProductOnhand::create($i);
        }
    }
}
