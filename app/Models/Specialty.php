<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Specialty extends Model {
    protected $fillable = [
        'level_id', 
        'department_id', 
        'name', 
        'name_ar',
        'code', 
    ];

    public function department() {
        return $this->belongsTo(Department::class);
    }

    public function studentGroups() {
        return $this->hasMany(StudentGroup::class);
    }

    public function level() {
        return $this->belongsTo(Level::class);
    }

}
