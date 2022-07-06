<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Services\SubscribeService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SubscribeController extends Controller
{
    /**
     * @var SubscribeService
     */

    private $service;
   
    public function __construct()
    {
        $this->service = new SubscribeService();
    }

    /**
     * Store subscription
     * @param Request $request
     * @return JsonResource
     */
    public function subscribe(Request $request): JsonResponse
    {
        $rules = [
            'email' => 'required'
        ];
        
        $rules_validate = Validator::make($request->all(), $rules);
        if ($rules_validate->fails()) {
            return response()->json([
                'warning' => $rules_validate->errors()
            ]);
        }

        return response()->json($this->service->subscribe($request));
    }
}
