<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $farmer= User::all();
        if ($farmer->isNotEmpty()){
            return response()->json(['message'=>'List of farmers', 'data'=>$farmer],200);
        }
        return response()->json(['message'=>'There are no farmer.']);
        
    }

    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:4',
        ];
        $validated = Validator::make($request->all(),$rules);
        if ($validated->fails()){
            return $validated->errors();
        }
        $farmer= User::create($validated->validated());
        return response()->json(['message' => 'Farmer has been created.', 'data' => $farmer], 200);
    }
}
