<?php

namespace App\Services;

use App\Interfaces\CourseRepositoryInterface;

class CourseService {
    private $courseRepository;


    public function __construct(CourseRepositoryInterface $courseRepository) {
        $this->courseRepository = $courseRepository;
    }

    public function getcourse($id) {
        return $this->courseRepository->find($id);
    }

    public function allcourse() {
        return $this->courseRepository->all();
    }

    // public function activedcourse() {
    //     return $this->courseRepository->actived();
    // }

    public function createcourse(array $data) {
        return $this->courseRepository->create($data);
    }

    public function updatecourse($id, array $data) {
        return $this->courseRepository->update($id, $data);
    }

    public function deletecourse($id) {
        return $this->courseRepository->delete($id);
    }
}
