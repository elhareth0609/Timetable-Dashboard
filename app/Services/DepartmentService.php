<?php

namespace App\Services;

use App\Interfaces\DepartmentRepositoryInterface;

class DepartmentService {
    private $departmentRepository;

    public function __construct(DepartmentRepositoryInterface $departmentRepository) {
        $this->departmentRepository = $departmentRepository;
    }

    public function getDepartment($id) {
        return $this->departmentRepository->find($id);
    }

    public function allDepartment() {
        return $this->departmentRepository->all();
    }

    public function createDepartment(array $data) {
        return $this->departmentRepository->create($data);
    }

    public function updateDepartment($id, array $data) {
        return $this->departmentRepository->update($id, $data);
    }

    public function deleteDepartment($id) {
        return $this->departmentRepository->delete($id);
    }
}
