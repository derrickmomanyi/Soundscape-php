<?php

namespace App\Services;

use App\Models\Artist;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

/**
 * Class ArtistService.
 */
class ArtistService
{
    /**
     * Gwt Artists
     * @param Request $request
     * @return ResponseFactory|Response
     */
    public static function getArtists(Request $request)
    {
        $s = $request->s ?? null;
        $records = $request->records ?? 10;

        if(isset($s) && $s != null) {
            $artists = Artist::where("name","like", "%$s%") 
              ->paginate($records);
        }
        else{
            $artists = Artist::paginate($records);
        }
        if(isset($artists) && count($artists) > 0){
            return ApiResponsesService::successFetchPaginated($artists, "Successfully fetched artists");
        }
        else{
            return ApiResponsesService::notFound("No artists found", "No artists found");
        }
        
    }

      /**
     * Get single estate details
     * @param $estateID
     * @return ResponseFactory|Response
     */
    public static function getArtistDetails($artistID)
    {
        
        $artist = Artist::where('id', $artistID)->first();

        if ($artist) {
            return ApiResponsesService::successFetch($artist);
        } else {
            return ApiResponsesService::notFound("The artist could not be found.");
        }
    }


}
