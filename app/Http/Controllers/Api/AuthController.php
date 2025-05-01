<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Services\AuthService;
use App\Services\AuthServices;
use Exception;  

class AuthController extends Controller
{
    public function login(LoginRequest $loginRequest, AuthServices $authServices)
    {
        try {
            $token = $authServices->createUserToken($loginRequest->validated());

            if(!$token) {
                return response()->json([
                    'success' => false,
                    'message' => 'Erreur d\'authentification.',
                ], 500);
            };

            return response()->json([
                'success' => true,
                'message' => 'Opération réussie.',
                'token' => $token
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Operation echoue',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
