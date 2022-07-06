<?php

namespace App\Services;

use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Hash;

class AuthService {

    public function login($request){
        
        $user = User::where('email', $request->email)->first();
        if(!$user || ($user && !Hash::check($request->password, $user->password))){
            return [
                'error' => 'Wrong Credentials'
            ];
        }

        $token = $user->createToken('Admin token')->accessToken;
        $user->token = $token;

        return [
            'data' => $user
        ];
    }

    public function logout($request){
        
        try{
            $request->user()->token()->revoke();

            return [
                'succes' => 'Logged out'
            ];
        }catch(Exception $e){
            throw $e;
        }

    }

}