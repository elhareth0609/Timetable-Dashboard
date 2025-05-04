<?php

namespace App\Services;

use App\Interfaces\SectionRepositoryInterface;

class SectionService {
    private $sectionRepository;

    public function __construct(SectionRepositoryInterface $sectionRepository) {
        $this->sectionRepository = $sectionRepository;
    }

    public function getSection($id) {
        return $this->sectionRepository->find($id);
    }

    public function allSection() {
        return $this->sectionRepository->all();
    }

    public function createSection(array $data) {
        return $this->sectionRepository->create($data);
    }

    public function updateSection($id, array $data) {
        return $this->sectionRepository->update($id, $data);
    }

    public function deleteSection($id) {
        return $this->sectionRepository->delete($id);
    }
}
