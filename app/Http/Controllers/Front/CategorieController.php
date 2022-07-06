<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategorieCollection;
use App\Services\CategorieService;
use Illuminate\Http\Request;

class CategorieController extends Controller
{
    /**
     * @var CategorieService
     */

    private $service;
   
    public function __construct()
    {
        $this->service = new CategorieService();
    }

    /**
     * Display a listing of the resource.
     * @param Request $request
     * @return CategorieCollection
     */
    public function lists(Request $request): CategorieCollection
    {
        return new CategorieCollection($this->service->lists($request));
    }
}
