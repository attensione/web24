<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\EmployeeRepositoryInterface;

class EmployeeController extends Controller
{
    private $employeeRepository;

    private function validateRequestData($data) {
        $validated = $data->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:employees',
            'phone' => 'nullable|regex:/^\+?[0-9]{9,15}$/'
        ]);
        return $validated;
    }

    public function __construct(EmployeeRepositoryInterface $employeeRepository)
    {
        $this->employeeRepository = $employeeRepository;
    }

    public function index($nip)
    {
        try {
            $employee = $this->employeeRepository->getAll();
            return response()->json($employee, 200);
        }
        catch(\Exception $e) {
            return response()->json($e->getMessage(), 404);
        }
    }

    public function show($nip, $employee_id) {
        $employee = $this->employeeRepository->getById($nip, $employee_id);
        return response()->json($employee, 200);
    }

    public function store($nip, Request $request)
    {
        try {
            $validated = $this->validateRequestData($request);
            if($validated) {
                $company = new Company();
                $company_id = $company->where('nip', $nip)->get('id');
                $data = array_merge([
                    'company_id' => $company_id[0]->id
                ], $validated);
                $this->employeeRepository->create($data);
                return response()->json('Successful store "Employee" data: '.$data, 201);
            }
        }
        catch(\Exception $e) {
            return response()->json($e->getMessage(), 404);
        }
    }

    public function update($id, Request $request)
    {
        try {
            $validated = $this->validateRequestData($request);
            $employee = $this->employeeRepository->update($id, $validated);
            return response()->json(['Successful update "Employee" with id: '.$id,'New Employee data:'.$request], 201);
        }
        catch(\Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }

    public function destroy($id) {
        try {
            $employee = $this->employeeRepository->delete($id);
            return response()->json('Successful delete "Employee" with id: '.$employee, 200);
        }
        catch(\Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }
}
