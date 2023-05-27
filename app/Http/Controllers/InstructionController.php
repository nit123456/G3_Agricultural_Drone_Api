<?php

namespace App\Http\Controllers;

use App\Models\Instruction;
use App\Models\Plan;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class InstructionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $instructions= Instruction::all();
        if($instructions->isNotEmpty()){
            return response()->json(['message'=>'There are all instructions.', 'data'=>$instructions],200);
        }
        return response()->json(['message'=>'There are no instruction.']);
    }

    public function store(Request $request)
    {
        //
        $validator = Validator::make($request->all(), [
            "codeName" => 'required',
            "description" =>'required',
            "plan_id" => 'required',

        ]);
        if ($validator->fails()) {
            return $validator->errors();
        }
        $instruction= Instruction::create([
            'codeName'=>$request->codeName,
            'description'=>$request->description,
            'plan_id'=>$request->plan_id,
            'drone_id'=>$request->drone_id,
        ]);
        return response()->json(['message'=>'Instruction has been created.', 'data'=>$instruction],200);
    }
    public function getPlanByCodename($codeName){
        $plan = Instruction::where('codeName',$codeName)->get();
        if (!$plan){
            return response()->json(['message'=>'Plan does not exist'],404);
        }
        return response()->json(['message'=>'This plan the plan', 'data'=>$plan],200);
    }

}
