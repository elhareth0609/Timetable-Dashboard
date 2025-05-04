<?php

namespace App\Http\Requests\Specialty\App;

use Illuminate\Foundation\Http\FormRequest;

class SpecialtyRequest extends FormRequest {
    public function rules()
    {
        return [
            'id' => $this->routeIs('specialty.update') ? 'required|exists:specialties,id' : '',
            'name' => 'required|string',
            'name_ar' => 'required|string',
            'code' => 'required|string',
            'description' => 'required|string',
        ];
    }
}
