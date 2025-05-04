<?php

namespace App\Http\Requests\Course\App;

use Illuminate\Foundation\Http\FormRequest;

class CourseRequest extends FormRequest {
    public function rules() {
        return [
            'id' => $this->routeIs('course.update') ? 'required|exists:courses,id' : '',
            'name' => 'required|string'
        ];
    }
}
