<?php

namespace App\Http\Controllers;

use App\Models\Vaccine;
use Illuminate\Http\Request;

class VaccineAPIController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $vaccines = Vaccine::all();
        return response()->json($vaccines, 201);
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
            'vaccine' => 'required|string|max:255'
        ]);
        $vaccine = Vaccine::create($validateData);
        return response()->json($vaccine, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $vaccine = Vaccine::find($id);
        return response()->json($vaccine, 201);
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
            'vaccine' => 'required|string|max:255'
        ]);
        $vaccine = Vaccine::find($id);
        $vaccine->update($validateData);
        return response()->json($vaccine, 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $vaccine = Vaccine::find($id);
        if(!$vaccine) {
            return response()->json(["Error" => "Resource not found"], 404);
        }
        $vaccine->delete();
        return response()->json(null, 204);
    }
}
