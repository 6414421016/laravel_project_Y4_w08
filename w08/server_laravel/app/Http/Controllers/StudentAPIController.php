<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentAPIController extends Controller
{

    public function index()
    {
        // ดึงข้อมูลของนักเรียนทั้งหมด พร้อมทั้งข้อมูลของโปรแกรมและคณะที่เกี่ยวข้อง
        $students = DB::table('students')
            // เชื่อมตาราง 'students' กับตาราง 'programs' โดยใช้คีย์ต่างประเทศ 'std_prg_id'
            ->join('programs', 'students.std_prg_id', '=', 'programs.id')
            // เชื่อมตาราง 'programs' กับตาราง 'faculties' โดยใช้คีย์ต่างประเทศ 'prg_fac_id'
            ->join('faculties', 'programs.prg_fac_id', '=', 'faculties.id')
            // เลือกทุกคอลัมน์จากตาราง 'students' และคอลัมน์ 'program_th' จากตาราง 'programs'
            // และคอลัมน์ 'faculty_th' จากตาราง 'faculties'
            ->select('students.*', 'programs.program_th', 'faculties.faculty_th')
            // ดึงข้อมูลที่เลือกไว้ทั้งหมด
            ->get();
        // ส่งข้อมูลของนักเรียนกลับไปในรูปแบบ JSON
        return $students;
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        try {
            // ตรวจสอบความถูกต้องของข้อมูล
            $validatedData = $request->validate([
                'sid' => 'required|string|max:255',
                'fname' => 'required|string|max:255',
                'lname' => 'required|string|max:255',
                'std_prg_id' => 'required|exists:programs,id',
            ]);

            // สร้างข้อมูลนักเรียนใหม่
            $student = Student::create($validatedData);

            // ส่งกลับข้อมูลนักเรียนที่สร้างใหม่พร้อมกับสถานะ 201 (Created)
            return response()->json($student, 201);
        } catch (\Exception $e) {
            // ส่งกลับข้อผิดพลาดพร้อมกับสถานะ 500 (Internal Server Error)
            return response()->json(['error' => $e->getMessage()], 500);
        }
        // return Student::create($request->all());
    }


    public function show(string $id)
    {
        // ดึงข้อมูลของนักเรียนที่มี ID ตรงกับที่ระบุ พร้อมทั้งข้อมูลของโปรแกรมและคณะที่เกี่ยวข้อง
        $student = DB::table('students')
            // เชื่อมตาราง 'students' กับตาราง 'programs' โดยใช้คีย์ต่างประเทศ 'std_prg_id'
            ->join('programs', 'students.std_prg_id', '=', 'programs.id')
            // เชื่อมตาราง 'programs' กับตาราง 'faculties' โดยใช้คีย์ต่างประเทศ 'prg_fac_id'
            ->join('faculties', 'programs.prg_fac_id', '=', 'faculties.id')
            // เลือกทุกคอลัมน์จากตาราง 'students' และคอลัมน์ 'program_th' จากตาราง 'programs'
            // และคอลัมน์ 'faculty_th' จากตาราง 'faculties'
            ->select('students.*', 'programs.program_th', 'faculties.faculty_th')
            // กำหนดเงื่อนไขในการดึงข้อมูล โดยเลือกข้อมูลของนักเรียนที่มี ID ตรงกับที่ระบุ
            ->where('students.id', '=', $id)
            // ดึงข้อมูลที่เลือกไว้
            ->get();
        // ส่งข้อมูลของนักเรียนกลับไปในรูปแบบ JSON
        return $student;
    }


    public function edit(string $id)
    {
        //
    }


    public function update(Request $request, string $id)
    {
        $student = Student::find($id);
        $student->update($request->all());
        return $student;
    }

    public function destroy(string $id)
    {
        return Student::destroy($id);
    }

    public function search($name)
    {
        return Student::where('name', 'like', '%' . $name . '%')->get();
    }
}
