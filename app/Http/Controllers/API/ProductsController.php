<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\AddProductInCart;
use App\Http\Requests\API\RemoveProductFromCart;
use App\Http\Requests\API\SetCartProductQuantity;
use App\Http\Resources\ProductsResource;
use App\Http\Resources\UserCartProductResource;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class ProductsController extends Controller
{
    public function index()
    {
        $products = Product::all(); // Here must be pagination
        return response()->json([
            'products' => ProductsResource::collection($products)
        ]);
    }

    public function addProductInCart(AddProductInCart $request)
    {
        return $this->incrementOrCreate($request->product_id);
    }

    public function removeProductFromCart(RemoveProductFromCart $request)
    {
        $product = Auth::user()->products()->find($request->product_id);
        if ($product && $product->pivot->quantity) {
            $product->pivot->decrement('quantity');
            return response()->success();
        }
        return response()->fail(Response::HTTP_FORBIDDEN, 'product doesn\'t exist in cart');
    }

    public function setCartProductQuantity(SetCartProductQuantity $request)
    {
        return $this->incrementOrCreate($request->product_id, $request->quantity);
    }

    private function incrementOrCreate($productId, $quantity = 1): JsonResponse
    {
        $product = Auth::user()->products()->find($productId);
        if ($product) {
            $product->pivot->increment('quantity', $quantity);
            return response()->success();
        }
        Auth::user()->products()->attach($productId, ['quantity' => $quantity]);
        return response()->success(Response::HTTP_CREATED);
    }

    public function getUserCart()
    {
        $data = (new Cart)->getUserCart(Auth::id());

        return response()->json([
            'products' => UserCartProductResource::collection($data['products']),
            'discount' => $data['discount']
        ]);
    }
}
