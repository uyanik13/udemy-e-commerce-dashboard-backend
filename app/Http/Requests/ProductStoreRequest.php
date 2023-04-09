<?php

namespace App\Http\Requests;

use App\Rules\ProductVariantRule;
use Illuminate\Foundation\Http\FormRequest;

class ProductStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        if(empty(auth()->user())){
            return false;
        }

        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|max:161',
            'category_id' => 'required|exists:product_categories,id',
            'sku' => 'required',
            'shipping_id' => 'required|exists:shippings,id',
            'images' => 'required|array',
            'images.*' => 'file|max:2048',
            'product_variants' => ['required', new ProductVariantRule()]
        ];
    }

}
