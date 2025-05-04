<?php

namespace App\Http\Controllers;

use App\Http\Requests\Course\App\CourseRequest;
use App\Http\Resources\Course\App\CourseResource;
use App\Services\CourseService;
use App\Traits\ApiResponder;
use Illuminate\Http\Request;

class CourseController extends Controller {
    use ApiResponder;

    private $courseService;

    public function __construct(CourseService $courseService) {
        $this->courseService = $courseService;
    }

    public function get($id) {
        try {
            $course = $this->courseService->getCourse($id);
            return $this->success(new CourseResource($course));
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    public function all() {
        try {
            $allCourse = $this->courseService->allCourse();
            return $this->success(CourseResource::collection($allCourse));
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    public function create(CourseRequest $request) {
        try {
            $course = $this->courseService->createCourse($request->validated());
            return $this->success(new CourseResource($course), __('Created Successfully.'));
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    public function update(CourseRequest $request, $id) {
        try {
            $course = $this->courseService->updateCourse($id, $request->validated());
            return $this->success(new CourseResource($course), __('Updated Successfully.'));
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    public function delete($id) {
        try {
            $this->courseService->deleteCourse($id);
            return $this->success(null, __('Deleted Successfully.'));
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }
    }

}
