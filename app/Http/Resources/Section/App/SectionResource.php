<?php

namespace App\Http\Resources\Section\App;

use Illuminate\Http\Resources\Json\JsonResource;

class SectionResource extends JsonResource {
    public function toArray($request) {
        return [
            'id' => $this->id,
            'name' => $this->name,
        ];
    }
}
