<?php

namespace App\Http\Controllers;

use App\Http\Requests\Room\App\RoomRequest;
use App\Http\Resources\Room\App\RoomResource;
use App\Services\RoomService;
use App\Traits\ApiResponder;

class RoomController extends Controller {
    use ApiResponder;

    private $roomService;

    public function __construct(RoomService $roomService) {
        $this->roomService = $roomService;
    }

    public function get($id) {
        try {
            $room = $this->roomService->getRoom($id);
            return $this->success(new RoomResource($room));
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    public function all() {
        try {
            $allRoom = $this->roomService->allRoom();
            return $this->success(RoomResource::collection($allRoom));
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    public function create(RoomRequest $request) {
        try {
            $room = $this->roomService->createRoom($request->validated());
            return $this->success(new RoomResource($room), __('Created Successfully.'));
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    public function update(RoomRequest $request, $id) {
        try {
            $room = $this->roomService->updateRoom($id, $request->validated());
            return $this->success(new RoomResource($room), __('Updated Successfully.'));
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    public function delete($id) {
        try {
            $this->roomService->deleteRoom($id);
            return $this->success(null, __('Deleted Successfully.'));
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }
    }
}
