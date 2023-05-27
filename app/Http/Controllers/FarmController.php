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
            "codeName" => 'required',
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

    // getImage()

    public function getImage()
    {
        $farms = Farm::select('codeName', 'image')->get();
        if ($farms->isEmpty()) {
            return response()->json(['massage' => "Farm not found", 'success' => false], 201);
        }
        return response()->json(['massage' => 'List of maps photos', 'success' => true, 'data' => $farms], 201);
    }
    public function getImageBy(string $map, $farm_id)
    {
        $id = Map::select('id')->where('name', $map)->first()->id;
        $image = Farm::select('codeName', 'image')->where('id', $farm_id)->where('map_id', $id)->get();
        if ($image->isEmpty()) {
            return response()->json(['massage' => "There are no image", 'success' => false], 201);
        }
        return response()->json(['massage' => 'This is all image', 'success' => true, 'data' =>  $image], 201);
    }
    public function deleteImageBy(string $map, $farm_id)
    {
        $map_id = Map::select('id')->where('name', $map)->first()->id;
        $image = Farm::select('image')->where('id', $farm_id)->where('map_id', $map_id);
        $images = $image->get();
        if ($images->isEmpty()) {
            return response()->json(['massage' => "Farm not fount", 'success' => false], 201);
        }
        $image->update(['image' => "null"]);
        return response()->json(['massage' => "Image of farm ID $farm_id has been deleted", 'success' => true], 201);
    }
    public function setImageBy(Request $request, string $map, $farm_id)
    {
        $validator = Validator::make($request->all(), [
            "image" => 'required',

        ]);
        if ($validator->fails()) {
            return $validator->errors();
        }
        $map_id = Map::select('id')->where('name', $map)->first()->id;
        $farm = Farm::where('id', $farm_id)->where('map_id', $map_id);
        $imaages= $farm->get();
        if ($imaages->isEmpty()) {
            return response()->json(['message' => 'There are no images'], 404);
        }
        $farm->update(['image' => $request->image]);
        return response()->json(['massage' => "You add new image successfully", 'success' => true, 'data' =>  $imaages], 201);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            "codeName" => 'required',
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
        $farm = Farm::find($id);
        if (!$farm) {
            return response()->json(['message' => 'Farm does not exist'], 201);
        }
        $farm->update([
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
    public function delete($id)
    {
        $farm = Farm::find($id);
        if (!$farm) {
            return response()->json(['massage' => 'Farm not found'], 201);
        }
        $farm->destroy($id);
        return response()->json(['message' => 'Farm has been deleted.'], 200);
    }
}
