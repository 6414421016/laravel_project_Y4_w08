<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Student;
use App\Models\Vaccine;

class VaccineRecordFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'std_id' => Student::factory(),
            //เมื่อสร้างข้อมูล VaccineRecord ข้อมูล Student ใหม่จะถูกสร้างขึ้นและ std_id จะได้รับค่า id ของ Student ที่สร้างขึ้นใหม่
            //เมื่อสร้างข้อมูล VaccineRecord ข้อมูล Student ใหม่จะถูกสร้างขึ้นและ std_id จะได้รับค่า id ของ Student ที่สร้างขึ้นใหม่

            'vac_id' => Vaccine::factory(),
            //เมื่อสร้างข้อมูล VaccineRecord ข้อมูล Vaccine ใหม่จะถูกสร้างขึ้นและ vac_id จะได้รับค่า id ของ Vaccine ที่สร้างขึ้นใหม่
            //เพื่อสร้างความสัมพันธ์ระหว่าง VaccineRecord และ Vaccine โดยที่ประวัติการฉีดวัคซีนแต่ละรายการจะต้องเป็นของวัคซีนหนึ่งชนิด
            
            'vaccined_date' => $this->faker->date,
        ];
    }
}
