<?php

namespace App\Services;

use App\Models\Categorie;
use Exception;

class CategorieService {

    private $imageservice;

    public function __construct()
    {
        $this->imageservice = new ImageService();
    }

   /**
    * @param $limit 
    * @param $page
    */
    public function lists($request){
        try{
            $query = Categorie::orderBy('created_at', 'desc');

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
        $query = Categorie::withTrashed()->orderBy('name', 'asc');

        $categorie = $query->paginate(10, ['*'], 'page', ($request && $request->page) ? $request->page : 1);

        $categorie->setCollection( $categorie->getCollection()->makeVisible( 'deleted_at' ) );
        return $categorie;
    }

    public function listsAllWithoutPagination(){
        $query = Categorie::orderBy('name', 'asc');

        $categorie = $query->get();

        return $categorie;
    }

    public function create($request){
        try{
            $data['name'] = $request->name;
            if(isset($request->description)) $data['description'] = $request->description;
            if(isset($request->uploadedImage)){
                $data['image'] = $this->imageservice->uploadImage($request->uploadedImage, 'categories');
            }

            $categorie = Categorie::create($data);

            return [
                'data' => $categorie
            ];
            
        }catch(Exception $e){
            throw $e;
        }
    }

    public function update($request, $categorie){
        try{
            $data['name'] = $request->name;
            if(isset($request->description)) $data['description'] = $request->description;
            if(isset($request->uploadedImage)){
                $data['image'] = $this->imageservice->uploadImage($request->uploadedImage, 'categories');
                if($categorie->image) $this->imageservice->deleteImge($request->image, 'categories');
            }

            $categorie->fill($data);
            $categorie->save();

            return [
                'data' => $categorie
            ];
            
        }catch(Exception $e){
            throw $e;
        }
    }

    public function delete($categorie, $permanent = false){
        try{
            if($permanent){
                $categorie->forceDelete();
                return [
                    'succes' => 'Menu permanently deleted'
                ];
            }else{
                $categorie->delete();
                return [
                    'succes' => 'Menu deleted'
                ];
            }
        }catch(Exception $e){
            throw $e;
        }
    }
}