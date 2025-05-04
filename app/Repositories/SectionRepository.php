<?php

namespace App\Repositories;

use App\Interfaces\SectionRepositoryInterface;
use App\Models\Section;

class SectionRepository implements SectionRepositoryInterface {
    private $section;

    public function __construct(Section $section) {
        $this->section = $section;
    }

    public function find($id) {
        return $this->section->findOrFail($id);
    }

    public function all() {
        return $this->section->all();
    }

    public function create(array $data) {
        return $this->section->create($data);
    }

    public function update($id, array $data) {
        $section = $this->find($id);
        $section->update($data);
        return $section;
    }

    public function delete($id) {
        return $this->find($id)->delete();
    }
}
