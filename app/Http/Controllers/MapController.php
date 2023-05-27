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
        if ($map->isNotEmpty()){
            return response()->json(['massage'=>'There are all maps','success'=>true,'data'=>$map],201);
        }
        return response()->json(['message'=>'There is no map']);
        
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

    public function update(Request $request,$id){
        $map = Map::find($id);
        if (!$map){
            return response()->json(['massage'=>'Map not found'],201);
        }
        $map->update([
            'name' => $request->name,
        ]);
        return response()->json(['message'=>'Map is update',"data"=>$map],201);
    }
    public function destroy(Request $request,$id){
        $map = Map::find($id);
        if (!$map){
            return response()->json(['massage'=>'Map not found'],201);
        }
        $map->destroy($id);
        return response()->json(['massage'=>'Map is delete'],201);
    }
    

    
}
