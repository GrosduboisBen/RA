<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\Users;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{


    public function register(Request $request)
    {

        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required',
                'firstname' => 'required',
                'username' => 'required',
                'age' => 'required',
                'email' => 'required',
                'password' => 'required',
            ]
        );
        if ($validator->fails()) {
            return response('', 400);
        } else {
            $user = new User;

            $user->age = $request->age;
            $user->firstname = $request->firstname;
            $user->name = $request->name;
            $user->username = $request->login;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);


            $user->save();

            return response('Created', 201);
        }
    }

    public function get_user()
    {

        $to_send = new Users(User::all(['id', 'username', 'firstname', 'name', 'email', 'age']));

        return response($to_send, 200,);
    }


    public function get_u($id)
    {

        $to_send = new UserResource(User::findOrFail($id, ['id', 'username', 'firstname', 'name', 'email', 'age']));

        return response($to_send, 200);
    }
}
