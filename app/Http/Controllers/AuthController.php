<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\ApiResponsesService;
use App\Services\ResponseMessagesService;
use App\Services\USerService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Carbon;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register', 'resetPasswordToken', 'refresh',
            'getRolesApi']]);
    }

    /**
     * Register a user
     * @param Request $request
     * 
     */
     public function register(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email'=> 'required|email|unique:users',
            'password' => 'required|confirmed'
        ]);

       if ($validator->fails()){
        return ApiResponsesService::error($validator->errors()->all(), "Please fix all the errors before proceeding.");
       }

       $user_service = new USerService();

       try{
          //user creation
          $user = $user_service->createUser($request);
          $credentials = request(['email', 'password']);
          $token = auth()->guard('api')->attempt($credentials);
          $user_details = auth()->guard('api')->user();

          $token_collection = collect([
            'token'=>$token,
            'token_type'=>'bearer'
        ]);

        return ApiResponsesService::successFetch($token_collection->merge($user_details),"Registration Successful. Please verify your email.");

       } catch (\Exception $exception) {
        return ApiResponsesService::internalServerError("An error occurred while creating your account, please try again.", "An error occurred while creating your account, please try again.");
        }       
     }

     public function login(Request $request){
        $host = $request->headers->get('host') ?? NULL;
        $guardName = $request->headers->get('guard-name') ?? NULL;
       
        if (!$host || !$guardName){
            return ApiResponsesService::badRequest('Guard details or host details is empty.');
        }

        $credentials = request(['email', 'password']);

        if (!$token = auth()->guard('api')->attempt($credentials)) {
            return ApiResponsesService::error(ResponseMessagesService::INCORRECT_CREDENTIALS,ResponseMessagesService::INCORRECT_CREDENTIALS);
        }

         // update user login fields
         $user = User::find(auth()->guard('api')->user()->id);         
         $user->last_login_at = Carbon::now()->toDateTimeString();
         $user->last_login_ip = $request->getClientIp();
         $user->save();

         if (auth()->guard('api')->user()->suspended == 'Yes') {
            auth()->guard('api')->logout();
            return ApiResponsesService::error(ResponseMessagesService::SUSPENDED_ACCOUNT, ResponseMessagesService::SUSPENDED_ACCOUNT);
        } else {
            $token_collection = collect([
                'token'=>$token,
                'token_type'=>'bearer'
            ]);
            return ApiResponsesService::successFetch($token_collection->merge($user),ResponseMessagesService::LOGIN_SUCCESSFUL);
        }
     }
}
