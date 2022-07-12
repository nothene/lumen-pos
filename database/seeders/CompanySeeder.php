<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
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
                'name' => 'Daily Jalangkote',
                'address' => 'Jl. Asia No. 12, Medan',
                'is_active' => true,
            ],
            [
                'name' => 'Toko Sinar Asia',
                'address' => 'Jl. Asia No. 142, Medan',
                'is_active' => true,
            ],                      
            [
                'name' => 'Toko Kalimantan Baru',
                'address' => 'Jl. Kalimantan No. 56, Medan',
                'is_active' => true,
            ],                  
        ];

        Company::truncate();

        foreach($data as $i){
            Company::create($i);
        }
    }
}
