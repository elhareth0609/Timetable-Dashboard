<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ScheduleEvent extends Model {

    protected $fillable = [
        'teacher_id',
        'course_id',
        'group_id',
        'speacilty_id',
        'structure_id',
        'day',
        'slot',
        'sessions',
        'color'
    ];

    public function teacher() {
        return $this->belongsTo(Teacher::class);
    }

    public function group() {
        return $this->belongsTo(StudentGroup::class);
    }

    public function specialty() {
        return $this->belongsTo(Specialty::class, 'speacilty_id');
    }

    public function course() {
        return $this->belongsTo(Course::class);
    }

    public function structure() {
        return $this->belongsTo(Structure::class);
    }

}
