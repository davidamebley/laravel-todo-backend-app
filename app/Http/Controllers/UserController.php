<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function signup(Request $request){
        $fields = $request->validate([
            'email' => 'required|string|unique:users,email',    //unique to the users table and the email field
            'password' => 'required|string|confirmed'
        ]);

        //Create New User 
        $user = User::create([
            'email' => $fields['email'],
            'password' => bcrypt($fields['password'])
        ]);

        //Create a new token for this user
        $token = $user->createToken('myapptoken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);    //Success and created
    }

    public function signin(Request $request){
        $fields = $request->validate([
            'email' => 'required|string',    //unique to the users table and the email field
            'password' => 'required|string'
        ]);

        // Check email
        $user = User::where('email', $fields['email'])->first();    //first email instance that matches

        //Check password
        if (!$user || !Hash::check($fields['password'], $user->password)) {
            return response([
                'message' => 'Error. Check your login details and try again'
            ], 401);
        }

        $token = $user->createToken('myapptoken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);    //Success and created
    }

    public function logout(Request $request){
        auth()->user()->tokens()->delete();

        return [
            'message' => 'Logged out successfully'
        ];
    }
}
