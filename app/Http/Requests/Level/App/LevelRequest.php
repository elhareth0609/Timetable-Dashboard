<?php

namespace App\Http\Requests\Level\App;

use Illuminate\Foundation\Http\FormRequest;

class LevelRequest extends FormRequest {
    public function rules()
    {
        return [
            'id' => $this->routeIs('level.update') ? 'required|exists:levels,id' : '',
            'name' => 'required|string',
            'name_ar' => 'required|string',
            'code' => 'required|string',
            'description' => 'required|string',
        ];
    }
}
