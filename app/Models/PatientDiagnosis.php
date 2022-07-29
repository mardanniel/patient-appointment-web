<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientDiagnosis extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';

    protected $fillable = [
        'patient_id',
        'doctor_id',
        'pa_id',
        'diagnosis',
        'temp',
        'bp',
        'weight',
        'height',
        'pulse_rate'
    ];

    protected $guarded = [
        'id',
    ];

    public function patient(){
        return $this->belongsTo(Patient::class);
    }

    public function appointment(){
        return $this->belongsTo(PatientAppointment::class);
    }

    public function doctor(){
        return $this->belongsTo(Doctor::class);
    }
}
