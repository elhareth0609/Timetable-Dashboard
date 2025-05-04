<?php

namespace App\Http\Requests\Section\App;

use Illuminate\Foundation\Http\FormRequest;

class SectionRequest extends FormRequest {
    public function rules()
    {
        return [
            'id' => $this->routeIs('record.update') ? 'required|exists:sections' : '',
            'name' => 'required|string'
        ];
    }
}
