<?php

namespace App\Http\Resources\Faculty\App;

use Illuminate\Http\Resources\Json\JsonResource;

class FacultyResource extends JsonResource {
    public function toArray($request) {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'name_ar' => $this->name_ar,
            'description' => $this->description,
            'code' => $this->code,
        ];
    }
}
