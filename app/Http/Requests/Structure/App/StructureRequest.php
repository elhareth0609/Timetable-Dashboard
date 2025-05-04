<?php

namespace App\Http\Requests\Structure\App;

use Illuminate\Foundation\Http\FormRequest;

class StructureRequest extends FormRequest {
    public function rules()
    {
        return [
            'id' => $this->routeIs('structure.update') ? 'required|exists:structures,id' : '',
            'name' => 'required|string',
            'name_ar' => 'required|string',
            'code' => 'required|string',
            'description' => 'required|string',
        ];
    }
}
