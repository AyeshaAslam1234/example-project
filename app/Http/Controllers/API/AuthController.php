<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\User;


class AuthController extends Controller
{
    public function signup(Request $request){
        
        $validateUser = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
        ]);

        if($validateUser->fails()){
            return response()->json([
                'status' => false,
                'message'=> 'validation error',
                'errors' => $validateUser->errors()->all(),
            ], 401);
        }

        $user = User::create([
            'name' => $request->name,
            'email' =>$request->email,
            'password' => bcrypt($request->password),
        ]);

        return response()->json([
            'status' => true,
            'massage' => 'user created successfully',
            'user' =>  $user,
        ],200);

    }
    public function login(Request $request){
        
        $validateUser = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if($validateUser->fails()){
            return response()->json([
                'status' => false,
                'message'=> 'validation error',
                'errors' => $validateUser->errors()->all(),
            ], 404);
        }

        if(!Auth::attempt($request->only('email', 'password'))){
            return response()->json([
                'statue' => false,
                'message' => 'email or password incorrect',

            ], 404);
        }
        $authUser = Auth::user();

        return response()->json([
            'status' => true,
            'massage' => 'user logged in successfully',
            'token' =>  $authUser->createToken("API Token")->plainTextToken,
            'token_type' => 'bearer',
        ],200);
    }
    public function logout(Request $request){
        $request->user()->currentAccessToken()->delete();
        // $request->user()->currentAccessToken()->delete();
        return response()->json([
            'status' => true,
            'message' => 'logout successfully',
        ], 200);
    }
}
