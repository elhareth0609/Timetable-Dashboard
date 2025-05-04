<?php

namespace App\Services;

use App\Interfaces\TeacherRepositoryInterface;

class TeacherService {
    private $teacherRepository;

    public function __construct(TeacherRepositoryInterface $teacherRepository) {
        $this->teacherRepository = $teacherRepository;
    }

    public function getTeacher($id) {
        return $this->teacherRepository->find($id);
    }

    public function allTeacher() {
        return $this->teacherRepository->all();
    }

    public function createTeacher(array $data) {
        return $this->teacherRepository->create($data);
    }

    public function updateTeacher($id, array $data) {
        return $this->teacherRepository->update($id, $data);
    }

    public function deleteTeacher($id) {
        return $this->teacherRepository->delete($id);
    }
}
