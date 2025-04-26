<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Sale\CreateSaleRequest;
use App\Http\Requests\Sale\EditSaleRequest;
use App\Models\Sale;
use App\Services\SalesServices;
use Exception;
use Illuminate\Http\Exceptions\HttpResponseException;

class SalesController extends Controller
{
    public function store(CreateSaleRequest $request, SalesServices $salesServices)
    {
        try {
            $sale = $salesServices->createSale($request->validated());
            if ($sale) {

                return response()->json([
                    "success" => true,
                    "message" => "Opération réussie",
                    "data" => $sale
                ], 201);
            } else {
                return response()->json([
                    "success" => false,
                    "message" => "Stock insuffisant",
                ], 500);
            }
        } catch (Exception $e) {
            return response()->json([
                "success" => false,
                "message" => "Opération échouée",
                "errorMessage" => $e->getMessage()
            ], 500);
        }
    }

    public function update(EditSaleRequest $request, SalesServices $salesServices, Sale $sale)
    {
        try {
            $sale = $salesServices->updateSale($request->validated(), $sale);
            if ($sale) {

                return response()->json([
                    "success" => true,
                    "message" => "Opération réussie",
                    "data" => $sale
                ], 200);
            } else {
                return response()->json([
                    "success" => false,
                    "message" => "Stock insuffisant",
                ], 500);
            }
        } catch (Exception $e) {
            return response()->json([
                "success" => false,
                "message" => "Opération échouée",
                "errorMessage" => $e->getMessage()
            ], 500);
        }
    }


    public function index()
    {
        try { 

            return response()->json([
                "success" => true,
                "message" => "Opération réussie",
                "data" => Sale::with('saleItems')->get()
            ]);
        } catch (Exception $e) {
            return response()->json([
                "success" => false,
                "message" => "Opération échouée",
                "error" => $e->getMessage()
            ], 500);
        }
    }


    public function show(Sale $sale)
    {
        try {
            $sale->load('saleItems');
    
            return response()->json([
                "success" => true,
                "message" => "Détail de la vente",
                "data" => $sale
            ]);
        } catch (Exception $e) {
            return response()->json([
                "success" => false,
                "message" => "Erreur lors de la récupération",
                "error" => $e->getMessage()
            ], 500);
        }
    }
}
