<?php

namespace App\Services;

use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;

/**
 * Class ApiResponsesService.
 */
class ApiResponsesService
{
    /**
     * Unauthenticated
     * @return ResponseFactory|Response
     */
    public static function notauthenticated(){
        return response([
            "success"           => false,
            "errors"            => ["Unauthenticated"],
            "status_code"       => 1,
            "status_message"    => "failed",
            "message"           => "You're unauthenticated. Please login first."
        ], 401);
    }

     /**
     * Unauthorised / Forbidden
     * @return ResponseFactory|Response
     */
    public static function unauthorised(){
        return response([
            "success"           => false,
            "errors"            => ["Unauthorised"],
            "status_code"       => 1,
            "status_message"    => "failed",
            "message"           => "You're not authorised to perform this action."
        ], 403);
    }

    /**
     * Success creation response
     * @param null $data
     * @param string $message
     * @return ResponseFactory|Response
     */
    public static function successCreation($data = null, $message ="Success"){
        return response([
            "success"           => true,
            "errors"            => null,
            "status_code"       => 0,
            "status_message"    => "success",
            "message"           => $message,
            "data"              => $data
        ]);
    }

    public static function successUpdate($data = null, $message ="Success"){
        return response([
            "success"           => true,
            "errors"            => null,
            "status_code"       => 0,
            "status_message"    => "success",
            "message"           => $message,
            "data"              => $data
        ]);
    }

    /**
     * Successfully fetched resources
     * @param null $data
     * @param string $message
     * @return ResponseFactory|Response
     */
    public static function successFetch($data = null, $message ="Successfully fetched data"){
        return response([
            "success"           => true,
            "errors"            => null,
            "status_code"       => 0,
            "status_message"    => "success",
            "message"           => $message,
            "data"              => $data
        ]);
    }

    /**
     * Returning success fetch with paginated data
     * @param null $data
     * @param string $message
     * @return ResponseFactory|Response
     */
    public static function successFetchPaginated($data = null, $message ="Successfully fetched data"){

        $custom_collection = collect([
            "success"           => true,
            "errors"            => null,
            "status_code"       => 0,
            "status_message"    => "success",
            "message"           => $message
        ]);

        return response($custom_collection->merge($data));

    }

    /**
     * Resource not found
     * @param string $error
     * @param string $message
     * @return ResponseFactory|Response
     */
    public static function notFound($error = "Not found", $message ="Not Found"){
        return response([
            "success"           => false,
            "errors"            => is_array($error) ? $error : [$error],
            "status_code"       => 1,
            "status_message"    => "failed",
            "message"           => $message,
            "data"              => null
        ],200);
    }

    /**
     * An error occurred.
     * @param null $error
     * @param string $message
     * @return ResponseFactory|Response
     */
    public static function error($error=null, $message ="An error occurred"){
        return response([
            "success"           => false,
            "errors"            => is_array($error) ? $error : [$error],
            "status_code"       => 1,
            "status_message"    => "failed",
            "message"           => $message,
            "data"              => null
        ]);
    }

    /**
     * Success deletion response
     * @param string $message
     * @return ResponseFactory|Response
     */
    public static function successDeletion($message = "Deletion successful"){
        return response([
            "success"           => true,
            "errors"            => null,
            "status_code"       => 0,
            "status_message"    => "success",
            "message"           => $message
        ]);
    }

    /**
     * Internal Server error response
     * @param null $error
     * @param string $message
     * @return ResponseFactory|Response
     */
    public static function internalServerError($error = null, $message ="Oops, Something went terrible wrong on our end! You viewing this does not fix the issue. You're likely pissed off at the moment. Take Solace, Top Men are now aware."){
        return response([
            "success"           => false,
            "errors"            => is_array($error) ? $error : [$error],
            "status_code"       => 1,
            "status_message"    => "failed",
            "message"           => $message
        ],200);
    }

    /**
     * A bad request.
     * @param null $error
     * @param string $message
     * @return ResponseFactory|Response
     */
    public static function badRequest($error=null, $message ="Ooops! Something is wrong with your request. Please correct it first."){
        return response([
            "success"           => false,
            "errors"            => is_array($error) ? $error : [$error],
            "status_code"       => 1,
            "status_message"    => "failed",
            "message"           => $message,
            "data"              => null
        ],400);
    }

}
