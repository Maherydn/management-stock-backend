<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserServices
{
    public function createUser(array $data)
    {
        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        };

        $user = User::create($data);

        return $user;
    }

    public function udpateUser(array $data, int $id)
    {
        $user = User::find($id);
        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        };

        $user->update($data);

        return $user;
    }
}
