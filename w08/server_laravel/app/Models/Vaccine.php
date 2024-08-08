<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vaccine extends Model
{
    use HasFactory;

    protected $fillable = [
        'vaccine'
    ];

    public function vaccineRecords()
    {
        return $this->hasMany(VaccineRecord::class, 'vac_id');
    }
    //ความสัมพันธ์: Vaccine หนึ่งมี VaccineRecord หลายตัว (One-to-Many)
    //เหตุผล: วัคซีนแต่ละชนิดสามารถมีประวัติการฉีดวัคซีนหลายรายการ
}
