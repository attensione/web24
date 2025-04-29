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

    public function getByPrimary($nip)
    {
        try {
            return $this->model->where('nip', $nip)->get();
        }
        catch(\Exception $e) {
            return response()->json($e->getMessage(), 404);
        }
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update($nip, array $data)
    {
        return $this->model->where('nip', $nip)->update($data);
    }

    public function delete($nip)
    {
        $id = $this->model->where('nip', $nip)->get('id');
        return $this->model->destroy($id);
    }
}
