<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Level extends Model {
    protected $fillable = [
        'name', 
        'name_ar',
        'code', 
    ];

    public function specialties() {
        return $this->hasMany(Specialty::class);
    }
}
