<?php

namespace Database\Factories;

use App\Models\ProductOnhand;
use App\Models\Company;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductOnhandFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ProductOnhand::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $cnt = count(Company::get());
        $cnt2 = count(Product::get());
        return [
            'company_id' => rand(1, $cnt),
            'product_id' => rand(1, $cnt2),
            'qty' => rand(100, 1000),   
        ];
    }
}
