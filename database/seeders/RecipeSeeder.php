<?php

namespace Database\Seeders;

use App\Models\Recipe;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;

class RecipeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $data = [
        //     [
        //         'company_id' => 1,
        //         'code' => 'JLKT',
        //         'name' => 'Jalangkote',
        //         'notes' => 'Ambil semua bahan lalu diaduk dan digoreng',
        //     ],
        //     [
        //         'company_id' => 1,
        //         'code' => 'JLKT_L',
        //         'name' => 'Jalangkote Besar',
        //         'notes' => 'Ambil semua bahan secara lebih banyak lalu diaduk dan digoreng',
        //     ],
        //     [
        //         'company_id' => 1,
        //         'code' => 'KCKLT',
        //         'name' => 'Kue Coklat',
        //         'notes' => 'Ambil semua bahan lalu diaduk dan dipanggang selama 30 menit',
        //     ],
        //     [
        //         'company_id' => 1,
        //         'code' => 'KEKJU',
        //         'name' => 'Kue Keju',
        //         'notes' => 'Ambil semua bahan lalu diaduk dan dipanggang selama 30 menit',
        //     ],            
        // ];

        // Recipe::truncate();

        // foreach($data as $i){
        //     Recipe::create($i);
        // }

        $data = [
            '{
                "company_id": 1,
                "code": "JLGKT",
                "name": "Jalangkote",
                "notes": "Ambil semua bahan lalu diaduk dan digoreng",
                "ingredients": [
                    {
                        "ID": 3,
                        "qty_needed": 100
                    },
                    {
                        "ID": 5,
                        "qty_needed": 1
                    },
                    {
                        "ID": 6,
                        "qty_needed": 50
                    },          
                    {
                        "ID": 7,
                        "qty_needed": 100
                    }          
                ]
            }',
            '{
                "company_id": 1,
                "code": "JLGKT2",
                "name": "Jalangkote Besar",
                "notes": "Ambil bahan lebih banyak lalu diaduk dan digoreng",
                "ingredients": [
                    {
                        "ID": 3,
                        "qty_needed": 200
                    },
                    {
                        "ID": 5,
                        "qty_needed": 2
                    },
                    {
                        "ID": 6,
                        "qty_needed": 100
                    },          
                    {
                        "ID": 7,
                        "qty_needed": 200
                    }                    
                ]
            }', 
            '{
                "company_id": 1,
                "code": "KUEKJ",
                "name": "Kue Keju",
                "notes": "Ambil bahan lebih banyak lalu diaduk dan dipanggang",
                "ingredients": [
                    {
                        "ID": 3,
                        "qty_needed": 200
                    },
                    {
                        "ID": 5,
                        "qty_needed": 2
                    },
                    {
                        "ID": 6,
                        "qty_needed": 100
                    },          
                    {
                        "ID": 10,
                        "qty_needed": 200
                    }                    
                ]
            }',                                  
        ];    

        Recipe::truncate();

        // does not really work as the two tables rely on each other
        foreach($data as $d){
            $http = Http::post('http://localhost:8000/recipes', 
                            json_decode($d));
            echo $http;
        }
    }
}
