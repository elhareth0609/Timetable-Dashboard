<?php

namespace App\Interfaces;

interface TableRepositoryInterface {
    public function find($id);
    public function create(array $data);
    public function update($id, array $data);
    public function delete($id);
    public function where($column, $value);
    public function with($value);
    public function all();
}
