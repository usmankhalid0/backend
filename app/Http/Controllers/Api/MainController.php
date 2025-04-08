<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class MainController extends Controller
{
    public function signup (Request $request)
    {
        $validateUser = Validator::make(
            $request->all(),
            [
                'name' => 'required',
                'email' => 'required',
                'password'=> 'required'
            ]
        ) ;
        if ($validateUser->fails())
        {
            return response()->json([
                'status' => false,
                'message' => 'Validation Error',
                'errors' => $validateUser->errors()->all()
            ],401);
        }
        $user = User::Create([
            'name' =>$request->name,
            'email'=>$request->email,
            'password' => Hash::make($request->password)
        ]);
        return response()->json([
            'status' => true,
            'message' => 'User is Created',
            'user' => $user 
        ],201);
    }
    public function login (Request $request)
    {
        $validateUser = Validator::make(
            $request->all(),
            [
                'email' => 'required',
                'password'=> 'required'
            ]
        ) ;
        if ($validateUser->fails())
        {
            return response()->json([
                'status' => false,
                'message' => 'Authention failed',
                'errors' => $validateUser->errors()->all()
            ],401);
        }
        if (Auth::attempt(['email'=>$request->email ,'password'=>$request->password]))
        {
            $authuser = Auth::user();
            return response()->json([
                'status' => true,
                'message' => 'User log in successfully',
                'Api-Token' => $authuser->createToken('API-Token')->plainTextToken,
                'token-type' =>'bearer' 
            ],200);
        }else
        {
            return response()->json([
                'status' => false,
                'message' => 'Email and password are not matched',
            ],401);
        }
    }
    public function logout (Request $request)
    {
       $user = $request->user();
       $user->tokens()->delete();
       
       return response()->json([
        'status' => true,
        'message' => 'User log out successfully', 
    ],200);
    }

}
