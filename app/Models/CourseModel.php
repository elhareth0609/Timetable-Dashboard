<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourseModel extends Model {
    protected $fillable = ['name'];

    public function scheduleEvents() {
        return $this->hasMany(ScheduleEvent::class);
    }
}
