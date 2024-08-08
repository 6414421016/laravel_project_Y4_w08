<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Student;
use App\Models\Program;
use App\Models;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Program::all()->each(function ($program) {
            Student::factory()->count(10)->create(['std_prg_id' => $program->id]);
        });
    }
    //หน้าที่: สร้างข้อมูลนักศึกษา (student) สำหรับแต่ละโปรแกรมการศึกษา
    //การทำงาน: ดึงข้อมูลโปรแกรมการศึกษาทั้งหมด (Program::all()) และสำหรับแต่ละโปรแกรมการศึกษา 
    //จะสร้างข้อมูลนักศึกษา 10 รายการ โดยใช้ Student factory และกำหนดค่า std_prg_id ให้ตรงกับ id ของโปรแกรมการศึกษานั้น
}
