<?php

namespace App\Repositories\Interfaces;

interface CompanyRepositoryInterface
{
    public function getAll();
    public function getByPrimary($id);
    public function create(array $data);
    public function update($id, array $data);
    public function delete($id);
}
