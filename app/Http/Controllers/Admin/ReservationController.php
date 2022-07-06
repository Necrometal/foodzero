<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\ReservationCollection;
use App\Services\ReservationService;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    /**
     * @var ReservationService
     */

    private $service;
   
    public function __construct()
    {
        $this->service = new ReservationService();
    }

    /**
     * @param Request $request
     * @return ReservationCollection
     */
    
    public function listAll(Request $request): ReservationCollection {
        return new ReservationCollection($this->service->listsAll($request));
    }
}
