<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use HasFactory;

    protected $guard = 'admin';

    protected $primaryKey = 'id';

    protected $fillable = [
        'fname',
        'mname',
        'lname',
        'email',
        'password'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function getFullname(){
        return $this->fname.' '.($this->mname ?? '').' '.$this->lname;
    }
}
