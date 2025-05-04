<?php

namespace App\Http\Requests\Department\App;

use Illuminate\Foundation\Http\FormRequest;

class DepartmentRequest extends FormRequest {
    public function rules()
    {
        return [
            'id' => $this->routeIs('department.update') ? 'required|exists:departments,id' : '',
            'faculty_id' => 'required|exists:faculties,id',
            'code' => 'required|string',
            'name' => 'required|string',
            'name_ar' => 'required|string',
            'email' => 'required|email',
            'description' => 'required|string',
        ];
    }
}
