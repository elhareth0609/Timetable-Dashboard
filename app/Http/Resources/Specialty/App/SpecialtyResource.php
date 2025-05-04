<?php

namespace App\Http\Resources\Specialty\App;

use Illuminate\Http\Resources\Json\JsonResource;

class SpecialtyResource extends JsonResource {
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
