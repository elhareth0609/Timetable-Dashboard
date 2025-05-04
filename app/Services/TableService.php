<?php

namespace App\Services;

use App\Interfaces\TableRepositoryInterface;

class TableService {
    private $tableRepository;

    public function __construct(TableRepositoryInterface $tableRepository) {
        $this->tableRepository = $tableRepository;
    }

    public function getTable($id) {
        return $this->tableRepository->find($id);
    }

    public function getSpecialtyTable($id) {
        return $this->tableRepository
        ->with('structure')
        ->with('specialty')
        ->with('teacher')
        ->with('group')
        ->with('course')
        ->where('speacilty_id',$id)
        ->get();
    }

    public function allTable() {
        return $this->tableRepository->all();
    }

    public function createTable(array $data) {
        $table = $this->tableRepository->create($data);
        return $this->tableRepository
            ->with(['structure', 'specialty', 'teacher', 'group', 'course'])
            ->find($table->id);
    }

    public function updateTable($id, array $data) {
        $this->tableRepository->update($id, $data);

        return $this->tableRepository
        ->with(['structure', 'specialty', 'teacher', 'group', 'course'])
        ->find($id);

    }

    public function deleteTable($id) {
        return $this->tableRepository->delete($id);
    }
}
