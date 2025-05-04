<?php

namespace App\Services;

use App\Interfaces\LevelRepositoryInterface;

class LevelService {
    private $levelRepository;

    public function __construct(LevelRepositoryInterface $levelRepository) {
        $this->levelRepository = $levelRepository;
    }

    public function getLevel($id) {
        return $this->levelRepository->find($id);
    }

    public function allLevel() {
        return $this->levelRepository->all();
    }

    public function createLevel(array $data) {
        return $this->levelRepository->create($data);
    }

    public function updateLevel($id, array $data) {
        return $this->levelRepository->update($id, $data);
    }

    public function deleteLevel($id) {
        return $this->levelRepository->delete($id);
    }
}
