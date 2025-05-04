<?php

namespace App\Http\Requests\Table\App;

use Illuminate\Foundation\Http\FormRequest;

class TableRequest extends FormRequest {
    public function rules() {
        return [
            'id' => $this->routeIs('table.update') ? 'required|exists:schedule_events,id' : '',
            'teacher_id' => 'required|exists:teachers,id',
            'course_id' => 'required|exists:courses,id',
            'group_id' => 'required|exists:student_groups,id',
            'speacilty_id' => 'required|exists:specialties,id',
            'structure_id' => 'required|exists:structures,id',
            'day' => 'required|string',
            'slot' => 'required|string',
            'sessions' => 'required|string',
            'color' => 'required|string',
        ];
    }
}
