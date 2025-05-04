<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SpecialtyTimeSlot extends Model {
    
    protected $fillable = [
        'specialty_id',
        'timeslot_id',
    ];

    public function specialty() {
        return $this->hasMany(Specialty::class);
    }

    public function timeslot() {
        return $this->hasMany(Timeslot::class);
    }
}
