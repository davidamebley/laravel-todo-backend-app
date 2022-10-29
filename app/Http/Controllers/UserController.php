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

    public function changePassword(Request $request){
        // Let's first validate our input vals
        $fields = $request->validate([
            'current_password' => 'required|string',
            'new_password' => 'required|string|confirmed'
        ]);
        
        // Check if current and new passwords are the same
        if (strcmp($request->get('current_password'), $request->get('new_password'))==0) {//strcmp compares both strs and returns 0 if match
            return response([
                'message' => 'Error. Your current password should not be the same as your new password'
            ], 400);
        }
        
        // Check if current password entered match with that of db for security purpose
        if (!(Hash::check($request->get('current_password'), auth()->user()->password))) {
            return response([
                'message' => 'Error. The current password you entered does not match with your existing password. Please try again'
            ], 401);
        }
        //Finally change the password
        $user = auth()->user();
        $user->password = bcrypt($request->get('new_password'));
        $user->save();

        return response([
            'message' => 'Password changed successfully'
        ], 201);
    }
}
