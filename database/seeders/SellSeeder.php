<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SellTransaction;
use Illuminate\Support\Facades\Http;

class SellSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            '{
            "company_id": 1,
            "transaction_date": "2022-7-12",
            "customer_name": "Apo",
            "is_cancelled": false,
            "is_printed": true,
            "printed_at": "2022-7-12",
            "note": "ok",
            "details": [{
                    "product_id": 1,
                    "qty": 15,
                    "disc_1": 0.1
                }, {
                    "product_id": 2,
                    "qty": 10,
                    "disc_1": 0.1
                }
            ]
        }',
        '{
            "company_id": 1,
            "transaction_date": "2022-7-13",
            "customer_name": "Bass",
            "is_cancelled": true,
            "cancelled_at": "2022-7-13",
            "is_printed": true,
            "printed_at": "2022-7-13",
            "note": "ok",
            "details": [{
                    "product_id": 1,
                    "qty": 20,
                    "disc_1": 0.1
                }, {
                    "product_id": 2,
                    "qty": 10,
                    "disc_1": 0.1
                }
            ]
        }',    
    ];     

    SellTransaction::truncate();

    foreach($data as $d){
        $http = Http::post('http://localhost:8000/sell', 
                        json_decode($d));
        echo $http;
    }
    }
}
