<?php

namespace App\Http\Requests\Room\App;

use Illuminate\Foundation\Http\FormRequest;

class RoomRequest extends FormRequest {
    public function rules()
    {
        return [
            'id' => $this->routeIs('record.update') ? 'required|exists:rooms' : '',
            'name' => 'required|string'
        ];
    }
}
