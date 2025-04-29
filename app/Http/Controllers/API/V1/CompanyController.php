<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\CompanyRepositoryInterface;

class CompanyController extends Controller
{
    private $companyRepository;

    private function validateRequestData($data) {
        $validated = $data->validate([
            'name' => 'required|string|max:255',
            'nip' => 'required|string|digits:10|unique:companies',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'postal_code' => 'required|regex:/^\d{2}-\d{3}$/'
        ]);
        return $validated;
    }

    public function __construct(CompanyRepositoryInterface $companyRepository)
    {
        $this->companyRepository = $companyRepository;
    }

    public function index()
    {
        try {
            $company = $this->companyRepository->getAll();
            return response()->json($company, 200);
        }
        catch(\Exception $e) {
            return response()->json($e->getMessage(), 404);
        }
    }

    public function show($id) {
        $company = $this->companyRepository->getById($id);
        return response()->json($company, 200);
    }

    public function store(Request $request)
    {
        try {
            $validated = $this->validateRequestData($request);
            $company = $this->companyRepository->create($validated);
            return response()->json(['Successful store "Company" data: '.$request], 201);
        }
        catch(\Exception $e) {
            return response()->json($e->getMessage(), 404);
        }
    }

    public function update($id, Request $request)
    {
        try {
            $validated = $this->validateRequestData($request);
            $company = $this->companyRepository->update($id, $validated);
            return response()->json(['Successful update "Company" with id: '.$id,'New Company data:'.$request], 201);
        }
        catch(\Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }

    public function destroy($id) {
        try {
            $company = $this->companyRepository->delete($id);
            return response()->json('Successful delete "Company" with id: '.$company, 200);
        }
        catch(\Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }
}
