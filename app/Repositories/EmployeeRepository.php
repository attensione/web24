<?php

namespace App\Repositories;

use App\Repositories\Interfaces\EmployeeRepositoryInterface;
use App\Models\Company;
use App\Models\Employee;

/**
 * Class EmployeeRepository.
 */
class EmployeeRepository implements EmployeeRepositoryInterface
{
    protected $model;

    public function __construct(Employee $employee)
    {
        $this->model = $employee;
    }

    public function getAll($nip)
    {
        $company = new Company();
        $company_id = $company->where('nip', $nip)->get('id');
        return $this->model->where('company_id', $nip)->get();
    }

    public function getById($nip, $employee_id)
    {
        try {
            return $this->model->findOrFail($employee_id);
        }
        catch(\Exception $e) {
            return response()->json($e->getMessage(), 404);
        }
    }

    public function create($nip, array $data)
    {
        $company = new Company();
        $company_id = $company->where('nip', $nip)->get('id');
        $data = array_merge([
            'company_id' => $company_id[0]->id
        ], $data);
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
