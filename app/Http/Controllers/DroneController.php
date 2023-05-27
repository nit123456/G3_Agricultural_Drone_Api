<?php

namespace App\Http\Controllers;

use App\Models\Drone;
use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class DroneController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $drones = Drone::all();
        if ($drones->isEmpty()){
            return response()->json(['message' => 'There are no drones'], 404);
        }
        return response()->json(['message' => 'There are all drones', 'success' => true, 'data' => $drones], 201);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validator = Validator::make($request->all(), [
            'codeName' =>'required',
            'type' =>'required',
            'mode' =>'required',
            'strength' =>'required',
            'battery' =>'required',
            'location_id' =>'required',
            'user_id' =>'required',

        ]);
        if ($validator->fails()) {
            return $validator->errors();
        }
        $drone = Drone::create([
            'codeName' => $request->codeName,
            'type' => $request->type,
            'mode' => $request->mode,
            'strength' => $request->strength,
            'battery' => $request->battery,
            'location_id' => $request->location_id,
            'user_id' => $request->user_id,
        ]);

        return response()->json(['message' => 'You created a new drone.', 'data' => $drone], 201);
    }

    public function getDroneByCodeName($codeName)
    {
        $drone = Drone::where('codeName', $codeName)->first();
        if ($drone) {
            return response()->json(['message' => 'Drone has found', 'success' => true, 'data' => $drone], 201);
        }
        return response()->json(['message' => 'Drone is not found'], 404);
    }
    public function showDroneLocation($codeName, $location)
    {
        $drone = Drone::where('codeName', $codeName)->first();
        if ($drone) {
            $location = Location::find($drone->location_id);
            return response()->json(['message' => 'This is drone location', 'success' => true, 'data' => $location], 201);
        }
        return response()->json(['message' => 'Drone not found'], 201);
    }

    public function droneByID($id)
    {
        $drone = Drone::find($id);
        if ($drone) {
            return response()->json(['message' => 'Drone has been find.', 'data' => $drone], 200);
        }
    }

    public function runModel($codeName)
    {
        $drone = Drone::where('codeName', $codeName)->first();

        if (!$drone) {
            return response()->json(['message' => 'Drone not found'], 404);
        }

        $drone->update(['mode' => 'running mode']);

        return response()->json(['message' => 'Drone mode updated successfully','data'=>$drone], 200);
    }
    public function update(Request $request, $id){
        $validator = Validator::make($request->all(), [
            'codeName' =>'required',
            'type' =>'required',
            'mode' =>'required',
            'strength' =>'required',
            'battery' =>'required',
            'location_id' =>'required',
            'user_id' =>'required',

        ]);
        if ($validator->fails()) {
            return $validator->errors();
        }
        $drone = Drone::find($id);
        return $drone;
        if ($drone->isEmpty()) {
            return response()->json(['message'=>"Drone not found"]);
        }
        $drone->update([
            'codeName' => $request->codeName,
            'type' => $request->type,
            'mode' => $request->mode,
            'strength' => $request->strength,
            'battery' => $request->battery,
            'location_id' => $request->location_id,
            'user_id' => $request->user_id,
        ]);
        return response()->json(['message'=>"Drone updated",'data'=>$drone],201);
    }
}
