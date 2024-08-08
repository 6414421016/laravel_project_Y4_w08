<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    use HasFactory;

    protected $table = 'programs';

    protected $fillable = [
        'program_th',
        'program_en',
        'grad_year',
        'prg_fac_id',
    ];

    public function faculty()
    {
        return $this->belongsTo(Faculty::class, 'prg_fac_id');
    }
    //ความสัมพันธ์: Program หนึ่งสังกัดอยู่ใน Faculty หนึ่ง (Many-to-One)
    //เหตุผล: หลักสูตรหนึ่ง ๆ ต้องสังกัดอยู่ในคณะหนึ่ง

    public function students()
    {
        return $this->hasMany(Student::class, 'std_prg_id');
    }
    //ความสัมพันธ์: Program หนึ่งมี Student หลายคน (One-to-Many)
    //เหตุผล: หลักสูตรหนึ่ง ๆ สามารถมีนักศึกษาหลายคนลงทะเบียนเรียนได้
}
