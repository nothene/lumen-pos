<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            CompanySeeder::class,
            RecipeSeeder::class,
            ProductSeeder::class, 
            ProductPriceSeeder::class,   
            RecipeDetailSeeder::class, 
            ProductOnhandSeeder::class,
            ProductPriceSeeder::class,
            ProductionSeeder::class,
            PurchaseSeeder::class,
            SellSeeder::class,
        ]);
    }
}
