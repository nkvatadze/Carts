<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    public function getUserCart(int $id)
    {
        $data = $this->select('carts.product_id', 'carts.quantity', 'products.price', 'product_group_items.group_id', 'user_product_groups.discount')
            ->join('products', 'carts.product_id', '=', 'products.product_id')
            ->leftJoin('product_group_items', 'carts.product_id', '=', 'product_group_items.product_id')
            ->leftJoin('user_product_groups', 'product_group_items.group_id', '=', 'user_product_groups.group_id')
            ->where('carts.user_id', $id)->where('carts.quantity', '>', 0)
            ->groupBy('carts.product_id', 'carts.quantity', 'products.price', 'product_group_items.group_id', 'user_product_groups.discount')
            ->get()->groupBy(function ($item, $key) {
                return $item['group_id'] ?? 0;
            });

        $productGroupItems = ProductGroupItem::selectRaw('group_id, count(item_id) as count')
            ->whereIn('group_id', array_filter(array_keys($data->toArray())))
            ->groupBy('group_id')->get();

        $discount = 0;
        foreach ($data as $key => $value) {
            $groupItemCount = $productGroupItems->where('group_id', $key)->first();
            if ($groupItemCount && count($data[$key]) == $groupItemCount->count) {
                $minQuantity = $data[$key]->min('quantity');
                foreach ($value as $product) {
                    $total = ($product->quantity * $product->price);
                    $discountPrice = $this->calculateDiscount($product, $minQuantity);
                    $product->price = $total - $discountPrice;
                    $discount += $discountPrice;
                }
            }
        }
        return [
            'products' => $data->values()->flatten(),
            'discount' => $discount
        ];
    }

    private function calculateDiscount($product, $minQuantity)
    {
        return $product->price * $minQuantity * $product->discount / 100;
    }
}
