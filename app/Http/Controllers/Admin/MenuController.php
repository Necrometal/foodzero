<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\MenuCollection;
use App\Models\Menu;
use App\Services\MenuService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
     * @param Request $request
     * @return MenuCollection
     */
    
    public function listAll(Request $request): MenuCollection {
        return new MenuCollection($this->service->listsAll($request));
    }

    public function create(Request $request): JsonResponse {
        $rules = [
            'categorie' => 'required',
            'name' => 'required',
            'description' => 'required',
            'price' => 'required | numeric',
        ]; 
        
        $rules_validate = Validator::make($request->all(), $rules);
        if ($rules_validate->fails()) {
            return response()->json([
                'warning' => $rules_validate->errors()
            ]);
        }
        return response()->json($this->service->create($request));
    }

    public function update(Request $request, Menu $menu): JsonResponse {
        $rules = [
            'categorie' => 'required',
            'name' => 'required',
            'description' => 'required',
            'price' => 'required | numeric',
        ]; 
        
        $rules_validate = Validator::make($request->all(), $rules);
        if ($rules_validate->fails()) {
            return response()->json([
                'warning' => $rules_validate->errors()
            ]);
        }
        return response()->json($this->service->update($request, $menu));
    }

    /**
     * temporaly delete
     * @param Menu $menu
     */
    public function delete(Menu $menu): JsonResponse{
        return response()->json($this->service->delete($menu));
    }
}
