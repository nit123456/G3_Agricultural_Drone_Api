<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PlanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $plans= Plan::all();
        if ($plans->isNotEmpty()){
            return response()->json(['message'=>'There are all plans', 'data'=>$plans],200);
        }
        return response()->json(['message'=>'There is no plan.']);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'=>'required',
            'type'=>'required',
            'map_id'=>'required',
            'user_id'=>'required',

        ]);
        if ($validator->fails()) {
            return $validator->errors();
        }
        $plan= Plan::create([
            'name'=>$request->name,
            'type'=>$request->type,
            'map_id'=>$request->map_id,
            'user_id'=>$request->user_id,
        ]);
        return response()->json(['message'=>'Plan is created.', 'data'=>$plan],200);
    }

    
    public function update(Request $request, $id)
    {
        //
        $validator = Validator::make($request->all(), [
            'name'=>'required',
            'type'=>'required',
            'map_id'=>'required',
            'user_id'=>'required',

        ]);
        if ($validator->fails()) {
            return $validator->errors();
        }
        $plan = Plan::find($id);
        if (!$plan) {
            return response()->json(['message'=>'Plan does not exist'],201);
        }
        $plan->update([
            'name'=>$request->name,
            'type'=>$request->type,
            'map_id'=>$request->map_id,
            'user_id'=>$request->user_id,
        ]);
        return response()->json(['message'=>'Plan is updated.', 'data'=>$plan],200);
    }

    public function destroy($id)
    {
        //
        $plan = Plan::find($id);
        if (!$plan) {
            return response()->json(['message'=>'Plan does not exist'],201);
        }
        $plan->destroy($id);
        return response()->json(['message'=>'Plan is updated.', 'data'=>$plan],200);
    }
}
