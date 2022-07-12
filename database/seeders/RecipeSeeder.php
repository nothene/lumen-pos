<?php

namespace Database\Seeders;

use App\Models\Recipe;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RecipeSeeder extends Seeder
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
                'code' => 'JLKT',
                'name' => 'Jalangkote',
                'notes' => 'Ambil semua bahan lalu diaduk dan digoreng',
            ],
            [
                'company_id' => 1,
                'code' => 'JLKTL',
                'name' => 'Jalangkote Besar',
                'notes' => 'Ambil semua bahan (lebih banyak) lalu diaduk dan digoreng',
            ],            
        ];

        Recipe::truncate();

        foreach($data as $i){
            Recipe::create($i);
        }
    }
}