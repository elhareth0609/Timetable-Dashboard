<?php

namespace App\Http\Requests\Faculty\App;

use Illuminate\Foundation\Http\FormRequest;

class FacultyRequest extends FormRequest {
    public function rules()
    {
        return [
            'id' => $this->routeIs('faculty.update') ? 'required|exists:faculties,id' : '',
            'name' => 'required|string',
            'name_ar' => 'required|string',
            'code' => 'required|string',
            'description' => 'required|string',
        ];
    }
}
