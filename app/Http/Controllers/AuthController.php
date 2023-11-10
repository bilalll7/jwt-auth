<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }
    public function respondWithToken($token){
        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
            'expires_in' => $this->guard()->factory()->getTTL() * 1440
        ]);
    }
    public function login(Request $request){
        $credentials = $request->only('username','password');
        if($token = $this->guard()->attempt($credentials)){
            return $this->respondWithToken($token);
        }
        return response()->json(['error' => 'Unaothorized'],401);
    }
    public function me(){
        return response()->json($this->guard()->user());
    }
    public function resetPassword(Request $request){
        $validator = Validator::make($request->all(),[
            'old_password' => 'required',
            'new_password' => 'required'
        ]);
        if($validator->fails()){
            return response()->json($validator->errors(),422);
        }
        $user = $request->user();
        if(Hash::check($request->old_password, $user->password)){
            $user->update([
                'password' => Hash::make($request->new_password),
            ]);
            return response()->json([
                'message' => 'reset success, user logged out'
            ],200);
        }else{
            return response()->json([
                'message' => 'old password did not match'
            ],401);
        }
    }
    public function guard()
    {
        return Auth::guard();
    }
}