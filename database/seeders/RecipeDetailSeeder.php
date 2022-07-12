<?php

namespace Database\Seeders;

use App\Models\RecipeDetail;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RecipeDetailSeeder extends Seeder
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
                'recipe_id' => 1,
                'product_id' => 3,
                'qty_needed' => 100,
            ],                    
            [
                'recipe_id' => 1,
                'product_id' => 4,
                'qty_needed' => 100,
            ],    
            [
                'recipe_id' => 1,
                'product_id' => 5,
                'qty_needed' => 1,
            ],                   
            [
                'recipe_id' => 1,
                'product_id' => 6,
                'qty_needed' => 100,
            ],       
            [
                'recipe_id' => 2,
                'product_id' => 3,
                'qty_needed' => 200,
            ],                    
            [
                'recipe_id' => 2,
                'product_id' => 4,
                'qty_needed' => 200,
            ],    
            [
                'recipe_id' => 2,
                'product_id' => 5,
                'qty_needed' => 2,
            ],                   
            [
                'recipe_id' => 2,
                'product_id' => 6,
                'qty_needed' => 100,
            ],                                                          
        ];

        RecipeDetail::truncate();

        foreach($data as $i){
            RecipeDetail::create($i);
        }        
    }
}
