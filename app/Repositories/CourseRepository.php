<?php

namespace App\Repositories;

use App\Interfaces\CourseRepositoryInterface;
use App\Models\Course;

class CourseRepository implements CourseRepositoryInterface {
    private $course;

    public function __construct(Course $course) {
        $this->course = $course;
    }

    public function find($id) {
        return $this->course->findOrFail($id);
    }

    public function all() {
        return $this->course->all();
    }

    public function create(array $data) {
        return $this->course->create($data);
    }

    public function update($id, array $data) {
        $course = $this->find($id);
        $course->update($data);
        return $course;
    }

    public function delete($id) {
        $course = $this->find($id);
        return $course->delete();
    }

}
