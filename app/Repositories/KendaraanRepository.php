<?php

namespace App\Repositories;

interface KendaraanRepository
{
    public function createMobil(array $data);
    public function createMotor(array $data);
    public function getByFilters(array $filters);
    public function getKendaraanById($id);
}
