<?php

namespace App\Repositories;

use App\Interfaces\FacultyRepositoryInterface;
use App\Models\Faculty;
use Illuminate\Support\Facades\Auth;

class FacultyRepository implements FacultyRepositoryInterface {
    private $faculty;
    private $user_id;

    public function __construct(Faculty $faculty) {
        $this->faculty = $faculty;
        $this->user_id = Auth::user()->id;
    }

    public function find($id) {
        return $this->faculty->findOrFail($id);
    }

    public function all() {
        return $this->faculty->all();
    }

    public function create(array $data) {
        $data['user_id'] = $this->user_id;
        return $this->faculty->create($data);
    }

    public function update($id, array $data) {
        $faculty = $this->find($id);
        $faculty->update($data);
        return $faculty;
    }

    public function delete($id) {
        return $this->find($id)->delete();
    }
}
