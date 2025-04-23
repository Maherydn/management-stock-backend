<?php

namespace App\Http\Requests\Product;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class EditProductRequest extends FormRequest
{
    /**
     * Autoriser cette requête.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Règles de validation pour la mise à jour.
     */
    public function rules(): array
    {
        return [
            "name" => "sometimes|string|max:255",
            "buying_price" => "sometimes|integer",
            "unit_price" => "sometimes|integer",
            "quantity" => "sometimes|integer",
            "threshold_value" => "sometimes|integer",
            "expiry_date" => "sometimes|date|after:today",
            "category_id" => "sometimes|nullable|exists:categories,id",
            "supplier_id" => "sometimes|nullable|exists:suppliers,id",
            "user_id" => "sometimes|exists:users,id",
        ];
    }

    /**
     * Gestion des erreurs de validation.
     */
    public function failedValidation(Validator $validator): void
    {
        throw new HttpResponseException(response()->json([
            "success" => false,
            "message" => "Erreur de validation",
            "errorList" => $validator->errors()
        ], 422));
    }
}
