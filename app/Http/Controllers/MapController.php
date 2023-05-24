<?php

namespace App\Http\Controllers;

use App\Models\Map;
use Illuminate\Http\Request;

class MapController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $map = Map::all();
        return response()->json(['massage'=>'List of maps','success'=>true,'data'=>$map],201);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $map = Map::create([
            'name' => $request->name,
        ]);
        return response()->json(['massage'=>'You create new map successfully','success'=>true,'data'=>$map],201);
    }

    
}
