<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategorieCollection;
use App\Http\Resources\MenuCollection;
use App\Services\MenuService;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    /**
     * @var MenuService
     */

    private $service;
   
    public function __construct()
    {
        $this->service = new MenuService();
    }

    /**
     * Display a listing of the resource.
     *
     * @return MenuCollection
     */
    public function resumes(): CategorieCollection
    {
        return new CategorieCollection($this->service->resumes());
    }

    /**
     * Display a listing of the resource.
     * @param Request $request
     * @return CategorieCollection
     */
    public function lists(Request $request): MenuCollection
    {
        return new MenuCollection($this->service->lists($request));
    }
}
