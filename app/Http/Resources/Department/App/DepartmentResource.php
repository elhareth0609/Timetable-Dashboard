<?php

namespace App\Http\Resources\Department\App;

use Illuminate\Http\Resources\Json\JsonResource;

class DepartmentResource extends JsonResource {
    public function toArray($request) {
        return [
            'id' => $this->id,
            'faculty_id' => $this->faculty_id,
            'code' => $this->code,
            'name' => $this->name,
            'name_ar' => $this->name_ar,
            'email' => $this->email,
            'description' => $this->description,
        ];
    }
}
