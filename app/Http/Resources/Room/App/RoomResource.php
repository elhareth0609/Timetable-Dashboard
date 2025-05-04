<?php

namespace App\Http\Resources\Room\App;

use Illuminate\Http\Resources\Json\JsonResource;

class RoomResource extends JsonResource {
    public function toArray($request) {
        return [
            'id' => $this->id,
            'name' => $this->name,
        ];
    }
}
