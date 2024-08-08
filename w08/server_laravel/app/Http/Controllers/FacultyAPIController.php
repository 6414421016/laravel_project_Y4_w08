<?php

namespace App\Http\Controllers;

use App\Models\Faculty;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class FacultyAPIController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $faculties = Faculty::all();
        return response()->json($faculties);
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
            'faculty_th' => 'required|string|max:255',
            'faculty_en' => 'required|string|max:255',
        ]);
        $faculty = Faculty::create($validateData);
        return response()->json($faculty, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $faculty = Faculty::find($id);
        return response()->json($faculty, 201);
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
            'faculty_th' => 'required|string|max:255',
            'faculty_en' => 'required|string|max:255',
        ]);
        $faculty = Faculty::find($id);
        $faculty->update($validateData);
        return response()->json($faculty, 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $faculty = Faculty::find($id);
            if (!$faculty) {
                return response()->json(["Error" => 'Resource not found'], 404);
            }
            $faculty->delete();
            return response()->json(['message' => 'Faculty deleted successfully.'], 200);
        } catch (\Exception $e) {
            // บันทึกข้อผิดพลาดใน log ของ Laravel
            return response()->json(['Error' => 'An error occurred while deleting the faculty.'], 500);
        }
    }
}
