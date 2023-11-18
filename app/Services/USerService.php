<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
/**
 * Class USerService.
 */
class USerService
{
     /**
     * Creating a user account
     * @param Request $request
     * @return mixed
     */
    public static function createUser(Request $request)
    {

        try {          

            $user = new User();
            $user->name = $request->name;           
            $user->email = $request->email;
            $user->password = Hash::make($request->password);            

            $user->save();

            return $user;

        } catch (\Exception $exception) {
            return null;

        }

    }
}
