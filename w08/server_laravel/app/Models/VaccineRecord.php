<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VaccineRecord extends Model
{
    use HasFactory;

    protected $fillable = [
        'std_id',
        'vac_id',
        'vaccined_date',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class, 'std_id');
    }
    //ความสัมพันธ์: VaccineRecord หนึ่งสังกัดอยู่ใน Student หนึ่ง (Many-to-One)
    //เหตุผล: ประวัติการฉีดวัคซีนหนึ่งรายการต้องเป็นของนักศึกษาหนึ่งคน

    public function vaccine()
    {
        return $this->belongsTo(Vaccine::class, 'vac_id');
    }
    //ความสัมพันธ์: VaccineRecord หนึ่งสังกัดอยู่ใน Vaccine หนึ่ง (Many-to-One)
    //เหตุผล: ประวัติการฉีดวัคซีนหนึ่งรายการต้องเป็นของวัคซีนหนึ่งชนิด
}
