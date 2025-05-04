<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Faculty extends Model {
    protected $fillable = ['code', 'name', 'name_ar', 'description'];

    public function departments() {
        return $this->hasMany(Department::class);
    }

}
