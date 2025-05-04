<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TeachingRelief extends Model {
    protected $fillable = [
        'name', 
        'name_ar', 
        'hours_reduction', 
        'notes'
    ];
}
