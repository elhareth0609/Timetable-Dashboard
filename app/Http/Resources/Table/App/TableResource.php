<?php

namespace App\Http\Resources\Table\App;

use Illuminate\Http\Resources\Json\JsonResource;

class TableResource extends JsonResource {
    public function toArray($request) {
        return [
            'id' => $this->id,
            'teacher_id' => $this->teacher_id,
            'course_id' => $this->course_id,
            'group_id' => $this->group_id,
            'speacilty_id' => $this->speacilty_id,
            'structure_id' => $this->structure_id,
            'day' => $this->day,
            'slot' => $this->slot,
            'sessions' => $this->sessions,
            'color' => $this->color
        ];
    }
}
