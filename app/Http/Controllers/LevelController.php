<?php

namespace App\Http\Controllers;

use App\Http\Requests\Level\App\LevelRequest;
use App\Http\Resources\Level\App\LevelResource;
use App\Services\LevelService;
use App\Traits\ApiResponder;

class LevelController extends Controller {
    use ApiResponder;

    private $levelService;

    public function __construct(LevelService $levelService) {
        $this->levelService = $levelService;
    }

    public function get($id) {
        try {

            $level = $this->levelService->getLevel($id);
            return view('content.dashboard.levels.index')
            ->with('level',$level);

            // return $this->success(new LevelResource($level));
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    public function all() {
        try {
            $allLevel = $this->levelService->allLevel();
            return $this->success(LevelResource::collection($allLevel));
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    public function create(LevelRequest $request) {
        try {
            $level = $this->levelService->createLevel($request->validated());
            return $this->success(new LevelResource($level), __('Created Successfully.'));
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    public function update(LevelRequest $request, $id) {
        try {
            $level = $this->levelService->updateLevel($id, $request->validated());
            return $this->success(new LevelResource($level), __('Updated Successfully.'));
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    public function delete($id) {
        try {
            $this->levelService->deleteLevel($id);
            return $this->success(null, __('Deleted Successfully.'));
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }
    }
}
