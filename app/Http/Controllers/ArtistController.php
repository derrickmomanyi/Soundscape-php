<?php

namespace App\Http\Controllers;

use App\Models\Artist;
use App\Services\ArtistService;
use Illuminate\Http\Request;

class ArtistController extends Controller
{
    
    public function getArtistsApi(Request $request)
    {
        return ArtistService::getArtists($request);
    }

    public function getArtistDetailsApi($artistID)
    {
        return ArtistService::getArtistDetails($artistID);
    }
   

   
}
