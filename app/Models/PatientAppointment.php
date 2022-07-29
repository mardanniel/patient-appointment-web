<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientAppointment extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';

    protected $fillable = [
        'sched_at',
        'concern',
        'patient_id',
        'doctor_id'
    ];

    protected $guarded = [
        'id',
        'patient_id',
        'doctor_id',
    ];

    public function patient(){
        return $this->belongsTo(Patient::class);
    }

    public function doctor(){
        return $this->belongsTo(Doctor::class);
    }

    public function diagnosis(){
        return $this->hasOne(PatientDiagnosis::class, 'pa_id', 'id');
    }
}
