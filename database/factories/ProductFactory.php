<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class ProductFactory extends Factory
{
    const  PRICE_TYPE = ['has_batches','has_toppings','standard'];

    public function definition(): array
    {
        return [
            'name' => fake()->name(),
    'price_type' => Arr::random(self::PRICE_TYPE),
            'price' => fake()->randomFloat(2,10,99)
        ];
    }

}
