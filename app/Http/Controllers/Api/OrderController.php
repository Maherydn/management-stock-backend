<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Order\CreateOrderRequest;
use App\Http\Requests\Order\EditOrderRequest;
use App\Models\Order;
use App\Models\OrderStatus;
use App\Services\OrdersServices;
use Exception;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function store(CreateOrderRequest $request, OrdersServices $ordersServices)
    {
        try {
            $order = $ordersServices->createOrder($request->validated());

            return response()->json([
                "success" => true,
                "message" => "Opération réussie",
                "data" => $order
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                "success" => false,
                "message" => "Opération échouée",
                "errorMessage" => $e->getMessage()
            ], 500);
        }
    }

    public function update(EditOrderRequest $request, OrdersServices $ordersServices, Order $order)
    {
        try {
            $order = $ordersServices->updateOrder($request->validated(), $order);

            return response()->json([
                "success" => true,
                "message" => "Opération réussie",
                "data" => $order
            ], 200);
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
                "data" => Order::with('orderItems')->get()
            ]);
        } catch (Exception $e) {
            return response()->json([
                "success" => false,
                "message" => "Opération échouée",
                "error" => $e->getMessage()
            ], 500);
        }
    }


    public function show(Order $order)
    {
        try {
            $order->load('orderItems');

            return response()->json([
                "success" => true,
                "message" => "Détail de la vente",
                "data" => $order
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
