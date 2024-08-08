<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\VaccineRecord;
use App\Models\Student;
use App\Models\Vaccine;
use App\Models;


class VaccineRecordSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // ดึงข้อมูลนักศึกษาทั้งหมด
        Student::all()->each(function ($student) {
            // สำหรับนักศึกษาแต่ละคน, สุ่มเลือกวัคซีน 3 ชนิดจากวัคซีนทั้งหมด
            Vaccine::all()->random(3)->each(function ($vaccine) use ($student) {
                // สำหรับวัคซีนแต่ละชนิดที่ถูกสุ่มเลือก, สร้างข้อมูลประวัติการฉีดวัคซีน
                //.each(function ($vaccine) use ($student) { ... }) วนลูปผ่านวัคซีนที่ถูกสุ่มเลือกแต่ละชนิด โดยใช้ตัวแปร $vaccine 
                //แทนข้อมูลของวัคซีนที่ถูกสุ่มเลือกในแต่ละลูป และใช้ use ($student) เพื่อให้สามารถเข้าถึงตัวแปร $student ภายในฟังก์ชั่นนี้ได้
                VaccineRecord::factory()->create([
                    'std_id' => $student->id,  // กำหนดค่า std_id ให้ตรงกับ id ของนักศึกษาคนปัจจุบัน
                    'vac_id' => $vaccine->id,  // กำหนดค่า vac_id ให้ตรงกับ id ของวัคซีนที่ถูกสุ่มเลือก
                ]);
            });
        });
    }
    //หน้าที่: สร้างข้อมูลประวัติการฉีดวัคซีน (vaccine record) สำหรับนักศึกษาแต่ละคน
    //การทำงาน: 
    //1. ดึงข้อมูลนักศึกษาทั้งหมด (Student::all())
    //2. สำหรับนักศึกษาแต่ละคน จะสุ่มเลือกวัคซีน 3 ชนิดจากวัคซีนทั้งหมด (Vaccine::all()->random(3))
    //3. สำหรับวัคซีนแต่ละชนิดที่ถูกสุ่มเลือก จะสร้างข้อมูลประวัติการฉีดวัคซีน (VaccineRecord) โดยใช้ VaccineRecord factory 
    //และกำหนดค่า std_id ให้ตรงกับ id ของนักศึกษานั้น และ vac_id ให้ตรงกับ id ของวัคซีนที่ถูกสุ่มเลือก
}
