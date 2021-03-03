<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\ProductGroupItem;
use App\Models\UserProductGroup;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductGroupItemFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ProductGroupItem::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'group_id' => UserProductGroup::inRandomOrder()->first()->group_id,
            'product_id' => Product::inRandomOrder()->first()->product_id
        ];
    }
}
