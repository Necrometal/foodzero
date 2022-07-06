<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategorieCollection;
use App\Models\Categorie;
use App\Services\CategorieService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
     * @param Request $request
     * @return CategorieCollection
     */
    
    public function listAll(Request $request): CategorieCollection {
        return new CategorieCollection((isset($request->all) && $request->all == 1)
            ? $this->service->listsAllWithoutPagination()
            : $this->service->listsAll($request)
        );
    }

    public function create(Request $request): JsonResponse {
        $rules['name'] = 'required';
        
        $rules_validate = Validator::make($request->all(), $rules);
        if ($rules_validate->fails()) {
            return response()->json([
                'warning' => $rules_validate->errors()
            ]);
        }
        return response()->json($this->service->create($request));
    }

    public function update(Request $request, Categorie $categorie): JsonResponse {
        $rules['name'] = 'required';
        
        $rules_validate = Validator::make($request->all(), $rules);
        if ($rules_validate->fails()) {
            return response()->json([
                'warning' => $rules_validate->errors()
            ]);
        }
        return response()->json($this->service->update($request, $categorie));
    }

    /**
     * temporaly delete
     * @param Categorie $menu
     */
    public function delete(Categorie $categorie): JsonResponse{
        return response()->json($this->service->delete($categorie));
    }
}
