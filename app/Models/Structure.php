<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Structure extends Model {
    protected $fillable = [
        'code', 
        'name', 
        'type', 
        'capacity', 
        'building', 
        'location', 
        'has_projector', 
        'has_computers'
    ];
}
