<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $locations= Location::all();
        if ($locations->isNotEmpty()){
            return response()->json(['message'=>'There are all locations.', 'data'=>$locations],200);
        }
        return response()->json(['message'=>'There is no location.']);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'latitude' => 'required',
            'longitude' =>'required',
        ]);
        if ($validator->fails()) {
            return $validator->errors();
        }
        $location= Location::create([
            'latitude'=>$request->latitude,
            'longitude'=>$request->longitude,
        ]);
        return response()->json(['message'=>'Location has been created.', 'data'=>$location],200);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'latitude' => 'required',
            'longitude' =>'required',
        ]);
        if ($validator->fails()) {
            return $validator->errors();
        }
        $location = Location::find($id);
        if(!$location){
            return response()->json(['message'=>'Location not found'],200);
        }
        $location->update([
            'latitude'=>$request->latitude,
            'longitude'=>$request->longitude,
        ]);
        return response()->json(['message'=>'Location has been updated.', 'data'=>$location],200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $location = Location::find($id);
        if(!$location){
            return response()->json(['message'=>'Location not found'],200);
        }
        $location->destroy($id);
        return response()->json(['message'=>'Location has been deleted.'],200);
    }
}
