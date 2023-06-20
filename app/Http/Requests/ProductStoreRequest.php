<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required'],
            'category_id' => ['required'],
            'brand_id' => ['required'],
            'image' => ['required','image'],
            'desc' => ['required'],
            'quantity' => ['required'],
            'in_price' => ['required'],
            'out_price' => ['required'],
            'status' => ['required'],
        ];
    }
}
