<?php

namespace App\Http\Requests\API;

use Illuminate\Foundation\Http\FormRequest;

class RemoveProductFromCart extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->wantsJson();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'product_id' => 'required|int|exists:products,product_id'
        ];
    }
}
