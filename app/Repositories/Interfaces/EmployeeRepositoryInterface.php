<?php

namespace App\Repositories\Interfaces;

interface EmployeeRepositoryInterface
{
    public function getAll($nip);
    public function getById($nip, $id);
    public function create($nip, array $data);
    public function update($id, array $data);
    public function delete($id);
}
