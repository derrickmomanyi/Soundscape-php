<?php

namespace App\Http\Controllers;

use App\Models\Song;
use App\Services\SongService;
use Illuminate\Http\Request;

class SongController extends Controller
{
    public function getSongsApi(Request $request)
    {
        return SongService::getSongs($request);
    }

    public function getSongDetailsApi($SongID)
    {
        return SongService::getSongDetails($SongID);
    }
}
