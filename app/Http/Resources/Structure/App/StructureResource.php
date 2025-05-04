<?php

namespace App\Http\Resources\Structure\App;

use Illuminate\Http\Resources\Json\JsonResource;

class StructureResource extends JsonResource {
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
