<?php

namespace App\Repositories;

use App\Interfaces\RoomRepositoryInterface;
use App\Models\Room;
use Illuminate\Support\Facades\Auth;

class RoomRepository implements RoomRepositoryInterface {
    private $room;
    private $user_id;

    public function __construct(Room $room) {
        $this->room = $room;
        $this->user_id = Auth::user()->id;
    }

    public function find($id) {
        return $this->room->findOrFail($id);
    }

    public function all() {
        return $this->room->all();
    }

    public function create(array $data) {
        $data['user_id'] = $this->user_id;
        return $this->room->create($data);
    }

    public function update($id, array $data) {
        $room = $this->find($id);
        $room->update($data);
        return $room;
    }

    public function delete($id) {
        return $this->find($id)->delete();
    }
}
