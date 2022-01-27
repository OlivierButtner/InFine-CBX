<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(): Response
    {
        $all = User::all();
        return response($all, 200);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request): Response
        /*    {
                if (auth()->user()->guard) {
                    $userCreated = new User;

                    $userCreated->username = $request->username;
                    $userCreated->email = $request->email;
                    $userCreated->password = $request->password;
                    $userCreated->imageAvatar = $request->imageAvatar;
                    $userCreated->address = $request->address;
                    $userCreated->myEvents = $request->myEvents;
                    $userCreated->myComments = $request->myComments;

                    $userCreated->save();


                    return response(json_encode($userCreated), 201);
                } else {
                    return response('Vous ne pouvez pas créer de profil', 403);
                }
            }*/
    {
        $userCreated = new User;

        $userCreated->username = $request->username;
        $userCreated->email = $request->email;
        $userCreated->password = $request->password;
        $userCreated->imageAvatar = $request->imageAvatar;
        $userCreated->address = $request->address;
        $userCreated->myEvents = $request->myEvents;
        $userCreated->myComments = $request->myComments;

        $userCreated->save();

        return response(json_encode($userCreated), 201);
    }


    /**
     * Display the specified resource.
     *
     * @param $user
     * @return Response
     */
    public function show($user): Response
    {
        return User::find($user);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param User $user
     * @return void
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param User $user
     * @return Response
     */
    public function update(Request $request, User $user): Response
    {
        $user = User::find($user);
        if (auth()->user()->is_admin == 1) {

            $user->username = $request->username;
            $user->email = $request->email;
            $user->password = $request->password;
            $user->imageAvatar = $request->imageAvatar;
            $user->address = $request->address;

            $user->save();

            return response(json_encode($user), 200);
        } else {
            if (Auth::id() == $user->id) {

                $user->username = $request->username;
                $user->email = $request->email;
                $user->password = $request->password;
                $user->imageAvatar = $request->imageAvatar;
                $user->address = $request->address;

                $user->save();

                return response(json_encode($user), 200);
            } else {
                return response('Mise à jour non autorisée', 403);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     * @return Response
     */
    public function destroy(User $user): Response
    {
        $user = User::find($user);
        if (auth()->user()->is_admin == 1) {
            $user->delete();
            return response('Utilisateur effacé !', 200);
        } else {
            if (Auth::id() == $user->id) {
                $user->delete();
                return response('compte effacé !', 200);
            } else {
                return response('Vous ne pouvez pas effacer d utilisateur', 403);
            }
        }
    }
}
