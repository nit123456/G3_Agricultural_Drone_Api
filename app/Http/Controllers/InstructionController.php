<?php

namespace App\Http\Controllers;

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

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $instruction= Instruction::create([
            'condName'=>$request->codeName,
            'description'=>$request->description,
            'plan_id'=>$request->plan_id,
            'drone_id'=>$request->drone_id,
        ]);
        return response()->json(['message'=>'Instruction has been created.', 'data'=>$instruction],200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Instruction $instruction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Instruction $instruction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $instruction)
    {
       
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Instruction $instruction)
    {
        //
    }
}
