<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use App\Models\Instruction;
use App\Models\Plan;
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
            "codename" => 'required',
            "description" =>'required',
            "plan_id" => 'required',

        ]);
        if ($validator->fails()) {
            return $validator->errors();
        }
        $instruction= Instruction::create([
            'condName'=>$request->codeName,
            'description'=>$request->description,
            'plan_id'=>$request->plan_id,
            'drone_id'=>$request->drone_id,
        ]);
        return response()->json(['message'=>'Instruction has been created.', 'data'=>$instruction],200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $instruction)
    {
        $validator = Validator::make($request->all(), [
            "codename" => 'required',
            "description" =>'required',
            "plan_id" => 'required',

        ]);
        if ($validator->fails()) {
            return $validator->errors();
        }
        $data = Instruction::find($instruction);
        $data->update([
            'condName'=>$request->codeName,
            'description'=>$request->description,
            'plan_id'=>$request->plan_id,
            'drone_id'=>$request->drone_id,
        ]);
        return response()->json(['message'=>'Instruction has been created.', 'data'=> $data],200);
       
    }

    public function getPlanBy($codeName)
    {
        //
        $instructions= Instruction::where('codeName', $codeName)->first();
        return response()->json(['message'=>'There are all instructions.', 'data'=>$instructions],200);
    }
}
