<?php

namespace App\Http\Controllers;

use App\Models\Authentication;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthenticationController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|unique:users,email',
            'password' => 'required',

        ]);
        if ($validator->fails()) {
            return $validator->errors();
        }
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);
        $token = $user->createToken('API Token', ['select', 'create', 'delete', 'update'])->plainTextToken;
        return response()->json([
            'user' => $user,
            'token' => $token
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        return "logout";
    }

    public function login(Request $request)
    {
        // get email and password
        $credentials = $request->only('email', 'password');
        // check if email and password valid
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $token = $user->createToken('API Token', ['select', 'create', 'delete', 'update'])->plainTextToken;
            return response()->json(["message" => "success", "user" => $user, "token" => $token], 200);
        }
        return response()->json([
            'message' => 'Invalid credentials'
        ], 401);
    }
}
