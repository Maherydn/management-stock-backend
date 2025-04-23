<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash; 

class AuthServices
{
    public function createUserToken(array $data)
    {
        $user = User::where('email', $data['email'])->first();
        
        if (!$user || !Hash::check($data['password'], $user->password)) {
            return null;
        };

        $token = $user->createToken('appName')->plainTextToken;

        return $token;
    }
}
