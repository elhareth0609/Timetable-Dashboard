<?php

namespace App\Http\Controllers;

use App\Http\Requests\Section\App\SectionRequest;
use App\Http\Resources\Section\App\SectionResource;
use App\Services\SectionService;
use App\Traits\ApiResponder;

class SectionController extends Controller {
    use ApiResponder;

    private $sectionService;

    public function __construct(SectionService $sectionService) {
        $this->sectionService = $sectionService;
    }

    public function index() {
        return view('content.dashboard.index')
        ->with('events', $this->sectionService->allSection());
    }

    public function get($id) {
        try {
            $section = $this->sectionService->getSection($id);
            return $this->success(new SectionResource($section));
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    public function create(SectionRequest $request) {
        try {
            $section = $this->sectionService->createSection($request->validated());
            return $this->success(new SectionResource($section), __('Created Successfully.'));
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    public function update(SectionRequest $request, $id) {
        try {
            $section = $this->sectionService->updateSection($id, $request->validated());
            return $this->success(new SectionResource($section), __('Updated Successfully.'));
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    public function delete($id) {
        try {
            $this->sectionService->deleteSection($id);
            return $this->success(null, __('Deleted Successfully.'));
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }
    }

}
