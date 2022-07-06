<?php

namespace App\Services;

use App\Models\Categorie;
use App\Models\Menu;
use Exception;

class MenuService {

    private $imageservice;

    public function __construct()
    {
        $this->imageservice = new ImageService();
    }
  
    public function resumes(){
        try{
            // show only menu with categorie
            $menus = Categorie::with(['menus'])->whereHas('menus')->limit(3)->get()->map(function($category) {
                return $category->setRelation('menus', $category->menus->take(2));
            });

            return $menus;
        }catch(Exception $e){
            throw $e;
        }
    }

    public function lists($request){
        try{
            $query = Menu::orderBy('created_at', 'desc');

            if(isset($request->limit) && $request->limit > 0){
                $query = $query->limit($request->limit)->get();
            }else if(isset($request->page) && $request->page > 0){
                $query = $query->paginate($request->page);
            }else{
                $query = $query->get();
            }

            return $query;
        }catch(Exception $e){
            throw $e;
        }

    }

    public function listsAll($request){
        $query = Menu::withTrashed()->with(['category' => function($query){
            return $query->select(['id', 'name']);
        }])->orderBy('name', 'asc');

        $menu = $query->paginate(10, ['*'], 'page', ($request && $request->page) ? $request->page : 1);
        $menu->setCollection( $menu->getCollection()->makeVisible( 'deleted_at' ) );
        return $menu;
    }

    public function create($request){
        try{
            $data['name'] = $request->name;
            $data['description'] = $request->description;
            $data['price'] = $request->price;

            if(isset($request->uploadedImage)){
                $data['image'] = $this->imageservice->uploadImage($request->uploadedImage, 'menus');
            }

            $categorie = Categorie::find($request->categorie);

            $menu = $categorie->menus()->create($data);

            return [
                'data' => $menu
            ];
            
        }catch(Exception $e){
            throw $e;
        }
    }

    public function update($request, $menu){
        try{
            $data['name'] = $request->name;
            $data['description'] = $request->description;
            $data['price'] = $request->price;
            $data['categorie_id'] = $request->categorie;

            if(isset($request->uploadedImage)){
                $data['image'] = $this->imageservice->uploadImage($request->uploadedImage, 'menus');
                if($menu->image) $this->imageservice->deleteImge($request->image, 'menus');
            }

            $menu->fill($data);
            $menu->save();

            return [
                'data' => $menu
            ];
            
        }catch(Exception $e){
            throw $e;
        }
    }

    public function delete($menu, $permanent = false){
        try{
            if($permanent){
                $menu->forceDelete();
                return [
                    'succes' => 'Menu permanently deleted'
                ];
            }else{
                $menu->delete();
                return [
                    'succes' => 'Menu deleted'
                ];
            }
        }catch(Exception $e){
            throw $e;
        }
    }

}