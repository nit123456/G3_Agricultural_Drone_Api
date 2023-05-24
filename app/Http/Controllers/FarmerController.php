<?php

namespace App\Http\Controllers;

use App\Models\Farmer;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class FarmerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $farmer= Farmer::all();
        if ($farmer->isNotEmpty()){
            return response()->json(['message'=>'List of farmers', 'data'=>$farmer],200);
        }
        return response()->json(['message'=>'There are no farmer.']);
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function register(Request $request)
    {
        $request->validate([
            'firstName'=>'required|string',
            'lastName'=>'required|string',
            'email'=>'required|email|unique:Farmers',
            'password'=>'required|string|confirmed|min:4',
        ]);
        $farmer= Farmer::create([
            'firstName'=>$request->firstName,
            'lastName'=>$request->lastName,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
        ]);
        return response()->json(['message'=>'Farmer has been created.', 'data'=>$farmer],200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Farmer $farmer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Farmer $farmer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Farmer $farmer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Farmer $farmer)
    {
        //
    }
}
