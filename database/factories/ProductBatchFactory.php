<?php

namespace Database\Factories;

use App\Models\ProductBatch;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class ProductBatchFactory extends Factory
{
    protected $model = ProductBatch::class;


    public function definition(): array
    {
        return [
            'product_id' => 1,
    'name' => 'Large',
            'price' => 2
        ];
    }

}
