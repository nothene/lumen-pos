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
                'company_id' => 2,
                'name' => 'Tepung',
                'code' => 'TPG',
                'is_raw_material' => true,
                'is_active' => true,
                'uom_name' => 'ons',
            ],  
            [
                'company_id' => 2,
                'name' => 'Susu Bubuk',
                'code' => 'SSBBK',
                'is_raw_material' => true,
                'is_active' => true,
                'uom_name' => 'ons',
            ],              
            [
                'company_id' => 2,
                'name' => 'Telur Ayam',
                'code' => 'TLRAYM',
                'is_raw_material' => true,
                'is_active' => true,
                'uom_name' => 'pcs',
            ],                     
            [
                'company_id' => 2,
                'name' => 'Margarin Daun',
                'code' => 'MRGNDN',
                'is_raw_material' => true,
                'is_active' => true,
                'uom_name' => 'ons',
            ],         
            [
                'company_id' => 2,
                'name' => 'Bihun',
                'code' => 'BHN',
                'is_raw_material' => true,
                'is_active' => true,
                'uom_name' => 'ons',
            ],                                      
            [
                'company_id' => 3,
                'name' => 'Nasi lemak',
                'code' => 'NSLMK',
                'is_raw_material' => false,
                'is_active' => true,
                'uom_name' => 'bungkus',
            ],
            [
                'company_id' => 3,
                'name' => 'Nasi sayur',
                'code' => 'NSSYR',
                'is_raw_material' => false,
                'is_active' => true,
                'uom_name' => 'bungkus',
            ],            
        ];

        Product::truncate();

        foreach($data as $i){
            Product::create($i);
        }
    }
}
