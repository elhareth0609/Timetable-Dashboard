<?php

namespace App\Http\Controllers;

use App\Http\Requests\Structure\App\StructureRequest;
use App\Http\Resources\Structure\App\StructureResource;
use App\Services\StructureService;
use App\Traits\ApiResponder;

class StructureController extends Controller {
    use ApiResponder;

    private $structureService;

    public function __construct(StructureService $structureService) {
        $this->structureService = $structureService;
    }

    public function get($id) {
        try {
            $structure = $this->structureService->getStructure($id);
            return $this->success(new StructureResource($structure));
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    public function all() {
        try {
            $allStructure = $this->structureService->allStructure();
            return $this->success(StructureResource::collection($allStructure));
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    public function create(StructureRequest $request) {
        try {
            $structure = $this->structureService->createStructure($request->validated());
            return $this->success(new StructureResource($structure), __('Created Successfully.'));
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    public function update(StructureRequest $request, $id) {
        try {
            $structure = $this->structureService->updateStructure($id, $request->validated());
            return $this->success(new StructureResource($structure), __('Updated Successfully.'));
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    public function delete($id) {
        try {
            $this->structureService->deleteStructure($id);
            return $this->success(null, __('Deleted Successfully.'));
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }
    }
}
