<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Faculty;

class ProgramFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'program_th' => $this->faker->word,
            'program_en' => $this->faker->word,
            'grad_year' => $this->faker->year,
            'prg_fac_id' => Faculty::factory(),
            //เมื่อสร้างข้อมูล Program ข้อมูล Faculty ใหม่จะถูกสร้างขึ้นและ prg_fac_id จะได้รับค่า id ของ Faculty ที่สร้างขึ้นใหม่
            //เพื่อสร้างความสัมพันธ์ระหว่าง Program และ Faculty โดยที่ Program แต่ละ Program จะต้องสังกัด Faculty หนึ่ง ๆ
        ];
    }
}
