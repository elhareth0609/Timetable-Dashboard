<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class Department extends Authenticatable {
    protected $fillable = [
        'faculty_id', 
        'code', 
        'name',
        'name_ar', 
        'email', 
        'Description'
    ];

    protected $hidden = ['password'];

    public function faculty() {
        return $this->belongsTo(Faculty::class);
    }

    public function specialties() {
        return $this->hasMany(Specialty::class);
    }

    public function teachers() {
        return $this->hasMany(Teacher::class);
    }

}
