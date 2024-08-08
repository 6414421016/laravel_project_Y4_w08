<?php

namespace App\Http\Controllers;

use App\Models\Faculty;
use App\Models\Program;
use App\Models\Student;
use App\Models\Vaccine;
use App\Models\VaccineRecord;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // import DB class

class DataAdminController extends Controller
{
    // section GetData

    public function fetchData()
    {
        $facultyData = DB::table('faculties')->get();
        return view('pages.faculty', compact('facultyData'));
    }


    public function fetchProgram()
    {
        $programData = DB::table('programs')->get();
        return view('pages.program', compact('programData'));
    }


    public function fetchStudent()
    {
        $studentData = DB::table('students')->get();
        return view('pages.student', compact('studentData'));
    }


    public function fetchVaccine()
    {
        $vaccineData = DB::table('vaccines')->get();
        return view('pages.vaccine', compact('vaccineData'));
    }


    public function fetchVaccineRecord()
    {
        $vaccineRecordData = DB::table('vaccine_records')->get();
        return view('pages.vaccinerecord', compact('vaccineRecordData'));
    }


    public function fetchProgramId()
    {
        $uniqueFacultyIds = Program::distinct()->pluck('prg_fac_id');
        return view('forms.programForm', compact('uniqueFacultyIds'));
    }


    public function fetchStudentId()
    {
        $uniqueStudentIds = Student::distinct()->pluck('std_prg_id');
        return view('forms.studentForm', compact('uniqueStudentIds'));
    }


    public function fetchVaccineRecordId()
    {
        $uniqueVaccineIdsSTD = VaccineRecord::distinct()->pluck('std_id');
        $uniqueVaccineIdsVAC = VaccineRecord::distinct()->pluck('vac_id');
        return view('forms.vaccinerecordForm', compact('uniqueVaccineIdsSTD', 'uniqueVaccineIdsVAC'));
    }


    public function chartvaccine()
{
    // เริ่มต้นการ query จากตาราง vaccine_records
    $vaccineCounts = DB::table('vaccine_records')
        // เลือกคอลัมน์ที่ต้องการจากตาราง vaccine_records โดยใช้ raw SQL
        // เพื่อคำนวณจำนวนวัคซีน (count(*) as vaccine_count) และชื่อเดือน (monthname(vaccine_date) as monthen)
        ->select(
            DB::raw('count(*) as vaccine_count'),
            DB::raw('monthname(vaccined_date) as monthen')
        )
        // เข้าร่วมตาราง vaccines กับ vaccine_records โดยใช้คอลัมน์ vac_id ใน vaccine_records ให้ตรงกับ id ในตาราง vaccines
        ->join('vaccines', 'vaccine_records.vac_id', '=', 'vaccines.id')
        // กรองข้อมูลให้เลือกเฉพาะข้อมูลที่ปีในคอลัมน์ vaccine_date เป็นปี 2023
        ->whereYear('vaccined_date', 2023)
        // กลุ่มข้อมูลโดยใช้ชื่อเดือนจากคอลัมน์ vaccine_date
        ->groupBy(DB::raw('monthname(vaccined_date)'))
        // เรียงลำดับข้อมูลตามเดือนในคอลัมน์ vaccine_date
        ->orderBy(DB::raw('month(vaccined_date)'))
        // ดึงข้อมูลจาก query ที่สร้างขึ้นในรูปแบบ key-value (monthname => vaccine_count)
        ->pluck('vaccine_count', 'monthen');

    // นำ key (ชื่อเดือน) มาจัดเก็บในตัวแปร labels
    $labels = $vaccineCounts->keys();
    // นำ value (จำนวนวัคซีน) มาจัดเก็บในตัวแปร data
    $data = $vaccineCounts->values();
    
    // ส่งข้อมูล labels และ data ไปยัง view pages.chartvaccine
    return view('pages.chartvaccine', compact('labels', 'data'));
}



    // Section Add Data

    public function addFaculty(Request $request)
    {
        $request->validate([
            'faculty_th',
            'faculty_en',
        ]);

        $data = [
            'faculty_th' => $request->faculty_th,
            'faculty_en' => $request->faculty_en,
        ];

        DB::table('faculties')->insert($data);
        return redirect()->route('faculty');
    }

    public function addProgram(Request $request)
    {
        $request->validate([
            'program_th',
            'program_en',
            'grad_year',
            'prg_fac_id',
        ]);

        $data = [
            'program_th' => $request->program_th,
            'program_en' => $request->program_en,
            'grad_year' => $request->grad_year,
            'prg_fac_id' => $request->prg_fac_id,
        ];

        DB::table('programs')->insert($data);
        return redirect()->route('program');
    }

