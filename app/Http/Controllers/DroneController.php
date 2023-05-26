<?php

namespace App\Http\Controllers;

use App\Models\Drone;
use App\Models\Location;
use Illuminate\Http\Request;

class DroneController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $drones = Drone::all();
        return response()->json(['message'=> 'List of drone', 'success'=>true,'data'=>$drones],201);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $drone = Drone::create([
            'codeName' => $request->codeName,
            'type' => $request->type,
            'strength' => $request->strength,
            'battery' => $request->battery,
            'location_id' => $request->location_id,
            'user_id' => $request->user_id,
        ]);

        return response()->json(['message' =>'You created a new drone.', 'data' =>$drone],201);
    }

    public function getDroneBy($codeName){
        $drone = Drone::where('codename', $codeName)->first();
        if($drone){
            return response()->json(['message' =>'This is drone','success'=> true, 'data' =>$drone],201);
        }
        return response()->json(['message' =>'Drone not found','success'=> false, 'data' =>$drone],201);
    }
    public function showDroneLocation($codeName, $location){
        $drone = Drone::where('codename', $codeName)->first();
        if($drone){
            $location = Location::find($drone->location_id);
            return response()->json(['message' =>'This is drone location','success'=> true, 'data' => $location],201);
        }
        return response()->json(['message' =>'Drone not found','success'=> false, 'data' =>$drone],201);
    }
}
