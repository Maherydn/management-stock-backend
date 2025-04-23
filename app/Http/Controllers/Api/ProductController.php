<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\CreateProductRequest;
use App\Http\Requests\Product\EditProductRequest;
use App\Models\Product;
use Exception;
use Illuminate\Http\JsonResponse;

class ProductController extends Controller
{
    public function store(CreateProductRequest $request): JsonResponse
    {
        try {
            $data = $request->validated();
            $data['user_id'] = 1; // ou auth()->id() 
            $product = Product::create($data);

            return response()->json([
                "success" => true,
                "message" => "Opération réussie",
                "data" => $product
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                "success" => false,
                "message" => "Opération échouée",
                "errorMessage" => $e->getMessage()
            ], 500);
        }
    }

    public function update(EditProductRequest $request, Product $product): JsonResponse
    {
        try {
            $product->update($request->validated());

            return response()->json([
                "success" => true,
                "message" => "Opération réussie",
                "data" => $product
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                "success" => false,
                "message" => "Opération échouée",
                "errorMessage" => $e->getMessage()
            ], 500);
        }
    }

    public function index(): JsonResponse
    {
        try {
            $products = Product::all();

            return response()->json([
                "success" => true,
                "message" => "Opération réussie",
                "data" => $products
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                "success" => false,
                "message" => "Opération échouée",
                "errorMessage" => $e->getMessage()
            ], 500);
        }
    }

    public function show(Product $product): JsonResponse
    {
        try {
            return response()->json([
                "success" => true,
                "message" => "Opération réussie",
                "data" => $product
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                "success" => false,
                "message" => "Opération échouée",
                "errorMessage" => $e->getMessage()
            ], 500);
        }
    }
}
