<?php

namespace App\Repositories;

use App\Interfaces\SpecialtyRepositoryInterface;
use App\Models\Specialty;
use Illuminate\Support\Facades\Auth;

class SpecialtyRepository implements SpecialtyRepositoryInterface {
    private $specialty;
    private $user_id;

    public function __construct(Specialty $specialty) {
        $this->specialty = $specialty;
        $this->user_id = Auth::user()->id;
    }

    public function find($id) {
        return $this->specialty->findOrFail($id);
    }

    public function all() {
        return $this->specialty->all();
    }

    public function create(array $data) {
        $data['user_id'] = $this->user_id;
        return $this->specialty->create($data);
    }

    public function update($id, array $data) {
        $specialty = $this->find($id);
        $specialty->update($data);
        return $specialty;
    }

    public function delete($id) {
        return $this->find($id)->delete();
    }
}
