<?php

namespace App\Repositories;

use App\Interfaces\DepartmentRepositoryInterface;
use App\Models\Department;
use Illuminate\Support\Facades\Auth;

class DepartmentRepository implements DepartmentRepositoryInterface {
    private $department;
    private $user_id;

    public function __construct(Department $department) {
        $this->department = $department;
        $this->user_id = Auth::user()->id;
    }

    public function find($id) {
        return $this->department->findOrFail($id);
    }

    public function all() {
        return $this->department->all();
    }

    public function create(array $data) {
        $data['user_id'] = $this->user_id;
        return $this->department->create($data);
    }

    public function update($id, array $data) {
        $department = $this->find($id);
        $department->update($data);
        return $department;
    }

    public function delete($id) {
        return $this->find($id)->delete();
    }
}
