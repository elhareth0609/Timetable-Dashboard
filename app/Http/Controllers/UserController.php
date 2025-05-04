<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\App\UserRequest;
use App\Http\Resources\User\App\UserResource;
use App\Services\UserService;
use App\Traits\ApiResponder;

class UserController extends Controller {
    use ApiResponder;

    private $userService;

    public function __construct(UserService $userService) {
        $this->userService = $userService;
    }

    public function get($id) {
        try {
            $user = $this->userService->getUser($id);
            return $this->success(new UserResource($user));
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    public function all() {
        try {
            $allUser = $this->userService->allUser();
            return $this->success(UserResource::collection($allUser));
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    public function create(UserRequest $request) {
        try {
            $user = $this->userService->createUser($request->validated());
            return $this->success(new UserResource($user), __('Created Successfully.'));
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    public function update(UserRequest $request, $id) {
        try {
            $user = $this->userService->updateUser($id, $request->validated());
            return $this->success(new UserResource($user), __('Updated Successfully.'));
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    public function delete($id) {
        try {
            $this->userService->deleteUser($id);
            return $this->success(null, __('Deleted Successfully.'));
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }
    }

}
