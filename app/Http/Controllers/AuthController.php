<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
     * @return \Response
     */

     public function register(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email'=> 'required|email|unique:users',
            'password' => 'required|confirmed',
            'role_id' => 'required'
        ]);

        return $validator;

        
     }
}