    public function addStudent(Request $request)
    {
        $request->validate([
            'sid',
            'fname',
            'lname',
            'std_prg_id',
        ]);

        $data = [
            'sid' => $request->sid,
            'fname' => $request->fname,
            'lname' => $request->lname,
            'std_prg_id' => $request->std_prg_id
        ];

        DB::table('students')->insert($data);
        return redirect()->route('student');
    }

    public function addVaccine(Request $request)
    {
        $request->validate([
            'vaccine'
        ]);

        $data = [
            'vaccine' => $request->vaccine
        ];

        DB::table('vaccines')->insert($data);
        return redirect()->route('vaccine');
    }

    public function vaccinerecordAddData(Request $request)
    {
        $request->validate([
            'std_id',
            'vac_id',
            'vaccined_date',
        ]);

        $data = [
            'std_id' => $request->std_id,
            'vac_id' => $request->vac_id,
            'vaccined_date' => $request->vaccined_date
        ];

        DB::table('vaccine_records')->insert($data);
        return redirect()->route('vaccinerecord');
    }


    // Section Edit and Update for Data

    public function editFaculty($id)
    {
        $dataFacultyId = Faculty::find($id);
        return view('edits.facultyEdit', compact('dataFacultyId'));
    }
    public function facultyUpdateData(Request $request, $id)
    {
        $facultyId = Faculty::find($id);

        $request->validate([
            'faculty_th',
            'faculty_en',
        ]);

        $data = [
            'faculty_th' => $request->faculty_th,
            'faculty_en' => $request->faculty_en,
        ];

        $facultyId->update($data);
        return redirect()->route('faculty');
    }

    public function editProgram($id)
    {
        $dataProgramId = Program::find($id);
        return view('edits.programEdit', compact('dataProgramId'));
    }
    public function programUpdateDate(Request $request, $id)
    {
        $programId = Program::find($id);

        $request->validate([
            'program_th',
            'program_en',
            'grad_year',
            'prg_fac_id',
        ]);

        $data = [
            'program_th' => $request->program_th,
            'program_en' => $request->program_en,
            'grad_year' => $request->grad_year,
            'prg_fac_id' => $request->prg_fac_id,
        ];

        $programId->update($data);
        return redirect()->route('program');
    }

    public function editStudent($id)
    {
        $dataStudentId = Student::find($id);
        return view('edits.studentEdit', compact('dataStudentId'));
    }
    public function studentUpdateData(Request $request, $id)
    {
        $studentId = Student::find($id);

        $request->validate([
            'sid',
            'fname',
            'lname',
            'std_prg_id',
        ]);

        $data = [
            'sid' => $request->sid,
            'fname' => $request->fname,
            'lname' => $request->lname,
            'std_prg_id' => $request->std_prg_id
        ];

        $studentId->update($data);
        return redirect()->route('student');
    }

    public function editVaccine($id)
    {
        $dataVaccineId = Vaccine::find($id);
        return view('edits.vaccineEdit', compact('dataVaccineId'));
    }
    public function vaccineUpdateData(Request $request, $id)
    {
        $vaccineId = Vaccine::find($id);

        $request->validate([
            'vaccine'
        ]);

        $data = [
            'vaccine' => $request->vaccine
        ];

        $vaccineId->update($data);
        return redirect()->route('vaccine');
    }

    public function editVaccineRecord($id)
    {
        $dataVaccineRecordId = VaccineRecord::find($id);
        return view('edits.vaccinerecordEdit', compact('dataVaccineRecordId'));
    }
    public function vaccinerecordUpdateData(Request $request, $id)
    {
        $vaccinerecordId = VaccineRecord::find($id);

        $request->validate([
            'vaccined_date'
        ]);

        $data = [
            'vaccined_date' => $request->vaccined_date
        ];

        $vaccinerecordId->update($data);
        return redirect()->route('vaccinerecord');
    }


    // Section Delete data

    public function deleteFaculty($id)
    {
        Faculty::find($id)->delete();
        return redirect()->route('faculty');
    }

    public function deleteProgram($id)
    {
        Program::find($id)->delete();
        return redirect()->route('program');
    }

    public function deleteStudent($id)
    {
        Student::find($id)->delete();
        return redirect()->route('student');
    }

    public function deleteVaccine($id)
    {
        Vaccine::find($id)->delete();
        return redirect()->route('vaccine');
    }

    public function deleteVaccineRecord($id)
    {
        VaccineRecord::find($id)->delete();
        return redirect()->route('vaccinerecord');
    }
}
