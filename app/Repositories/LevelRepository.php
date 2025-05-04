<?php

namespace App\Repositories;

use App\Interfaces\LevelRepositoryInterface;
use App\Models\Level;
use Illuminate\Support\Facades\Auth;

class LevelRepository implements LevelRepositoryInterface {
    private $level;
    private $user_id;

    public function __construct(Level $level) {
        $this->level = $level;
        $this->user_id = Auth::user()->id;
    }

    public function find($id) {
        return $this->level->findOrFail($id);
    }

    public function all() {
        return $this->level->all();
    }

    public function create(array $data) {
        $data['user_id'] = $this->user_id;
        return $this->level->create($data);
    }

    public function update($id, array $data) {
        $level = $this->find($id);
        $level->update($data);
        return $level;
    }

    public function delete($id) {
        return $this->find($id)->delete();
    }
}
