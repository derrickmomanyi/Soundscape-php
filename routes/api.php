<?php

use App\Http\Controllers\ArtistController;
use App\Http\Controllers\AlbumController;
use App\Http\Controllers\SongController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\USerSongController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::group(['middleware' => 'api'], function () {
     /**
     * API V1 Collection
     */
    Route::prefix('v1')->group(function () {
         /**
         * Auth APIs
         */        
        Route::post('register', [AuthController::class, 'register']);
        Route::post('login', [AuthController::class, 'login']);
        Route::post('logout', [AuthController::class, 'logout']);      
        Route::post('me', [AuthController::class, 'me']);        
       

        /**
         * Artist APIs
         */
        Route::prefix('artists')->group(function () {
            Route::get('/', [ArtistController::class,'getArtistsApi'])->middleware(['auth:api']);
            Route::get('/{artistID}', [ArtistController::class,'getArtistDetailsApi'])->middleware(['auth:api']);           
        });

         /**
         * Album APIs
         */
        Route::prefix('albums')->group(function () {
            Route::get('/', [AlbumController::class,'getAlbumsApi'])->middleware(['auth:api']);
            Route::get('/{AlbumID}', [AlbumController::class,'getAlbumDetailsApi'])->middleware(['auth:api']);           
        });

        /**
         * Song APIs
         */
        Route::prefix('songs')->group(function () {
            Route::get('/', [SongController::class,'getSongsApi'])->middleware(['auth:api']);
            Route::get('/{SongID}', [SongController::class,'getSongDetailsApi'])->middleware(['auth:api']);           
        });

        /**
         * User Song APIs
         */
        Route::prefix('user-songs')->group(function () {
            Route::get('/', [USerSongController::class,'getUserSongsApi'])->middleware(['auth:api']);
            Route::post('/', [USerSongController::class,'createUserSongsApi'])->middleware(['auth:api']);
            Route::delete('/{userSongID}', [UserSongController::class,'deleteUSerSongApi'])->middleware(['auth:api']);           
        });

       
    });
});
