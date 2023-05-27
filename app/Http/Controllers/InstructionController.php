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
            "codename" => 'required',
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

    /**
     * Update the specified resource in storage.
     */
    public function update($id)
    {
        $instruction = Instruction::find($id);
        $instruction->codeName= request('codeName');
        $instruction->description= request('description');
        $instruction->plan_id= request('plan_id');
        $instruction->drone_id= request('drone_id');
        $instruction->save();
        return response()->json(['message'=>'Instruction has been updated.'],200);
}
    /**
     * Remove the specified resource from storage.
     */
}
