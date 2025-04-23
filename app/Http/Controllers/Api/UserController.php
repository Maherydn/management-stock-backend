<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\EditUserRequest;
use App\Models\User;
use App\Services\UserServices;
use Exception;

class UserController extends Controller
{
    public function store(CreateUserRequest $createUserRequest, UserServices $userServices)
    {
        try {
            $user = $userServices->createUser($createUserRequest->validated());

            return response()->json([
                'success' => true,
                'message' => 'Opération réussie.',
                'data' => $user
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Operation echoue',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function update(EditUserRequest $editUserRequest, UserServices $userServices, int $id)
    {
        try {
            $user = $userServices->udpateUser($editUserRequest->validated(), $id);

            return response()->json([
                'success' => true,
                'message' => 'Opération réussie.',
                'data' => $user
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Operation echoue',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function index()
    {
        try {
            $users = User::all();
            return response()->json([
                'success' => true,
                'message' => 'Opération réussie.',
                'data' => $users
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Operation echoue',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function show(int $id)
    {
        try {
            $user = User::find($id);
            return response()->json([
                'success' => true,
                'message' => 'Opération réussie.',
                'data' => $user
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Operation echoue',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
