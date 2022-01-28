<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $fields = $request->validate([
            'username' => 'required|string|unique:inFine_users,username|min:3|max:20',
            'email' => 'required|email|unique:inFine_users,email',
            'password' => 'required|string|min:6|confirmed',
            //  'address' => 'string|nullable',
            //           'imageAvatar' => 'string|nullable',
        ]);

        /*        $user = new User;

                $user->username = $fields['username'];
                $user->email = $fields['email'];
                $user->password = bcrypt($fields['password']);
                $user->save();*/

        $user = User::create([
            'username' => $fields['username'],
            'email' => $fields['email'],
            'password' => bcrypt($fields['password']),

            //    'address' => $fields['address'],
//            'imageAvatar' => $fields['imageAvatar'],

        ]);
        $token = $user->createToken('remember_token')->plainTextToken;
        $user -> remember_token = $token;
        $user -> save();
        $response = [
            'user' => $user,
            'remember_token' => $token,
        ];
        return Response($response, 201);

    }
}
