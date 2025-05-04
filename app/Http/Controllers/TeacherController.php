<?php

namespace App\Http\Controllers;

use App\Http\Requests\Teacher\App\TeacherRequest;
use App\Http\Resources\Teacher\App\TeacherResource;
use App\Services\TeacherService;
use App\Traits\ApiResponder;

class TeacherController extends Controller {
    use ApiResponder;

    private $teacherService;

    public function __construct(TeacherService $teacherService) {
        $this->teacherService = $teacherService;
    }

    public function get($id) {
        try {
            $teacher = $this->teacherService->getTeacher($id);
            return $this->success(new TeacherResource($teacher));
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    public function all() {
        try {
            $allTeacher = $this->teacherService->allTeacher();
            return $this->success(TeacherResource::collection($allTeacher));
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    public function create(TeacherRequest $request) {
        try {
            $teacher = $this->teacherService->createTeacher($request->validated());
            return $this->success(new TeacherResource($teacher), __('Created Successfully.'));
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    public function update(TeacherRequest $request, $id) {
        try {
            $teacher = $this->teacherService->updateTeacher($id, $request->validated());
            return $this->success(new TeacherResource($teacher), __('Updated Successfully.'));
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    public function delete($id) {
        try {
            $this->teacherService->deleteTeacher($id);
            return $this->success(null, __('Deleted Successfully.'));
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }
    }
}
