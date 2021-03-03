<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\ProductGroupItem;
use App\Models\UserProductGroup;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Collection;

class ProductGroupItemFactory extends Factory
{
    private $products;

    public function __construct($count = null, ?Collection $states = null, ?Collection $has = null, ?Collection $for = null, ?Collection $afterMaking = null, ?Collection $afterCreating = null, $connection = null)
    {
        parent::__construct($count, $states, $has, $for, $afterMaking, $afterCreating, $connection);
        $this->products = Product::all();
    }

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
            'product_id' => $this->products->shift()
        ];
    }
}
