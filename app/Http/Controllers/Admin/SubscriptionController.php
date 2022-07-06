<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\SubscribeCollection;
use App\Services\SubscribeService;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
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
     * @param Request $request
     * @return SubscribeCollection
     */
    
    public function listAll(Request $request): SubscribeCollection {
        return new SubscribeCollection($this->service->listsAll($request));
    }
}
