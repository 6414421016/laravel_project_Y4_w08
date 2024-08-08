<?php

namespace App\Http\Controllers;

use App\Models\VaccineRecord;
use Illuminate\Http\Request;

class VaccineRecordAPIController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $vcRecord = VaccineRecord::all();
        return response()->json($vcRecord, 201);
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
            'sid_id' => 'required',
            'vac_id' => 'required',
            'vaccined_date' => 'required',
        ]);
        $vcRecord = VaccineRecord::create($validateData);
        return response()->json($vcRecord, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $vcRecord = VaccineRecord::find($id);
        return response()->json($vcRecord, 201);
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
            'sid_id' => 'required',
            'vac_id' => 'required',
            'vaccined_date' => 'required',
        ]);
        $vcRecord = VaccineRecord::find($id);
        $vcRecord->update($validateData);
        return response()->json($vcRecord, 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $vcRecord = VaccineRecord::find($id);
        if(!$vcRecord) {
            return response()->json(["Error" => "Resource not found"], 404);
        }
        $vcRecord->delete();
        return response()->json(null, 204);
    }
}
