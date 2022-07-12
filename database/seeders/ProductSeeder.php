<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\Hash;

use App\Models\Product;

class ProductSeeder extends Seeder
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
                'code' => 'JLKT',
                'is_raw_material' => false,
                'is_active' => true,
                'uom_name' => 'buah',
                'recipe_id' => 1,
            ],
            [
                'company_id' => 1,
                'name' => 'Jalangkote Besar',
                'code' => 'JLKTL',
                'is_raw_material' => false,
                'is_active' => true,
                'uom_name' => 'buah',
                'recipe_id' => 2,
            ],
            [
                'company_id' => 1,
                'name' => 'Tepung',
                'code' => 'TPG',
                'is_raw_material' => true,
                'is_active' => true,
                'uom_name' => 'gram',
            ],            
        ];

        Product::truncate();

        foreach($data as $i){
            Product::create($i);
        }
    }
}
