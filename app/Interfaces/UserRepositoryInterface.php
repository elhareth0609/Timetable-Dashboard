<?php

namespace App\Interfaces;

interface UserRepositoryInterface {
    public function find($id);
    public function create(array $data);
    public function update($id, array $data);
    public function delete($id);
    public function all();
    public function where($column, $value);
    // public function actived();
}
