<?php

namespace App\Services;

use App\Models\Song;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

/**
 * Class SongService.
 */
class SongService
{
    /**
     * Get Songs
     * @param Request $request
     * @return ResponseFactory|Response
     */
    public static function getSongs(Request $request)
    {
        $s = $request->s ?? null;
        $records = $request->records ?? 10;

        if(isset($s) && $s != null) {
            $songs = Song::where("name","like", "%$s%") 
              ->paginate($records);
        }
        else{
            $songs = Song::paginate($records);
        }
        if(isset($songs) && count($songs) > 0){
            return ApiResponsesService::successFetchPaginated($songs, "Successfully fetched Songs");
        }
        else{
            return ApiResponsesService::notFound("No Songs found", "No Songs found");
        }
        
    }

      /**
     * Get single estate details
     * @param $estateID
     * @return ResponseFactory|Response
     */
    public static function getSongDetails($SongID)
    {
        
        $Song = Song::where('id', $SongID)->first();

        if ($Song) {
            return ApiResponsesService::successFetch($Song);
        } else {
            return ApiResponsesService::notFound("The Song could not be found.");
        }
    }
}
