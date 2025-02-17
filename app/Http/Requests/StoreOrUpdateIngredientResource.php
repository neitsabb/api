<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrUpdateIngredientResource extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => "required|string|min:4",
            'image' => "nullable",
            "price" => "required|numeric|min:0",
            "unit" => "required|string",
            "stock_quantity" => "required|numeric|min:0",
            "critical_stock" => "required|numeric|min:0",
        ];
    }
}
