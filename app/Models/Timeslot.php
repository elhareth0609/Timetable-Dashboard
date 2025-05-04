<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Timeslot extends Model {
    protected $fillable = [
        'timeslot_code', 
        'day_name', 
        'day_name_ar', 
        'start_time', 
        'end_time', 
        'duration_minutes', 
        'shift'
    ];
}
