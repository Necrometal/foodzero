<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\AuthService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    /**
     * @var AuthService
     */

    private $service;
   
    public function __construct()
    {
        $this->service = new AuthService();
    }

    /**
     * Auth login
     * @param Request $request
     * @return JsonResource
     */
    public function login(Request $request): JsonResponse
    {
        $rules = [
            'email' => 'required|email:rfc,dns',
            'password' => 'required',
        ];
        
        $rules_validate = Validator::make($request->all(), $rules);
        if ($rules_validate->fails()) {
            return response()->json([
                'warning' => $rules_validate->errors()
            ]);
        }

        return response()->json($this->service->login($request));
    }

    /**
     * Auth logout
     * @param Request $request
     * @return JsonResource
     */
    public function logout(Request $request): JsonResponse
    { 
        return response()->json($this->service->logout($request));
    }

    /**
     * Auth check auth
     * @param Request $request
     * @return JsonResource
     */
    public function checkAuth(Request $request): JsonResponse
    { 
        if($request->user()){
            return response()->json([
                'succes' => 'Authenticated'
            ]);
        }else{
            return response()->json([
                'error' => 'Unauthenticated'
            ], 401);
        }
    }
}
