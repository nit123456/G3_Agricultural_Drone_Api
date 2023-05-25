<?php

namespace App\Http\Controllers;

use App\Models\Farm;
use Illuminate\Http\Request;

class FarmController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $farm = Farm::all();
        return response()->json(['massage'=>'List of farm','success'=>true,'data'=>$farm],201);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $farm = Farm::create([
            "codeName" => $request->codeName,
            "latitude" => $request->latitude,
            "longitude" => $request->longitude,
            "plant" => $request->plant,
            "map_id" => $request->map_id,
            "user_id" => $request->user_id
        ]);
        return response()->json(['massage'=>'Create new farm successfully','success'=>true,'data'=>$farm],201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Farm $farm)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Farm $farm)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Farm $farm)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Farm $farm)
    {
        //
    }
}
