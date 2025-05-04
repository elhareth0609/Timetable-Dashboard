<?php

namespace App\Services;

use App\Interfaces\RoomRepositoryInterface;

class RoomService {
    private $roomRepository;

    public function __construct(RoomRepositoryInterface $roomRepository) {
        $this->roomRepository = $roomRepository;
    }

    public function getRoom($id) {
        return $this->roomRepository->find($id);
    }

    public function allRoom() {
        return $this->roomRepository->all();
    }

    public function createRoom(array $data) {
        return $this->roomRepository->create($data);
    }

    public function updateRoom($id, array $data) {
        return $this->roomRepository->update($id, $data);
    }

    public function deleteRoom($id) {
        return $this->roomRepository->delete($id);
    }
}
