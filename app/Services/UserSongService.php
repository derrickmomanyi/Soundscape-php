<?php

namespace App\Services;



use App\Models\USerSong;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

/**
 * Class UserSongService.
 */
class UserSongService
{

     /**
     * Get Songs
     * @param Request $request
     * @return ResponseFactory|Response
     */
    public static function getUserSongs(Request $request)
    {
        $s = $request->s ?? null;
        $records = $request->records ?? 10;

        if(isset($s) && $s != null) {
            $userSongs = UserSong::where("name","like", "%$s%") 
              ->paginate($records);
        }
        else{
            $userSongs = USerSong::with(['song', 'user'])->paginate($records);
        }
        if(isset($userSongs) && count($userSongs) > 0){
            return ApiResponsesService::successFetchPaginated($userSongs, "Successfully fetched User Songs");
        }
        else{
            return ApiResponsesService::notFound("No User Songs found", "No User Songs found");
        }
        
    }

    public static function createUserSongs(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'song_id' => 'required|exists:songs,id|unique:user_songs,song_id,NULL,id,user_id,' . $request->input('user_id'),
            
        ]);

        if ($validator->fails()) {
            return ApiResponsesService::error($validator->errors()->all(), ResponseMessagesService::VALIDATION_ERRORS);
        }

        try{
            $userSong = new UserSong();
            $userSong->user_id = $request->input('user_id');
            $userSong->song_id = $request->input('song_id');
            $userSong->save();

            return ApiResponsesService::successCreation($userSong, "User Song successfully created");
        }
        catch(\Exception $exception){
            return ApiResponsesService::internalServerError("An error occurred while creating the user song. Please try again later.","An error occurred while user song estate. Please try again later.");
        }
    }

}
