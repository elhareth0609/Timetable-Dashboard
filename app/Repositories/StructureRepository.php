<?php

namespace App\Repositories;

use App\Interfaces\StructureRepositoryInterface;
use App\Models\Structure;
use Illuminate\Support\Facades\Auth;

class StructureRepository implements StructureRepositoryInterface {
    private $structure;
    private $user_id;

    public function __construct(Structure $structure) {
        $this->structure = $structure;
        $this->user_id = Auth::user()->id;
    }

    public function find($id) {
        return $this->structure->findOrFail($id);
    }

    public function all() {
        return $this->structure->all();
    }

    public function create(array $data) {
        $data['user_id'] = $this->user_id;
        return $this->structure->create($data);
    }

    public function update($id, array $data) {
        $structure = $this->find($id);
        $structure->update($data);
        return $structure;
    }

    public function delete($id) {
        return $this->find($id)->delete();
    }
}
