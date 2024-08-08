<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Program;
use App\Models\Faculty;
use App\Models;

class ProgramSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Faculty::all()->each(function ($faculty) {
            Program::factory()->count(10)->create(['prg_fac_id' => $faculty->id]);
        });
    }
    //หน้าที่: สร้างข้อมูลโปรแกรมการศึกษา (program) สำหรับแต่ละคณะ
    //การทำงาน: ดึงข้อมูลคณะทั้งหมด (Faculty::all()) และสำหรับแต่ละคณะ จะสร้างข้อมูลโปรแกรมการศึกษา 10 รายการ 
    //โดยใช้ Program factory และกำหนดค่า prg_fac_id ให้ตรงกับ id ของคณะนั้น
}
