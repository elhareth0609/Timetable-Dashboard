<?php

namespace App\Repositories;

use App\Interfaces\TableRepositoryInterface;
use App\Models\ScheduleEvent;

class TableRepository implements TableRepositoryInterface {
    private $table;

    public function __construct(ScheduleEvent $table) {
        $this->table = $table;
    }

    public function find($id) {
        return $this->table->findOrFail($id);
    }

    public function all() {
        return $this->table->all();
    }

    public function where($column, $value) {
        return $this->table->where($column, $value);
    }

    public function with($value) {
        return $this->table->with($value);
    }

    public function create(array $data) {
        return $this->table->create($data);
    }

    public function update($id, array $data) {
        $table = $this->find($id);
        $table->update($data);
        return $table;
    }

    public function delete($id) {
        return $this->find($id)->delete();
    }
}
