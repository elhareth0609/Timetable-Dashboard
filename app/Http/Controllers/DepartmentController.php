<?php

namespace App\Http\Controllers;

use App\Http\Requests\Department\App\DepartmentRequest;
use App\Http\Resources\Department\App\DepartmentResource;
use App\Services\DepartmentService;
use App\Traits\ApiResponder;

class DepartmentController extends Controller {
    use ApiResponder;

    private $departmentService;

    public function __construct(DepartmentService $departmentService) {
        $this->departmentService = $departmentService;
    }

    public function get($id) {
        try {

            $department = $this->departmentService->getDepartment($id);
            return view('content.dashboard.departments.index')
            ->with('department',$department);

            $department = $this->departmentService->getDepartment($id);
            return $this->success(new DepartmentResource($department));
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    public function all() {
        try {
            $allDepartment = $this->departmentService->allDepartment();
            return $this->success(DepartmentResource::collection($allDepartment));
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    public function create(DepartmentRequest $request) {
        try {
            $department = $this->departmentService->createDepartment($request->validated());
            return $this->success(new DepartmentResource($department), __('Created Successfully.'));
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    public function update(DepartmentRequest $request, $id) {
        try {
            $department = $this->departmentService->updateDepartment($id, $request->validated());
            return $this->success(new DepartmentResource($department), __('Updated Successfully.'));
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    public function delete($id) {
        try {
            $this->departmentService->deleteDepartment($id);
            return $this->success(null, __('Deleted Successfully.'));
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }
    }
}
