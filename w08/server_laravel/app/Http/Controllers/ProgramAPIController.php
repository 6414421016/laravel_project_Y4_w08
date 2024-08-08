<?php

namespace App\Http\Controllers;

use App\Models\Program;
use Illuminate\Http\Request;

class ProgramAPIController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $programs = Program::all();
        return response()->json($programs, 201);
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
        $validateData = $request->validate([
            'program_th' => 'required|string|max:255',
            'program_en' => 'required|string|max:255',
            'grad_year' => 'required|string|max:255',
            'prg_fac_id' => 'required',
        ]);
        $program = Program::create($validateData);
        return response()->json($program, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $program = Program::find($id);
        return response()->json($program, 201);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validateData = $request->validate([
            'program_th' => 'required|string|max:255',
            'program_en' => 'required|string|max:255',
            'grad_year' => 'required|string|max:255',
            'prg_fac_id' => 'required',
        ]);
        $program = Program::find($id);
        $program->update($validateData);
        return response()->json($program, 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $program = Program::find($id);

        if (!$program) {
            return response()->json(['error' => 'Resource not found'], 404);
        }
    
        $program->delete();
    
        return response()->json(null, 204);
    }
}
