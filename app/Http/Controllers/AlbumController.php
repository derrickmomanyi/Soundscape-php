<?php

namespace App\Http\Controllers;
use App\Services\AlbumService;

use App\Models\Album;
use Illuminate\Http\Request;

class AlbumController extends Controller
{
    public function getAlbumsApi(Request $request)
    {
        return AlbumService::getAlbums($request);
    }

    public function getAlbumDetailsApi($albumID)
    {
        return AlbumService::getAlbumDetails($albumID);
    }
}
