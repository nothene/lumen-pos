<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\PurchaseTransaction;

use Illuminate\Support\Carbon;

use App\Http\Controllers\PurchaseController;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;

class PurchaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(PurchaseController $service)
    {
        $data = [
                '{
                "company_id": 1,
                "transaction_date": "2022-7-12",
                "supplier_name": "Toko Bahan Kue Surabaya Baru",
                "details": [{
                        "raw_material_id": 3,
                        "qty": 500,
                        "price": 100,
                        "disc_1": 0.1
                    }, {
                        "raw_material_id": 4,
                        "qty": 300,
                        "price": 500,
                        "disc_1": 0.1
                    },
                    {
                        "raw_material_id": 5,
                        "qty": 50,
                        "price": 2000,
                        "disc_1": 0.1
                    },
                    {
                        "raw_material_id": 6,
                        "qty": 500,
                        "price": 3000,
                        "disc_1": 0.1
                    },
                    {
                        "raw_material_id": 7,
                        "qty": 50,
                        "price": 2000,
                        "disc_1": 0.1
                    }
                ]
            }',
            '{
                "company_id": 2,
                "transaction_date": "2022-7-12",
                "supplier_name": "Toko Bahan Kue Bandung Asia",
                "details": [{
                        "raw_material_id": 3,
                        "qty": 520,
                        "price": 200,
                        "disc_1": 0.1
                    }, {
                        "raw_material_id": 4,
                        "qty": 350,
                        "price": 400,
                        "disc_1": 0.1
                    },
                    {
                        "raw_material_id": 5,
                        "qty": 50,
                        "price": 2000,
                        "disc_1": 0.1
                    },
                    {
                        "raw_material_id": 6,
                        "qty": 500,
                        "price": 3000,
                        "disc_1": 0.1
                    },
                    {
                        "raw_material_id": 8,
                        "qty": 50,
                        "price": 2000,
                        "disc_1": 0.1
                    }
                ]
            }',        
        ];     

        PurchaseTransaction::truncate();

        foreach($data as $d){
            $http = Http::post('http://localhost:8000/purchase', 
                            json_decode($d));
        }

        // $data = [
        //     [
        //         'company_id' => 1,
        //         'transaction_date' => Carbon::now()->subHours(rand(1, 100)),
        //         'supplier_name' => 'Toko Bahan Kue Sinar Baru',
        //         'is_cancelled' => false,
        //         'notes' => 'tidak ada',
        //     ],
        //     [
        //         'company_id' => 2,
        //         'transaction_date' => Carbon::now()->subHours(rand(1, 100)),
        //         'supplier_name' => 'Toko Bahan Kue Sinar Baru Cabang Sulawesi Utara',
        //         'is_cancelled' => false,
        //         'notes' => 'tidak ada',
        //     ],            
        // ];

        // $details = [
        //     [
        //         "raw_material_id" => 3,
        //         "qty" => 500,
        //         "price" => 100,
        //         "disc_1" => 0.1
        //     ], [
        //         "raw_material_id" => 4,
        //         "qty" => 300,
        //         "price" => 500,
        //         "disc_1" => 0.1
        //     ],
        //     [
        //         "raw_material_id" => 5,
        //         "qty" => 50,
        //         "price" => 2000,
        //         "disc_1" => 0.1
        //     ],
        //     [
        //         "raw_material_id" => 6,
        //         "qty" => 500,
        //         "price" => 3000,
        //         "disc_1" => 0.1
        //     ],
        //     [
        //         "raw_material_id" => 7,
        //         "qty" => 50,
        //         "price" => 2000,
        //         "disc_1" => 0.1
        //     ]            
        // ];

        // PurchaseTransaction::truncate();

        // foreach($data as $i){
        //     PurchaseTransaction::create($i);
        // } 
    }
}
