<?php

namespace App\Services;

use App\Models\Subscription;
use Exception;

class SubscribeService {
  
    public function subscribe($request){
        try{
            $subscribe = Subscription::where('email', $request->email)->first();

            if(!$subscribe){
                $subscribe = Subscription::create([
                    'email' => $request->email
                ]);
            }

            return $subscribe;
        }catch(Exception $e){
            throw $e;
        }
    }

    public function listsAll($request){
        $query = Subscription::orderBy('created_at', 'desc');

        $subscription = $query->paginate(10, ['*'], 'page', ($request && $request->page) ? $request->page : 1);

        return $subscription;
    }

}