<?php

namespace App\Services;

use App\Models\Album;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

/**
 * Class AlbumService.
 */
class AlbumService
{
     /**
     * Gwt Albums
     * @param Request $request
     * @return ResponseFactory|Response
     */
    public static function getAlbums(Request $request)
    {
        $s = $request->s ?? null;
        $records = $request->records ?? 10;

        if(isset($s) && $s != null) {
            $albums = Album::where("name","like", "%$s%") 
              ->paginate($records);
        }
        else{
            $Albums = Album::paginate($records);
        }
        if(isset($Albums) && count($Albums) > 0){
            return ApiResponsesService::successFetchPaginated($Albums, "Successfully fetched Albums");
        }
        else{
            return ApiResponsesService::notFound("No Albums found", "No Albums found");
        }
        
    }

      /**
     * Get single estate details
     * @param $estateID
     * @return ResponseFactory|Response
     */
    public static function getAlbumDetails($AlbumID)
    {
        
        $Album = Album::where('id', $AlbumID)->first();

        if ($Album) {
            return ApiResponsesService::successFetch($Album);
        } else {
            return ApiResponsesService::notFound("The Album could not be found.");
        }
    }

}
