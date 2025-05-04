<?php

namespace App\Services;

use App\Interfaces\StructureRepositoryInterface;

class StructureService {
    private $structureRepository;

    public function __construct(StructureRepositoryInterface $structureRepository) {
        $this->structureRepository = $structureRepository;
    }

    public function getStructure($id) {
        return $this->structureRepository->find($id);
    }

    public function allStructure() {
        return $this->structureRepository->all();
    }

    public function createStructure(array $data) {
        return $this->structureRepository->create($data);
    }

    public function updateStructure($id, array $data) {
        return $this->structureRepository->update($id, $data);
    }

    public function deleteStructure($id) {
        return $this->structureRepository->delete($id);
    }
}
