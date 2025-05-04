<?php

namespace App\Repositories;

use App\Interfaces\TeacherRepositoryInterface;
use App\Models\Teacher;
use Illuminate\Support\Facades\Auth;

class TeacherRepository implements TeacherRepositoryInterface {
    private $teacher;
    private $user_id;

    public function __construct(Teacher $teacher) {
        $this->teacher = $teacher;
        $this->user_id = Auth::user()->id;
    }

    public function find($id) {
        return $this->teacher->findOrFail($id);
    }

    public function all() {
        return $this->teacher->all();
    }

    public function create(array $data) {
        $data['user_id'] = $this->user_id;
        return $this->teacher->create($data);
    }

    public function update($id, array $data) {
        $teacher = $this->find($id);
        $teacher->update($data);
        return $teacher;
    }

    public function delete($id) {
        return $this->find($id)->delete();
    }
}
