<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentGroup extends Model {
    protected $fillable = [
        'specialty_id',
        'level_id',
        'code', 
        'name', 
        'students_count'
    ];

    public function specialty() {
        return $this->belongsTo(Specialty::class);
    }

    public function level() {
        return $this->belongsTo(Level::class);
    }

}
