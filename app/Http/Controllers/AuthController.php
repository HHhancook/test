<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api', [
            'except' => [
                'login',
                'register'
            ]
        ]);
    }

    public function register(Request $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password) 
        ]);

        $token = Auth::login($user);

        return response()->json([
            'status' => 'success',
            'message' => 'User Registered Successfully',
            'user' => $user,
            'token' => $token
        ]);
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        $token = Auth::attempt($credentials);

        if (!$token) {
            return response()->json([
                'status' => 'error',
                'message' => 'Login Failed'
            ]);
        }
        $user = User::where('id',Auth::id())->first();
        
        return response()->json([
            'status' => 'success',
            'message' => 'Logged in successfully!',
            'user'=> $user,
            'token' => $token
        ]);
    }

    public function getUser(){
        return User::all();
    }

    public function logeut()
    {
        Auth::logout();
        return response()->json([
            'status' => 'success',
            'message' => 'Loggut!',
        ]);
    }
}
