<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Product;

class ProductSeeder2 extends Seeder
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
                'name' => 'Jalangkote',
                'code' => 'JLGKT',
                'is_raw_material' => false,
                'is_active' => true,
                'uom_name' => 'pcs',
                'recipe_id' => 1,
            ],
            [
                'company_id' => 1,
                'name' => 'Jalangkote Besar',
                'code' => 'JLGKT_L',
                'is_raw_material' => false,
                'is_active' => true,
                'uom_name' => 'pcs',
                'recipe_id' => 2,
            ],
            [
                'company_id' => 1,
                'name' => 'Kue Keju',
                'code' => 'KUEKEJU',
                'is_raw_material' => false,
                'is_active' => true,
                'uom_name' => 'pcs',
                'recipe_id' => 3,
            ],            
        ];

        foreach($data as $i){
            Product::create($i);
        }
    }
}
