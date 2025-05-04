<?php

namespace App\Services;

use App\Interfaces\FacultyRepositoryInterface;

class FacultyService {
    private $facultyRepository;

    public function __construct(FacultyRepositoryInterface $facultyRepository) {
        $this->facultyRepository = $facultyRepository;
    }

    public function getFaculty($id) {
        return $this->facultyRepository->find($id);
    }

    public function allFaculty() {
        return $this->facultyRepository->all();
    }

    public function createFaculty(array $data) {
        return $this->facultyRepository->create($data);
    }

    public function updateFaculty($id, array $data) {
        return $this->facultyRepository->update($id, $data);
    }

    public function deleteFaculty($id) {
        return $this->facultyRepository->delete($id);
    }
}
