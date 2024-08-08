<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'sid',
        'fname',
        'lname',
        'std_prg_id',
    ];
    protected $table="students";

    public function program()
    {
        return $this->belongsTo(Program::class, 'std_prg_id', 'id');
    }
    //ความสัมพันธ์: Student หนึ่งลงทะเบียนใน Program หนึ่ง (Many-to-One) 
    //เหตุผล: นักศึกษาหนึ่งคนต้องลงทะเบียนเรียนในหลักสูตรหนึ่ง

    public function vaccineRecords()
    {
        return $this->hasMany(VaccineRecord::class, 'std_id', 'id');
    }
    //ความสัมพันธ์: Student หนึ่งมี VaccineRecord หลายตัว (One-to-Many)
    //เหตุผล: นักศึกษาหนึ่งคนสามารถมีประวัติการฉีดวัคซีนหลายครั้ง
}
