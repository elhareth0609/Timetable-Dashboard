<?php

namespace App\Interfaces;

interface FacultyRepositoryInterface {
    public function find($id);
    public function create(array $data);
    public function update($id, array $data);
    public function delete($id);
    public function all();
    // public function actived();

}
