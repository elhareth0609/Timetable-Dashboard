<?php

namespace App\Http\Controllers;

use App\Http\Requests\Faculty\App\FacultyRequest;
use App\Http\Resources\Faculty\App\FacultyResource;
use App\Services\FacultyService;
use App\Traits\ApiResponder;

class FacultyController extends Controller {
    use ApiResponder;

    private $facultyService;

    public function __construct(FacultyService $facultyService) {
        $this->facultyService = $facultyService;
    }

    public function get($id) {
        try {

            $faculty = $this->facultyService->getFaculty($id);
            return view('content.dashboard.faculties.index')
            ->with('faculty',$faculty);

            $faculty = $this->facultyService->getFaculty($id);
            return $this->success(new FacultyResource($faculty));
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    public function all() {
        try {
            $allFaculty = $this->facultyService->allFaculty();
            return $this->success(FacultyResource::collection($allFaculty));
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    public function create(FacultyRequest $request) {
        try {
            $faculty = $this->facultyService->createFaculty($request->validated());
            return $this->success(new FacultyResource($faculty), __('Created Successfully.'));
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    public function update(FacultyRequest $request, $id) {
        try {
            $faculty = $this->facultyService->updateFaculty($id, $request->validated());
            return $this->success(new FacultyResource($faculty), __('Updated Successfully.'));
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    public function delete($id) {
        try {
            $this->facultyService->deleteFaculty($id);
            return $this->success(null, __('Deleted Successfully.'));
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }
    }
}
