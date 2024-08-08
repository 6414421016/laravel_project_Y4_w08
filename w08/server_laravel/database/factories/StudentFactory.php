<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Program;

class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'sid' => $this->faker->unique()->numerify('SID####'),
            'fname' => $this->faker->firstName,
            'lname' => $this->faker->lastName,
            'std_prg_id' => Program::factory(),
            //เมื่อสร้างข้อมูล Student ข้อมูล Program ใหม่จะถูกสร้างขึ้นและ std_prg_id จะได้รับค่า id ของ Program ที่สร้างขึ้นใหม่
            //เพื่อสร้างความสัมพันธ์ระหว่าง Student และ Program โดยที่ Student แต่ละคนจะต้องลงทะเบียนใน Program การศึกษาใด Program การศึกษาหนึ่ง
        ];
    }
}
