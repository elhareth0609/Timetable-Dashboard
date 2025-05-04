<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model {
    protected $fillable = [
        'specialty_id', 
        'level_id', 
        'code', 
        'name', 
        'type', 
        'weekly_hours', 
        'coefficient', 
        'Semestre'
    ];

    public function specialty() {
        return $this->belongsTo(Specialty::class);
    }

    public function level() {
        return $this->belongsTo(Level::class);
    }

}
