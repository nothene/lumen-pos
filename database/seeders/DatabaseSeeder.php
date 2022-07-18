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
            ProductSeeder::class, 
            RecipeSeeder::class,
            // ProductSeeder2::class, 
            // ProductPriceSeeder::class,   
            // RecipeDetailSeeder::class, 
            // ProductOnhandSeeder::class,
            // ProductPriceSeeder::class,
            // ProductionSeeder::class,
            // PurchaseSeeder::class,
            // SellSeeder::class,
        ]);
    }
}
