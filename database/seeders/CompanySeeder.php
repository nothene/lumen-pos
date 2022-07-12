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
                'address' => 'Jl. Makassar No. 21, Medan',
                'is_active' => true,
            ],
            [
                'name' => 'Toko Kue Sinar Asia',
                'address' => 'Jl. Asia No. 142, Medan',
                'is_active' => true,
            ],                      
            [
                'name' => 'Warung Makan Kalimantan Baru',
                'address' => 'Jl. Kalimantan No. 56, Medan',
                'is_active' => true,
            ],         
            [
                'name' => 'Warung Sumatera Baru Asia',
                'address' => 'Jl. Sumatera No. 30, Medan',
                'is_active' => true,
            ],                     
            [
                'name' => 'Restoran Parapat Utama Rantau',
                'address' => 'Jl. Parapat No. 45, Medan',
                'is_active' => true,
            ],            
        ];

        Company::truncate();

        foreach($data as $i){
            Company::create($i);
        }
    }
}
