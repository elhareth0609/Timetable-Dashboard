<?php

namespace App\Http\Controllers;

use App\Http\Requests\Specialty\App\SpecialtyRequest;
use App\Http\Resources\Specialty\App\SpecialtyResource;
use App\Models\ScheduleEvent;
use App\Services\SpecialtyService;
use App\Traits\ApiResponder;

class SpecialtyController extends Controller {
    use ApiResponder;

    private $specialtyService;

    public function __construct(SpecialtyService $specialtyService) {
        $this->specialtyService = $specialtyService;
    }

    public function get($id) {
        try {
            $specialty = $this->specialtyService->getSpecialty($id);
            return view('content.dashboard.specialties.index')
            ->with('specialty',$specialty);

            $specialty = $this->specialtyService->getSpecialty($id);
            return $this->success(new SpecialtyResource($specialty));
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    public function all() {
        try {
            $allSpecialty = $this->specialtyService->allSpecialty();
            return $this->success(SpecialtyResource::collection($allSpecialty));
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    public function create(SpecialtyRequest $request) {
        try {
            $specialty = $this->specialtyService->createSpecialty($request->validated());
            return $this->success(new SpecialtyResource($specialty), __('Created Successfully.'));
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    public function update(SpecialtyRequest $request, $id) {
        try {
            $specialty = $this->specialtyService->updateSpecialty($id, $request->validated());
            return $this->success(new SpecialtyResource($specialty), __('Updated Successfully.'));
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    public function delete($id) {
        try {
            $this->specialtyService->deleteSpecialty($id);
            return $this->success(null, __('Deleted Successfully.'));
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    public function events($id) {
        $events = ScheduleEvent::with('structure')->with('specialty')->with('teacher')->with('group')->with('course')->where('speacilty_id',$id)->get();

        return $events;
    }
}
