<?php

namespace App\Services;

use App\Interfaces\SpecialtyRepositoryInterface;

class SpecialtyService {
    private $specialtyRepository;

    public function __construct(SpecialtyRepositoryInterface $specialtyRepository) {
        $this->specialtyRepository = $specialtyRepository;
    }

    public function getSpecialty($id) {
        return $this->specialtyRepository->find($id);
    }

    public function allSpecialty() {
        return $this->specialtyRepository->all();
    }

    public function createSpecialty(array $data) {
        return $this->specialtyRepository->create($data);
    }

    public function updateSpecialty($id, array $data) {
        return $this->specialtyRepository->update($id, $data);
    }

    public function deleteSpecialty($id) {
        return $this->specialtyRepository->delete($id);
    }
}
