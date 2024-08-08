<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faculty extends Model
{
    use HasFactory;

    protected $fillable = [
        'faculty_th',
        'faculty_en',
    ];

    public function programs()
    {
        return $this->hasMany(Program::class, 'prg_fac_id');
    }
    //ความสัมพันธ์: Faculty หนึ่งมี Program หลายตัว (One-to-Many)
    //เหตุผล: ในระบบการศึกษานั้น หนึ่งคณะ (Faculty) สามารถมีหลายหลักสูตร (Program) ที่สังกัดอยู่
}
