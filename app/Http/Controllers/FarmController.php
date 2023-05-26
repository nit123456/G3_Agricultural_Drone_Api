<?php

namespace App\Http\Controllers;

use App\Models\Farm;
use App\Models\Map;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FarmController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $farm = Farm::all();
        return response()->json(['massage' => 'List of farm', 'success' => true, 'data' => $farm], 201);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validator = Validator::make($request->all(), [
            "codename" => 'required',
            "latitude" => 'required',
            "longitude" => 'required',
            "plant" => 'required',
            "image" => 'required',
            "map_id" => 'required',
            "user_id" => 'required'

        ]);
        if ($validator->fails()) {
            return $validator->errors();
        }
        $farm = Farm::create([
            "codeName" => $request->codeName,
            "latitude" => $request->latitude,
            "longitude" => $request->longitude,
            "plant" => $request->plant,
            "image" => $request->image,
            "map_id" => $request->map_id,
            "user_id" => $request->user_id
        ]);
        return response()->json(['massage' => 'Create new farm successfully', 'success' => true, 'data' => $farm], 201);
    }

    public function getImage()
    {
        $farms = Farm::select('codename', 'image')->get();
        if ($farms->isEmpty()) {
            return response()->json(['massage' => "Don't has farm yet", 'success' => false], 201);
        }
        return response()->json(['massage' => 'List of maps photos', 'success' => true, 'data' => $farms], 201);
    }
    public function getImageBy(string $map, $farm_id)
    {
        $id = Map::select('id')->where('name', $map)->first()->id;
        $image = Farm::select('codename', 'image')->where('id', $farm_id)->where('map_id', $id)->get();
        if ($image->isEmpty()) {
            return response()->json(['massage' => "Farm not fount", 'success' => false], 201);
        }
        return response()->json(['massage' => 'This is all photos', 'success' => true, 'data' =>  $image], 201);
    }
    public function deleteImageBy(string $map, $farm_id)
    {
        $id = Map::select('id')->where('name', $map)->first()->id;
        $image = Farm::select('image')->where('id', $farm_id)->where('map_id', $id);
        $images = $image->get();
        if ($images->isEmpty()) {
            return response()->json(['massage' => "Farm not fount", 'success' => false], 201);
        }
        $image->update(['image' => null]);
        return response()->json(['massage' => "Image of farm ID $farm_id has been deleted", 'success' => true], 201);

        
    }
}
