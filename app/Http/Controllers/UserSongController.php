<?php

namespace App\Http\Controllers;

use App\Models\UserSong;
use Illuminate\Http\Request;
use App\Services\USerSongService;

class UserSongController extends Controller
{
    public function getUserSongsApi(Request $request)
    {
        return UserSongService::getUserSongs($request);
    }

    public function createUserSongsApi(Request $request)
    {
        return UserSongService::createUserSongs($request);
    }

    public function deleteUserSongApi($userSongID)
    {
        return UserSongService::deleteUserSong($userSongID);
    }
}
