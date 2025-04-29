<?php

namespace App\Repositories;

use App\Repositories\Interfaces\CompanyRepositoryInterface;
use App\Models\Company;

/**
 * Class CompanyRepository.
 */
class CompanyRepository implements CompanyRepositoryInterface
{
    protected $model;

    public function __construct(Company $company)
    {
        $this->model = $company;
    }

    public function getAll()
    {
        return $this->model->all();
    }

    public function getById($id)
    {
        try {
            return $this->model->findOrFail($id);
        }
        catch(\Exception $e) {
            return response()->json($e->getMessage(), 404);
        }
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update($id, array $data)
    {
        return $this->model->findOrFail($id)->update($data);
    }

    public function delete($id)
    {
        return $this->model->destroy($id);
    }
}
