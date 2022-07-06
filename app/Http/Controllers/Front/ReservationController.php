<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Resources\ReservationResource;
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
     * Store reservation
     * @param Request $request
     * @return ReservationResource
     */
    public function reservation(Request $request): ReservationResource
    {
        return new ReservationResource($this->service->reservation($request));
    }
}
