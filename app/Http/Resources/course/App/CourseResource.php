<?php

namespace App\Http\Resources\Course\App;

use Illuminate\Http\Resources\Json\JsonResource;

class CourseResource extends JsonResource {
    public function toArray($request) {
        return [
            'id' => $this->id,
            'name' => $this->name
        ];
    }
}
