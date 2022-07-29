<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Patient extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $table = 'patients';

    protected $primaryKey = 'id';

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
        'profile_image',
        'is_active',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $guarded = [
        'id'
    ];

    public function patientDiagnosis(){
        return $this->hasMany(PatientDiagnosis::class, 'patient_id', 'id');
    }

    public function appointments(){
        return $this->hasMany(PatientAppointment::class);
    }

    public function getFullname(){
        return $this->fname ." ". ($this->mname ?? "") ." ". $this->lname;
    }

    public function getFullAddress(){
        return $this->street ." ". $this->barangay ." ". $this->city;
    }
}
