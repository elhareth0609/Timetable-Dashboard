<?php

namespace App\Http\Controllers;

use App\Http\Requests\Table\App\TableRequest;
use App\Http\Resources\Table\App\TableResource;
use App\Models\StudentGroup;
use App\Services\CourseService;
use App\Services\SpecialtyService;
use App\Services\StructureService;
use App\Services\TableService;
use App\Services\TeacherService;
use App\Traits\ApiResponder;
use Illuminate\Http\Request;

class TableController extends Controller {
    use ApiResponder;

    private $tableService;
    private $specialtyService;
    private $teacherService;
    private $structureService;
    private $courseService;
    // private $groupService;

    public function __construct(TableService $tableService,CourseService $courseService,StructureService $structureService,TeacherService $teacherService,SpecialtyService $specialtyService) {
        $this->tableService = $tableService;
        $this->specialtyService = $specialtyService;
        $this->teacherService = $teacherService;
        $this->structureService = $structureService;
        $this->courseService = $courseService;
        // $this->groupService = $groupService;
    }

    public function index($id) {
        return view('content.dashboard.specialties.table')
        ->with('events', $this->tableService->allTable())
        ->with('teachers', $this->teacherService->allTeacher())
        ->with('structures', $this->structureService->allStructure())
        ->with('courses', $this->courseService->allCourse())
        ->with('groups', StudentGroup::all())
        ->with('specialty', $this->specialtyService->getSpecialty($id));
    }

    public function get($id) {
        try {
            $table = $this->tableService->getTable($id);
            return $this->success(new TableResource($table));
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    public function all() {
        try {
            $allTable = $this->tableService->allTable();
            return $this->success(TableResource::collection($allTable));
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    public function events($id) {
        try {
            $allEvents = $this->tableService->getSpecialtyTable($id);
            return $allEvents;
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    public function create(TableRequest $request) {
        try {
            $table = $this->tableService->createTable($request->validated());
            return $this->success($table, __('Created Successfully.'));
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    public function update(TableRequest $request) {
        try {
            $table = $this->tableService->updateTable($request->id, $request->validated());
            return $this->success($table, __('Updated Successfully.'));
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    public function delete($id) {
        try {
            $this->tableService->deleteTable($id);
            return $this->success(null, __('Deleted Successfully.'));
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }
    }

}
