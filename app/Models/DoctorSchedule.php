<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DoctorSchedule extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';

    protected $fillable = [
        'sched_day',
        'sched_time_start',
        'sched_time_end'
    ];

    public function doctor(){
        return $this->belongsTo(Doctor::class, 'doctor_id', 'id');
    }
}
