<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Category\CreateCategoryRequest;
use App\Http\Requests\Category\EditCategoryRequest;
use App\Models\Category;
use Exception;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function store( CreateCategoryRequest $request) {
        try {
            $category = Category::create($request->validated());

            return response()->json([
                "success" => true,
                "message" => "Operation reussi",
                "data" => $category 
            ]);
        } catch (Exception $e) {
            return response()->json([
                "success" => false,
                "message" => "Operation échouée",
                "data" => $e->getMessage() 
            ]);
        }
    }

    public function update( EditCategoryRequest $request, Category $category) {
        try {
            $category->update($request->validated());

            return response()->json([
                "success" => true,
                "message" => "Operation reussi",
                "data" => $category 
            ]);
        } catch (Exception $e) {
            return response()->json([
                "success" => false,
                "message" => "Operation échouée",
                "data" => $e->getMessage() 
            ]);
        }
    }

    public function index() {
        try {

            return response()->json([
                "success" => true,
                "message" => "Operation reussi",
                "data" => Category::all()
            ]);
        } catch (Exception $e) {
            return response()->json([
                "success" => false,
                "message" => "Operation échouée",
                "data" => $e->getMessage() 
            ]);
        }
    }

    public function show(Category $category) {
        try {

            return response()->json([
                "success" => true,
                "message" => "Operation reussi",
                "data" => $category
            ]);
        } catch (Exception $e) {
            return response()->json([
                "success" => false,
                "message" => "Operation échouée",
                "data" => $e->getMessage() 
            ]);
        }
    }

    
}
