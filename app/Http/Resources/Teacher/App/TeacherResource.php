<?php

namespace App\Http\Resources\Teacher\App;

use Illuminate\Http\Resources\Json\JsonResource;

class TeacherResource extends JsonResource {
    public function toArray($request) {
        return [
            'id' => $this->id,
            'code' => $this->code,
            'department_id' => $this->department_id,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'phone' => $this->phone,
            'max_weekly_hours' => $this->max_weekly_hours,
            'specialization' => $this->specialization,
        ];
    }
}
