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
                'company_id' => 2,
                'name' => 'Tepung',
                'code' => 'TPG',
                'is_raw_material' => true,
                'is_active' => true,
                'uom_name' => 'gram',
            ],  
            [
                'company_id' => 2,
                'name' => 'Susu Bubuk',
                'code' => 'SSBBK',
                'is_raw_material' => true,
                'is_active' => true,
                'uom_name' => 'gram',
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
                'name' => 'Margarin',
                'code' => 'MRGNDN',
                'is_raw_material' => true,
                'is_active' => true,
                'uom_name' => 'gram',
            ],         
            [
                'company_id' => 2,
                'name' => 'Bihun',
                'code' => 'BHN',
                'is_raw_material' => true,
                'is_active' => true,
                'uom_name' => 'gram',
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
            [
                'company_id' => 2,
                'name' => 'Susu UHT Supermilk',
                'code' => 'SUSUHTSU',
                'is_raw_material' => true,
                'is_active' => true,
                'uom_name' => 'ml',
            ],
            [
                'company_id' => 1,
                'name' => 'Coca-Cola 330ml',
                'code' => 'COCA330ML',
                'is_raw_material' => false,
                'is_active' => true,
                'uom_name' => 'botol',
            ],                           
            [
                'company_id' => 1,
                'name' => 'Coca-Cola 1L',
                'code' => 'COCA1L',
                'is_raw_material' => false,
                'is_active' => true,
                'uom_name' => 'botol',
            ],
            [
                'company_id' => 1,
                'name' => 'Beras Medan',
                'code' => 'BRSMDN',
                'is_raw_material' => true,
                'is_active' => true,
                'uom_name' => 'gram',
            ],
            [
                'company_id' => 1,
                'name' => 'Beras Jakarta',
                'code' => 'BRSJKT',
                'is_raw_material' => true,
                'is_active' => true,
                'uom_name' => 'gram',
            ],       
            [
                'company_id' => 1,
                'name' => 'Cokelat Hitam',
                'code' => 'CKLTHTM',
                'is_raw_material' => true,
                'is_active' => true,
                'uom_name' => 'gram',
            ], 
            [
                'company_id' => 1,
                'name' => 'Gula',
                'code' => 'GULA',
                'is_raw_material' => true,
                'is_active' => true,
                'uom_name' => 'gram',
            ],
            [
                'company_id' => 1,
                'name' => 'Garam',
                'code' => 'GARAM',
                'is_raw_material' => true,
                'is_active' => true,
                'uom_name' => 'gram',
            ],
            [
                'company_id' => 1,
                'name' => 'Minyak Goreng',
                'code' => 'MYKGRG',
                'is_raw_material' => true,
                'is_active' => true,
                'uom_name' => 'ml',
            ],    
            [
                'company_id' => 1,
                'name' => 'Lemon',
                'code' => 'LMN',
                'is_raw_material' => true,
                'is_active' => true,
                'uom_name' => 'gram',
            ],
            [
                'company_id' => 1,
                'name' => 'Keju',
                'code' => 'KEJU',
                'is_raw_material' => true,
                'is_active' => true,
                'uom_name' => 'gram',
            ],    
            [
                'company_id' => 1,
                'name' => 'Wortel',
                'code' => 'WRTL',
                'is_raw_material' => true,
                'is_active' => true,
                'uom_name' => 'gram',
            ],                                               
        ];

        //Product::truncate();

        foreach($data as $i){
            Product::create($i);
        }
    }
}
