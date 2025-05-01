<?php

namespace App\Http\Controllers\Api\Order;

use App\Http\Controllers\Controller;
use App\Models\OrderStatus;
use Exception;
use Illuminate\Http\Request;

class OrderStatusController extends Controller
{
    public function store (Request $request) {
        try {
            $data = $request->validate([
                "label" =>"required|string"
            ]);

            $orderStatus = OrderStatus::create($data);

            return response()->json([
                "success" => true,
                "message" => "Opération réussie",
                "data" => $orderStatus
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                "success" => false,
                "message" => "Opération échouée",
                "errorMessage" => $e->getMessage()
            ], 500);
        }
    }

    public function update (Request $request) {
        try {
            $data = $request->validate([
                "label" =>"required|string"
            ]);

            $orderStatus = OrderStatus::create($data);

            return response()->json([
                "success" => true,
                "message" => "Opération réussie",
                "data" => $orderStatus
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                "success" => false,
                "message" => "Opération échouée",
                "errorMessage" => $e->getMessage()
            ], 500);
        }
    }

    public function index () {
        try {

            return response()->json([
                "success" => true,
                "message" => "Opération réussie",
                "data" => OrderStatus::all()
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                "success" => false,
                "message" => "Opération échouée",
                "errorMessage" => $e->getMessage()
            ], 500);
        }
    }

    public function show ( OrderStatus $orderStatus) {
        try {

            return response()->json([
                "success" => true,
                "message" => "Opération réussie",
                "data" => $orderStatus
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                "success" => false,
                "message" => "Opération échouée",
                "errorMessage" => $e->getMessage()
            ], 500);
        }
    }
}
