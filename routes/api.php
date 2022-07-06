<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\CategorieController as AdminCategorieController;
use App\Http\Controllers\Admin\MenuController as AdminMenuController;
use App\Http\Controllers\Admin\ReservationController as AdminReservationController;
use App\Http\Controllers\Admin\SubscriptionController;
use App\Http\Controllers\Front\CategorieController;
use App\Http\Controllers\Front\MenuController;
use App\Http\Controllers\Front\ReservationController;
use App\Http\Controllers\Front\SubscribeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/**
 * list of categories
 * set only one of the parameter
 * @param query limit - set a limit depending on how many we want to get 
 * @param query page - set pagination limit depending on how many per page we want to get
 */
Route::get('/categories-list', [CategorieController::class, 'lists']);

/**
 * list of menus
 * set only one of the parameter
 * @param query limit - set a limit depending on how many we want to get 
 * @param query page - set pagination limit depending on how many per page we want to get
 */

Route::get('/menus-list', [MenuController::class, 'lists']);

// list of menu limited to few categorie and limited menu list
Route::get('/menu-resumes', [MenuController::class, 'resumes']);

// subscribe to email to have new recipe notification
Route::post('/subscribe', [SubscribeController::class, 'subscribe']);

// make reservation 
Route::post('/new-reservation', [ReservationController::class, 'reservation']);

// api for admin
Route::prefix('admin')->name('admin.')->group(function(){
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:api');
    
    Route::middleware('auth:api')->group(function(){
        // for middleware checking if token still valide
        Route::get('/check-auth', function(){
            return response()->json([
                'succes' => 'Authenticated'
            ]);
        });

        // endpoint reservation
        Route::prefix('reservation')->name('reservation.')->group(function(){
            Route::get('/list-all', [AdminReservationController::class, 'listAll']);
        });

        // endpoint subscription
        Route::prefix('subscription')->name('reservation.')->group(function(){
            Route::get('/list-all', [SubscriptionController::class, 'listAll']);
        });

        // endpoint categorie
        Route::prefix('categorie')->name('categorie.')->group(function(){
            Route::get('/list-all', [AdminCategorieController::class, 'listAll']); // set query parameter all = 1 to get list without pagination
            Route::post('/create', [AdminCategorieController::class, 'create']);
            Route::put('/update/{categorie}', [AdminCategorieController::class, 'update']);
            Route::delete('/delete/{categorie}', [AdminCategorieController::class, 'delete']);
        });

        // endpoint menus
        Route::prefix('menus')->name('menus.')->group(function(){
            Route::get('/list-all', [AdminMenuController::class, 'listAll']);
            Route::post('/create', [AdminMenuController::class, 'create']);
            Route::put('/update/{menu}', [AdminMenuController::class, 'update']);
            Route::delete('/delete/{menu}', [AdminMenuController::class, 'delete']);
        });
    });
});



