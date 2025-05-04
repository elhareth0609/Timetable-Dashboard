<?php

namespace App\Http\Requests\Teacher\App;

use Illuminate\Foundation\Http\FormRequest;

class TeacherRequest extends FormRequest {
    public function rules()
    {
        return [
            'id' => $this->routeIs('record.update') ? 'required|exists:teachers,id' : '',
            'code' => 'required|string',
            'department_id' => 'required|exists:departments,id',
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|email|unique:teachers,email,' . $this->id,
            'phone' => 'required|numeric',
            'max_weekly_hours' => 'required|numeric',
            'specialization' => 'required|string'
        ];
    }
}
