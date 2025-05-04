<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model {
    protected $fillable = [
        'code', 
        'department_id', 
        'first_name', 
        'last_name', 
        'email', 
        'phone', 
        'max_weekly_hours', 
        'specialization'
    ];

    public function department() {
        return $this->belongsTo(Department::class);
    }

    // public function scheduleEvents() {
    //     return $this->hasMany(ScheduleEvent::class);
    // }
}
