<?php

namespace Database\Factories;

use App\Models\ProductOnhand;
use App\Models\Company;
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
        return [
            'company_id' => rand(1, $cnt),
            'product_id' => rand(1, $cnt),
            'qty' => rand(10, 100),   
        ];
    }
}
