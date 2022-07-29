<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Doctor extends Authenticatable
{
    use HasFactory;

    protected $primaryKey = 'id';

    protected $guard = 'doctor';

    protected $fillable = [
        'fname',
        'mname',
        'lname',
        'email',
        'password',
        'gender',
        'dob',
        'contact_num',
        'street',
        'barangay',
        'city',
        'degree',
        'expertise'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function getFullname(){
        return $this->fname.' '.($this->mname ?? '').' '.$this->lname;
    }

    public function getFullAddress(){
        return $this->street.' '.$this->barangay.' '.$this->city;
    }

    public function appointment(){
        return $this->hasMany(PatientAppointment::class);
    }

    public function schedule(){
        return $this->hasMany(DoctorSchedule::class);
    }

    public function patientDiagnosis(){
        return $this->hasMany(PatientDiagnosis::class);
    }
}
