<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthenticationController extends Controller
{
    public function register(Request $request){
        $rules = [
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:4',
        ];
        $validated = Validator::make($request->all(),$rules);
        if ($validated->fails()){
            return $validated->errors();
        }
        $user = User::create([
            'name'=>$request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        $token = $user->createToken('token-name')->plainTextToken;
        return response()->json(['message' => 'User has been created.', 'data' => $user, 'token' => $token], 200);
    }
}
