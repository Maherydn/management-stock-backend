<?php

namespace App\Http\Requests\Product;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class CreateProductRequest extends FormRequest
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
            "name"=>"required|string",
            "buying_price"=>"required|integer",
            "unit_price"=>"required|integer",
            "quantity"=>"required|integer",
            "threshold_value"=>"required|integer",
            "expiry_date"=>"required|date",
            "category_id"=>"nullable|exists:categories,id",
            "supplier_id"=>"nullable|exists:suppliers,id",
            // "user_id"=>"required|exists:suppliers,id",
        ];
    }

    public function failedValidation (Validator $validator){
        throw new HttpResponseException(response()->json([
            "success" => false,
            "message" => "Erreur de validation",
            "errorList" => $validator->errors()
        ], 422));
    }
}
